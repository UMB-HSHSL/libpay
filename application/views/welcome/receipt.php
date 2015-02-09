  <div class="row row-centered">
  <div class="col-md-12 col-md-offset-0">
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

  <?php echo $this->template->content; ?>

  <span class="payment-success">
  
  <div style="background-color: #ccc; border: 2px solid blue;"><pre><?php print_r($stripe_response) ?></pre></div>
  
  <?php echo $this->template->success ?>
  <?php echo $this->template->error ?>
  </span>

</div></div>
