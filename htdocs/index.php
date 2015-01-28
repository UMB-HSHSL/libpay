<?php
require '../vendor/autoload.php';
require '../config/credentials.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Secure Payment Form for UMB HS/HSL</title>
<link rel="stylesheet" href="css/bootstrap-min.css">
<link rel="stylesheet" href="css/bootstrap-formhelpers-min.css" media="screen">
<link rel="stylesheet" href="css/bootstrapValidator-min.css"/>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<link rel="stylesheet" href="css/bootstrap-side-notes.css" />
<style type="text/css">
.col-centered {
    display:inline-block;
    float:none;
    text-align:left;
    margin-right:-4px;
}
.row-centered {
    margin-left: 9px;
    margin-right: 9px;
}
</style>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap-min.js"></script>
<script src="js/bootstrap-formhelpers-min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator-min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#payment-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        submitHandler: function(validator, form, submitButton) {
        var chargeAmount = 3000;
        // amount you want to charge, in cents. 1000 = $10.00, 2000 = $20.00 ...
        // createToken returns immediately - the supplied callback submits the form if there are no errors
        Stripe.createToken({
              number: $('.card-number').val(),
              cvc: $('.card-cvc').val(),
              exp_month: $('.card-expiry-month').val(),
              exp_year: $('.card-expiry-year').val(),
              name: $('.card-holder-name').val(),
              address_line1: $('.address').val(),
              address_city: $('.city').val(),
              address_zip: $('.zip').val(),
              address_state: $('.state').val(),
              address_country: $('.country').val()
            },
            chargeAmount,
            stripeResponseHandler
        );
          return false; // submit from callback
        }, //submithandler
        fields: {

            hshsl_amount_dollar: {
                validators: {
                    digits: {
                        message: 'The amount (dollar) can contain digits only'
                    },
                    notEmpty: {
                        message: 'The amount (dollar) is required'
                    }
                }
            },
            hshsl_amount_cents: {
                validators: {
                    digits: {
                        message: 'The amount (cents) can contain digits only'
                    },
                    notEmpty: {
                        message: 'The amount (cents) is required'
                    }
                }
            },
            patron_name: {
                validators: {
                    notEmpty: {
                        message: 'The Patron Name is required and cannot be empty'
                    }
              }
            },

            umid: {
                validators: {
                    notEmpty: {
                        message: 'The UMID is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The card holder name must be more than 3 and less than 20 characters long'
                    }
                }
            },

            phone: {
                validators: {
                    digits: {
                        message: 'The phone number can contain digits only'
                    },
                    notEmpty: {
                        message: 'The phone number is required'
                    }
                }
            },

            street: {
                validators: {
                    notEmpty: {
                        message: 'The street is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 96,
                        message: 'The street must be more than 6 and less than 96 characters long'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'The city is required and cannot be empty'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'The state is required and cannot be empty'
                    }
                }
            },
         zip: {
                validators: {
                    notEmpty: {
                        message: 'The zip is required and cannot be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 9,
                        message: 'The zip must be more than 3 and less than 9 characters long'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
                    stringLength: {
                        min: 6,
                        max: 65,
                        message: 'The email must be more than 6 and less than 65 characters long'
                    }
                }
            },
            cardholdername: {
                validators: {
                    notEmpty: {
                        message: 'The card holder name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 70,
                        message: 'The card holder name must be more than 6 and less than 70 characters long'
                    }
                }
            },
            cardnumber: {
                selector: '#cardnumber',
                validators: {
                    notEmpty: {
                        message: 'The credit card number is required and can\'t be empty'
                    },
                    creditCard: {
                        message: 'The credit card number is invalid'
                    },
                }
            },
            expMonth: {
                selector: '[data-stripe="exp-month"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration month is required'
                    },
                    digits: {
                        message: 'The expiration month can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var year         = validator.getFieldElements('expYear').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                validator.updateStatus('expYear', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            expYear: {
                selector: '[data-stripe="exp-year"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration year is required'
                    },
                    digits: {
                        message: 'The expiration year can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var month        = validator.getFieldElements('expMonth').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 100) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                validator.updateStatus('expMonth', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            cvv: {
                selector: '#cvv',
        validators: {
            notEmpty: {
                message: 'The cvv is required and can\'t be empty'
            },
            cvv: {
                message: 'The value is not a valid CVV',
                creditCardField: 'cardnumber'
            }
        }//validators
      }, //cvv
    } //fields
  }); //bootstrapValidator
}); //doc ready
</script>

