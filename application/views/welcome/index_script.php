<script type="text/javascript">
// this identifies your website in the createToken call below
Stripe.setPublishableKey('<?php echo $this->template->stripe_public_key ?>');
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