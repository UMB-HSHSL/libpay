<div class="row row-centered">
  <div class="col-md-12 col-md-offset-0">
  <div class="page-header">
    <h2 class="gdfg">Secure Payment Form for UMB HS/HSL</h2>
  </div>
  <div class="alert alert-danger" id="payment-error" style="display: none;">
    <strong>Error!</strong>
    <span class="payment-errors"></span>
  </div>

  <?php echo $this->template->content; ?>

  <span class="payment-success">
  
  <div style="background-color: #ccc; border: 2px solid blue;"><pre><?php print_r($stripe_response) ?></pre></div>
  
  <?php echo $success ? "SUCCESS": "FAIL"?>
  </span>

</div></div>