<script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('<?php echo STRIPE_PUBLIC_KEY ?>');
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");

                    // show hidden div
                    document.getElementById('a_x200').style.display = 'block';

                    // show the errors on the form
                    $(".payment-errors").html(response.error.message);
                }
                else {
                    var form$ = $("#payment-form");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    form$.get(0).submit();
                }
            }
</script>
</head>
<body>

<form action="" method="POST" id="payment-form" class="form-horizontal">
  <div class="row row-centered">
  <div class="col-md-4 col-md-offset-4">
  <div class="page-header">
    <h2 class="gdfg">Secure Payment Form for UMB HS/HSL</h2>
  </div>
  <noscript>
  <div class="bs-callout bs-callout-danger">
    <h4>JavaScript is not enabled!</h4>
    <p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a> for more informations.</p>
  </div>
  </noscript>
  <div class="alert alert-danger" id="a_x200" style="display: none;">
    <strong>Error!</strong>
    <span class="payment-errors"></span>
  </div>


<!-- PAYMENT PROCESSING -->
<?php

if ($_POST) {
  Stripe::setApiKey(STRIPE_SECRET_KEY);
  $error = '';
  $success = '';

  try {
  	if (empty($_POST['hshsl_amount_dollar']) || empty($_POST['hshsl_amount_cents']) || empty($_POST['hshsl_category']) || empty($_POST['patron_name']) || empty($_POST['street']) || empty($_POST['city']) || empty($_POST['zip'])) {
        throw new Exception("Fill out all required fields.");
    }
    if (!isset($_POST['stripeToken'])) {
        throw new Exception("The Stripe Token was not generated correctly");
    }
        Stripe_Charge::create(array("amount" => (($_POST['hshsl_amount_dollar'])*100)+($_POST['hshsl_amount_cents']),
                                "currency" => "usd",
                                "card" => $_POST['stripeToken'],
								                "description" => $_POST['hshsl_category'],
                                "receipt_email" => $_POST['email'],
                                ));
        error_log($_POST['email']);
        $success = '<div class="alert alert-success">
<strong>Success!</strong> Your payment of $'.$_POST['hshsl_amount_dollar'].'.'.$_POST['hshsl_amount_cents'].' was successful. The confirmation e-mail will be sent to '.$_POST['email'].'.</div>'.$_POST['email'];
/*
    $to = $_POST["email"];
    $receipt_to = $_POST["email"]; // sender
    $subject = "HSHSL Payment Confirmation";
    $hshsl_email = "cats@hshsl.umaryland.edu";
    $to = "bkim@hshsl.umaryland.edu";
    $message ="Thank you for your payment. Please retain this email as the receipt of your payment.";
    $message.="\n\nYour Name: ".$_POST['patron_name'];
    $message.="\nYour UMID: ".$_POST['umid'];
    $message.="\nAmount: $";
    $message.=$_POST['hshsl_amount_dollar'].".".$_POST['hshsl_amount_cents'];
    $message.="\nCategory: ".$_POST['hshsl_category'];
    $message.="\nInvoice No. (If Applicable): ".$_POST['invoice_no'];
    $message.="\nSpecial Instructions. (If Applicable): ".$_POST['instruction'];
    // message lines should not exceed 70 characters (PHP rule), so wrap it
    $message = wordwrap($message, 70);
    mail($to,$subject,$message,"From: $hshsl_email\n");
*/
// $headers = "From: $hshsl_email\n";
// mail($to,$subject,$message,$headers);


  }//try
  catch (Exception $e) {
    $error = '<div class="alert alert-danger"><strong>Error!</strong> '.$e->getMessage().'  </div>';
  }//catch

// SEND CONFIRMATION EMAIL TO PATRON IF CHARGE SUCCEEDED.
?>

  <span class="payment-success">
  <?php echo $success ?>
  <?php echo $error ?>
  </span>
<?php
} //if post

