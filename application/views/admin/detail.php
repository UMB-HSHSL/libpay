<div class="row row-centered text-center">
  <div class="col-md-12 col-md-offset-0">
      <div class="page-header">
        <h2 class="">Secure Payment Receipt for UMB HS/HSL</h2>
      </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-1 center-block"><?php echo cc_img($receipt->card->brand) ?></div>
  <div class="col-xs-11"><h1>$<?php echo (int) ($receipt->amount / 100), '.', (int) ($receipt->amount % 100)  ?></h1></div>
</div>
<div class="row">
  <div class="col-xs-11 col-xs-offset-1 center-block">&mdash;<?php echo $charge->stripe_id ?></div>
</div>

<h2>Payment Details</h2>
<div class="row">
  <div class="col-xs-12 center-block">
  <dl class="libpay_details">
    <dt>Amount</dt><dd>$<?php echo (int) ($receipt->amount / 100), '.', (int) ($receipt->amount % 100)  ?></dd>
    <dt>Date</dt><dd><?php echo date('F j, Y g:i:s a', $receipt->created) ?></dd>
    <dt>Status</dt><dd><?php echo $receipt->status ?></dd>
    <dt>Cleared</dt><dd><?php echo ($charge->hshsl_cleared ? '&#x2713;' : "&nbsp;");?></dd>
    <dt>Description</dt><dd><?php echo xss_clean($charge->hshsl_category); if ($charge->hshsl_category_other) echo xss_clean("({$charge->hshsl_category_other})"); ?></dd>
    <dt>Instructions</dt><dd><?php echo xss_clean($charge->instruction); ?>&nbsp;</dd>
    <dt>Invoice No.</dt><dd><?php echo xss_clean($charge->invoice_no); ?>&nbsp;</dd>
    </dl>
  </div>
</div>

<h2>Patron Details</h2>
<div class="row">
  <div class="col-xs-12 center-block">
  <dl class="libpay_details">
    <dt>Patron</dt><dd><?php echo xss_clean($charge->patron_name) ?></dd>
    <dt>UMID</dt><dd><?php echo xss_clean($charge->umid) ?></dd>
    <dt>Email</dt><dd><?php echo auto_link($charge->email) ?></dd>
    <dt>Phone</dt><dd><?php echo $charge->phone ?></dd>
    </dl>
  </div>
</div>
