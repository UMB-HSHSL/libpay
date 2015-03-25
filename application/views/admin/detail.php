<div class="row">
  <div class="col-xs-1 center-block"><?php echo cc_img($receipt->source->brand) ?></div>
  <div class="col-xs-11"><h1>$<?php printf("%.2f", $receipt->amount / 100) ?></h1></div>
</div>
<div class="row">
  <div class="col-xs-11 col-xs-offset-1 center-block">&mdash;<?php echo $charge->stripe_id ?></div>
</div>

<h3>Payment Details (<?php echo anchor("admin/receipt/{$charge->id}", "receipt", "target='new'") ?>)</h3>
<div class="row">
  <div class="col-xs-12 center-block">
  <dl class="libpay_details">
    <dt>Amount</dt><dd>$<?php printf("%.2f", $receipt->amount / 100) ?></dd>
    <dt>Date</dt><dd><?php echo date('F j, Y g:i:s a', $receipt->created) ?></dd>
    <dt>Status</dt><dd><?php echo $receipt->status ?></dd>
    <dt>Description</dt><dd><?php echo xss_clean($charge->hshsl_category); if ($charge->hshsl_category_other) echo xss_clean("({$charge->hshsl_category_other})"); ?></dd>
    <dt>Instructions</dt><dd><?php echo xss_clean($charge->instruction); ?>&nbsp;</dd>
    <dt>Invoice No.</dt><dd><?php echo xss_clean($charge->invoice_no); ?>&nbsp;</dd>
    <dt>Cleared</dt><dd><?php echo cleared($charge) ?></dd>
    </dl>
  </div>
</div>

<h3>Patron Details</h3>
<div class="row">
  <div class="col-xs-12 center-block">
  <table>
  <tr><th>Patron</th><td><?php echo xss_clean($charge->patron_name) ?></td></tr>
  <tr><th>Campus ID Barcode</th><td><?php echo xss_clean($charge->umb_barcode) ?></td></tr>
  <tr><th>Email</th><td><?php echo auto_link($charge->email) ?></td></tr>
  <tr><th>Phone</th><td><?php echo xss_clean($charge->phone) ?></td></tr>
  </table>
  </div>
</div>
