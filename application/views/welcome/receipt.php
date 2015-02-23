<div class="row row-centered text-center">
  <div class="col-md-12 col-md-offset-0">
      <div class="page-header">
        <h2 class="">Secure Payment Receipt for UMB HS/HSL</h2>
      </div>
  </div>
</div>
  
  
<?php 
if ($success) {
?>

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
  <div class="col-sm-12 center-block">
    <?php echo cc_img($receipt->card->brand) ?> <?php echo $receipt->card->last4 ?>
  </div>
</div>

<div class="row row-centered text-center">
  <div class="col-sm-12 center-block">
    <?php echo date('F j, Y g:i:s a', $receipt->created) ?>
  </div>
</div>
<div class="row row-centered text-center">
  <div class="col-sm-12 center-block">
    Transaction ID <?php echo $receipt->id ?>
  </div>
</div>

<div class="row row-centered text-center">
    <div class="col-md-6 col-md-offset-3 col-sm-12 text-left">
    <table class="table table-striped">
    <tbody>
    <tr><td>Patron</td><td class="text-right"><?php echo $details->patron_name ?></td></tr>
    <tr><td>UMID</td><td class="text-right"><?php echo $details->umid ?></td></tr>
    <tr><td>Email</td><td class="text-right"><?php echo $details->email ?></td></tr>
    <tr><td>Phone</td><td class="text-right"><?php echo substr($details->phone, 0, 3) .'-'.substr($details->phone, 3, 3).'-'.substr($details->phone, 6);
     ?></td></tr>
    <tr><td>Description</td><td class="text-right"><?php echo $details->hshsl_category; if ($details->hshsl_category_other) echo "({$details->hshsl_category_other})"; ?></td></tr>
    <tr><td><strong>Total</strong></td><td class="text-right">$<?php echo (int) ($receipt->amount / 100), '.', (int) ($receipt->amount % 100)  ?></td></tr>
    </tbody>
    </table>
    </div>
</div>



<div class="row row-centered text-center">
  <div class="col-xs-12 col-xs-offset-0">
  If you have any questions, please contact us at <?php echo mailto($account->support_email) ?> or call <?php echo substr($account->support_phone, 0, 3) .'-'.substr($account->support_phone, 3, 3).'-'.substr($account->support_phone, 6) ?>.
  </div>
</div>

</div>

<?php 
} else {
?>
<h1>ERROR</h1>
  <div class="alert alert-danger" id="payment-error">
    <strong>Error!</strong>
    <span class="payment-errors">
    <?php echo '<pre>', print_r($error, 1), '</pre>' ?>
    </span>
  </div>

<?php 
    
}
?>