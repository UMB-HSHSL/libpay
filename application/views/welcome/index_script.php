<script type="text/javascript">
Stripe.setPublishableKey('<?php echo $this->template->stripe_public_key ?>');

function stripeResponseHandler(status, response) {
	if (response.error) {
		$("body").scrollTop(0);
        $('.submit-button').prop('disabled', false);
        document.getElementById('a_x200').style.display = 'block';
        $(".payment-errors").html(response.error.message);
    }
    else {
        var form$ = $("#payment-form");
        var token = response.id;
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        form$.get(0).submit();
    }
}

var Hshsl = (function(){

	this.acceptedCards = ['<?php echo implode("','", array_map('strtoupper', config_item('stripe_valid_brands')))?>'];

    return this;
})();
</script>