//DISPLAY FORM IF NOT SUBMITTED
else{
?>

<!-- PAYMENT FORM -->
  <fieldset>
  <!-- Form Name -->
  <legend>Patron and Payment Details</legend>

    <!-- Fee Category-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">Fee Category</label>
      <div class="col-sm-6">
          <select name="hshsl_category">
            <option value="Library Fines" selected="selected">Library Fines</option>
            <option value="Classroom Reservation">Classroom Reservation</option>
            <option value="Invoice">Invoice/Membership</option>
            <option value="Inter-Library Loan">Inter-Library Loan</option>
            <option value="Other">Other</option>
          </select>
      </div>
    </div>

  <!-- Invoice number -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Invoice No.</label>
    <div class="col-sm-6">
      <input type="text" name="invoice_no" placeholder="If applicable" class="invoice form-control">
    </div>
  </div>

  <!-- Amount -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Payment Amount</label>
    <div class="col-sm-6">
        <div class="form-inline">
            $ <input type="text" size="3" name="hshsl_amount_dollar" placeholder="" class="amount form-control">
            <span>.</span>
            <input type="text" size="1" maxlength="2" name="hshsl_amount_cents" placeholder="" class="amount form-control">
        </div>
    </div>
  </div>

  <!-- Patron Name -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Patron Name</label>
    <div class="col-sm-6">
      <input type="text" name="patron_name" placeholder="Patron Name" class="patron_name form-control">
    </div>
  </div>

  <!-- UMID -->
  <!-- As of July 15, 2013, the UMID may contain letters, numbers and the 3 following special characters
(underscore, period and/or dash). The UMID must be between 3 and 20 characters in length. -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Patron UMID</label>
    <div class="col-sm-6">
      <input type="text" name="umid" placeholder="umid" class="umid form-control">
    </div>
  </div>


  <!-- Phone -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Phone</label>
    <div class="col-sm-6">
      <input type="text" name="phone" maxlength="12" placeholder="phone (111-222-3333)" class="phone form-control">
    </div>
  </div>

  <!-- Email -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">E-mail</label>
    <div class="col-sm-6">
      <input type="text" name="email" maxlength="65" placeholder="Email" class="email form-control">
    </div>
  </div>

   <!-- Instruction -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Special Instructions</label>
    <div class="col-sm-6">
      <textarea name="instruction" placeholder="Special Instructions" class="instruction form-control"></textarea>
    </div>
  </div>
  </fieldset>


  <fieldset>
    <legend>Billing Address</legend>

  <!-- Street -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Street</label>
    <div class="col-sm-6">
      <input type="text" name="street" placeholder="Street" class="address form-control">
    </div>
  </div>

  <!-- City -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">City</label>
    <div class="col-sm-6">
      <input type="text" name="city" placeholder="City" class="city form-control">
    </div>
  </div>

  <!-- State -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">State</label>
    <div class="col-sm-6">
      <input type="text" name="state" maxlength="65" placeholder="State (e.g. MD)" class="state form-control">
    </div>
  </div>

  <!-- Postcal Code -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Postal Code</label>
    <div class="col-sm-6">
      <input type="text" name="zip" maxlength="9" placeholder="Postal Code" class="zip form-control">
    </div>
  </div>

  <!-- Country
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Country</label>
    <div class="col-sm-6">
      <div class="country bfh-selectbox bfh-countries" name="country" placeholder="Select Country" data-flags="true" data-filter="true"> </div>
    </div>
  </div>
-->
   </fieldset>

  <fieldset>
    <legend>Credit/Debit Card Details</legend>

    <!-- Card Holder Name -->
    <div class="form-group">
      <label class="col-sm-4 control-label"  for="textinput">Card Holder's Name</label>
      <div class="col-sm-6">
        <input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name" class="card-holder-name form-control">
      </div>
    </div>

    <!-- Card Number -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">Card Number</label>
      <div class="col-sm-6">
        <input type="text" id="cardnumber" maxlength="19" placeholder="Card Number" class="card-number form-control">
      </div>
    </div>

    <!-- Expiry-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">Card Expiry Date</label>
      <div class="col-sm-6">
        <div class="form-inline">
          <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
            <option value="01" selected="selected">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          <span> / </span>
          <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control">
          </select>
          <script type="text/javascript">
            var select = $(".card-expiry-year"),
            year = new Date().getFullYear();

            for (var i = 0; i < 12; i++) {
                select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
            }
        </script>
        </div>
      </div>
    </div>

    <!-- CVV -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">CVV/CVV2</label>
      <div class="col-sm-3">
        <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control">
      </div>
    </div>

    <!-- Important notice -->
    <div class="form-group">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Important notice</h3>
      </div>
      <div class="panel-body">
        <p>Your card will be charged for the amount you entered after submit.</p>
        <p>Your account statement will show the following booking text:
          XXXXXXX </p>
      </div>
    </div>

    <!-- Submit -->
    <div class="control-group">
      <div class="controls">
        <center>
          <button class="btn btn-success" type="submit">Pay Now</button>
        </center>
      </div>
    </div>
  </fieldset>


<?php
}//else
?>

</form>
</body>
</html>
