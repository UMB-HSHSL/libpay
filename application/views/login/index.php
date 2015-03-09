<?php echo flash_message(); ?>

<?php echo validation_errors(); ?>

<?php echo form_open('', 'id="payment-form" class="form-horizontal" autocomplete="off"')?>
  <div class="row row-centered">
  <div class="col-xs-12 col-xs-offset-0">

  <fieldset>

  <div class="form-group">
    <label class="col-xs-4 control-label" for="textinput">Username</label>
    <div class="col-xs-4">
      <input type="text" name="username" placeholder="hshslstaff\username" class="form-control">
    </div>
  </div>

  <div class="form-group">
    <label class="col-xs-4 control-label" for="textinput">Password</label>
    <div class="col-xs-4">
      <input type="password" name="password" placeholder="password" class="form-control">
    </div>
  </div>
  </fieldset>

  <fieldset>
    <!-- Submit -->
    <div class="control-group">
      <div class="controls">
        <center>
          <button class="btn btn-success submit-button" type="submit">Sign In</button>
        </center>
      </div>
    </div>
  </fieldset>
</div></div>
</form>
