<!doctype html>
<!--[if IE]><![endif]-->
<html lang="en">
<head>
<title><?php echo $this->template->title ?></title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">

<?php require_once config_item('www_root') . '/bin/includes/head.bs332.html' ?>
<link rel="stylesheet" href="/bin/css/homepage.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-formhelpers-min.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrapValidator-min.css"/>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-side-notes.css" />

<style type="text/css">
.col-centered {
    display:inline-block;
    float:none;
    text-align:left;
    margin-right:-4px;
}
.row-centered {
    margin-left: 9px;
    margin-right: 9px;
}
</style>




<?php echo $this->template->head ?>

</head>
<body>

<?php require_once config_item('www_root') . '/bin/includes/header-homepage.html' ?>
<?php require_once config_item('www_root') . '/bin/includes/header-print.html' ?>

<!--START CONTENT-->
<div id="Content" class="texture"> <!--grey or white or texture-->
  <div class="shadowclip">
    <div class="shadow"> <!--shadow or noshadow-->

<div class="row-fluid">
  <div class="span12 transition">
	<?php echo $this->template->content ?>
  </div>
</div>


      <br style="clear:both" />
    </div>
    <!--END SHADOWCLIP-->
  </div>
  <!--END SHADOW-->
</div>
<!--END CONTENT-->




<?php require_once config_item('www_root') . '/bin/includes/footer.bs332.html' ?>

<script type="text/javascript" src="//js.stripe.com/v2/"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap-min.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap-formhelpers-min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/bootstrapValidator-min.js"></script>

<?php echo $this->template->javascript ?>
<?php echo $this->template->foot ?>


</body>
</html>
