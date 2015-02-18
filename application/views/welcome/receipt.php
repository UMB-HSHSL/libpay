<div class="row row-centered text-center">
  <div class="col-md-12 col-md-offset-0">
      <div class="page-header">
        <h2 class="">Secure Payment Receipt for UMB HS/HSL</h2>
      </div>
  </div>
</div>
  
  
  
  <div class="alert alert-danger" id="payment-error" style="display: none;">
    <strong>Error!</strong>
    <span class="payment-errors"></span>
  </div>


<div class="payment-success">

<div class="row text-center">
  <div class="col-sm-12 col-md-offset-0">
    <div class="receipt-logo"><img src="<?php echo $account->business_logo ?>"></div>
  </div>
</div>
<div class="row row-centered text-center">
  <div class="col-sm-12 col-md-offset-0 text-center">
    <h3>$<?php echo (int) ($receipt->amount / 100), '.', (int) ($receipt->amount % 100)  ?> at <?php echo $account->business_name ?></h3>
    <hr>
  </div>
</div>
<div class="row row-centered text-center">
  <div class="col-sm-12 col-md-offset-0 center-block">
    <?php echo cc_img($receipt->card->brand) ?> <?php echo $receipt->card->last4 ?>
  </div>
</div>

<div class="row row-centered text-center">
  <div class="col-md-3 col-md-offset-4 col-xs-6 col-xs-offset-0 text-left">
    <?php echo date('F j, Y', $receipt->created) ?>
  </div>
  <div class="col-md-1 col-xs-6 text-right">
    <?php echo $receipt->invoice ?>
  </div>
</div>


<div class="row row-centered text-center">
  <div class="col-md-3 col-md-offset-4 col-xs-6 col-xs-offset-0 text-left">
    Description
  </div>
  <div class="col-md-1 col-xs-6 text-right">
    Total
  </div>
</div>
<div class="row row-centered text-center">
  <div class="col-md-3 col-md-offset-4 col-xs-6 col-xs-offset-0 text-left">
    <?php echo $receipt->description ?>
  </div>
  <div class="col-md-1 col-xs-6 text-right">
    $<?php echo (int) ($receipt->amount / 100), '.', (int) ($receipt->amount % 100)  ?>
  </div>
</div>

<div class="row row-centered text-center">
  <div class="col-xs-12 col-xs-offset-0">
  If you have any questions, please contact us at <?php echo mailto($account->support_email) ?> or call <?php echo $account->support_phone ?>.
  </div>
</div>

</div>