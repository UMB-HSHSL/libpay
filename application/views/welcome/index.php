<?php echo validation_errors(); ?>

<?php echo form_open('', 'id="payment-form" class="form-horizontal" autocomplete="off"')?>
  <div class="row row-centered">
  <div class="col-md-12">
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

<!-- PAYMENT FORM -->
  <fieldset>
  <!-- Form Name -->
  <legend>Patron and Payment Details</legend>

    <!-- Fee Category-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="textinput">Fee Category</label>
      <div class="col-sm-6">
          <select name="hshsl_category" id="hshsl_category" required>
            <option value="Library Fines" selected="selected">Library Fines</option>
            <option value="Classroom Reservation">Classroom Rental</option>
            <option value="Membership">Membership</option>
            <option value="3D Printing">3D Printing</option>
            <option value="Other">Other</option>
            </select>
      </div>
    </div>

  <!-- "Other" fee category description -->
  <div class="form-group" id="category_other" style="display: none">
    <div class="col-sm-6 col-sm-offset-4">
      <input type="text" name="hshsl_category_other" placeholder="Other" class="hshsl-category-other form-control">
    </div>
  </div>


  <!-- Invoice number -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Invoice or Barcode No.</label>
    <div class="col-sm-6">
      <input type="text" name="invoice_no" placeholder="If applicable" class="invoice form-control">
    </div>
  </div>

  <!-- Amount -->
  <div class="form-group">
    <label class="col-sm-4 control-label" for="textinput">Payment Amount</label>
    <div class="col-sm-6">
        <div class="form-inline">
            $ <input type="text" size="3" name="hshsl_amount_dollar" placeholder="" class="amount form-control hshsl-amount-dollar">
            <span>.</span>
            <input type="text" size="1" maxlength="2" name="hshsl_amount_cents" placeholder="" class="amount form-control hshsl-amount-cents">
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
        <p class="help-block">The following cards are accepted: <?php echo implode(", ", array_map('ucfirst', config_item('stripe_valid_brands')))?>.</p>
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
        <p>Your card will be charged for the amount you entered after you click "Pay Now".</p>
        <p>Your account statement will show the following booking text:
          <?php echo $this->template->business_name ?> </p>
      </div>
    </div>

    <!-- Submit -->
    <div class="control-group">
      <div class="controls">
        <center>
          <button class="btn btn-success submit-button" type="submit">Pay Now</button>
        </center>
      </div>
    </div>
  </fieldset>
</form>
</div></div>