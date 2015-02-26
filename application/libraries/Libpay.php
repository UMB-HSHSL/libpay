<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';
require_once APPPATH . 'libraries/LibpayException.php';
require_once APPPATH . 'libraries/LibpayError.php';

class Libpay
{
    private $ci = null;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function log_exception($type, $msg, $e = null)
    {
        $this->ci->load->library('papertraillogger');
        $this->ci->papertraillogger->write(
            array(
                array('type' => $type, 'body' => $msg)
            )
        );
    }

    public function log_transaction(Stripe_Charge $charge)
    {
        // so we can easily iterate over public members
        $simple_charge = json_decode($charge->__toJSON());

        $this->ci->load->model('charge_model');
        $this->ci->load->model('charge_field_model');

        $cid = $this->ci->charge_model->insert(array('stripe_id' => $simple_charge->id));
        $fields = array();
        foreach ($simple_charge as $k => $v) {
            if (is_scalar($v)) {
                $this->ci->charge_field_model->insert(array(
                    'charge_id' => $cid,
                    'charge_field' => $k,
                    'charge_value' => $v,
                ));
            }
        }
    }

    public function log_transaction_supplement($charge, $hshsl_value)
    {
        $this->ci->load->model('charge_model');
        $this->ci->load->model('charge_field_model');

        $stored_charge = $this->ci->charge_model->get_by('stripe_id', $charge->id);

        $fields = array();
        foreach ($hshsl_value as $k => $v) {
            if (is_scalar($v)) {
                $this->ci->charge_field_model->insert(array(
                    'charge_id' => $stored_charge->id,
                    'charge_field' => $k,
                    'charge_value' => $v,
                ));
            }
        }
    }

    public function pay($amount, $tokenId, $description, $receiptTo)
    {
        try {
            $token = Stripe_Token::retrieve($tokenId);
            if (! cc_valid_brand($token->card->brand)){
                $valid_brands = implode(", ", config_item('stripe_valid_brands'));
                throw new LibpayException("Sorry; we do not accept {$token->card->brand}. Please choose from the following: {$valid_brands}.");
            }
            $stripe_res = Stripe_Charge::create(array(
                "amount" => $amount,
                "currency" => "usd",
                "card" => $token,
                "description" => $description,
                "receipt_email" => $receiptTo,
            ));

            $this->log_transaction($stripe_res);

            $this->send_mail();

            return $stripe_res;
        }

        // card error (decline)
        catch (Stripe_CardError $e) {
            $body = $e->getJsonBody();
            $error = (object) $body['error'];

            $le = new LibpayException($error->message);
            $le->tx_id = $error->charge;

            throw $le;
        }

        // Invalid parameters were supplied to Stripe's API
        catch (Stripe_InvalidRequestError $e) {
            $body = $e->getJsonBody();
            $error = (object) $body['error'];

            $error_code = $this->error_code($error->type);

            $this->log_exception($error->type, $error->message);
            throw new LibpayException("Your payment could not be processed at this time. Error Code <strong>{$error_code}</strong>.");
        }
        // Authentication with Stripe's API failed; changed API keys?
        catch (Stripe_AuthenticationError $e) {
            $body = $e->getJsonBody();
            $error = (object) $body['error'];

            $error_code = $this->error_code($error->type);

            $this->log_exception($error->type, $error->message);
            throw new LibpayException("Your payment could not be processed at this time. Error Code <strong>{$error_code}</strong>.");
        }

        // Network communication with Stripe failed
        catch (Stripe_ApiConnectionError $e) {
            $body = $e->getJsonBody();
            $error = (object) $body['error'];

            $error_code = $this->error_code($error->type);

            $this->log_exception($error->type, $error->message);
            throw new LibpayException("Your payment could not be processed at this time. Error Code <strong>{$error_code}</strong>.");
        }

        catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $body = $e->getJsonBody();
            $error = (object) $body['error'];

            $error_code = $this->error_code($error->type);

            $this->log_exception($error->type, $error->message);
            throw new LibpayException("Your payment could not be processed at this time. Error Code <strong>{$error_code}</strong>.");
        }

    }


    private function send_mail()
    {
        return;

        $to = $_POST["email"];
        $receipt_to = $_POST["email"]; // sender
        $subject = "HSHSL Payment Confirmation";
        $hshsl_email = "cats@hshsl.umaryland.edu";
        $to = "bkim@hshsl.umaryland.edu";
        $message = "Thank you for your payment. Please retain this email as the receipt of your payment.";
        $message .= "\n\nYour Name: " . $_POST['patron_name'];
        $message .= "\nYour UMID: " . $_POST['umid'];
        $message .= "\nAmount: $";
        $message .= $_POST['hshsl_amount_dollar'] . "." . $_POST['hshsl_amount_cents'];
        $message .= "\nCategory: " . $_POST['hshsl_category'];
        $message .= "\nInvoice No. (If Applicable): " . $_POST['invoice_no'];
        $message .= "\nSpecial Instructions. (If Applicable): " . $_POST['instruction'];
        // message lines should not exceed 70 characters (PHP rule), so wrap it
        $message = wordwrap($message, 70);
        mail($to, $subject, $message, "From: $hshsl_email\n");
    }

    /**
     * Convert a Stripe error code, e.g. invalid_request_error, api_error, card_error, into
     * a less-informative error code we can show to an end-user without revealing anything
     * about the internal structure of the failure.
     *
     * @param str $str Stripe error code
     * @return string user-appropriate error code
     */
    private function error_code($str)
    {
        if (! isset($this->error_codes)) {
            $this->error_codes = config_item('stripe_error_codes');
        }

        if (array_key_exists($str, $this->error_codes))
        {
            return $this->error_codes[$str]->code;
        }

        // unknown error code
        return 'e400';
    }
}

