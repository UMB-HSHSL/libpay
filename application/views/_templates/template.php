<!doctype html>
<!--[if IE]><![endif]-->
<html lang="en">
<head>
<title>HS/HSL: <?php echo $this->template->title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="keywords" content="health, library, information, learning, human, research, education, university, clinical, journals, sciences, databases, resources, academic, professional, public, college, maryland, baltimore, medicine, medical, dentistry, dental, nursing, nurse, social, work, law, graduate, studies, school" />
<meta name="description" content="The Health Sciences and Human Services Library is a dynamic institution providing access to digital and print information, and fostering the life-long learning skills essential for health and human services professionals to succeed in the information intense environment of the 21st century." />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"><!-- Bootstrap -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"><!-- Bootstrap 2.0 Theme -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet"><!--Font Awesome Icons From http://www.bootstrapcdn.com/-->
<!--[if IE 7]>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome-ie7.min.css" rel="stylesheet">
<![endif]-->
<link rel="stylesheet" href="//www.hshsl.umaryland.edu/bin/css/foundation.css" type="text/css" media="screen" /><!--HS/HSL Site Foundation-->
<link rel="stylesheet" href="//www.hshsl.umaryland.edu/bin/css/print.css" type="text/css" media="print" /><!--Print-->
<link rel="stylesheet" href="//www.hshsl.umaryland.edu/bin/css/libguide.css" type="text/css" /><!--LibGuides-->

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-formhelpers-min.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrapValidator-min.css"/>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-side-notes.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/libpay.css" />


<link type="image/vnd.microsoft.icon" rel="shortcut icon" href="//www.hshsl.umaryland.edu/favicon.ico">
<link type="image/vnd.microsoft.icon" rel="icon" href="//www.hshsl.umaryland.edu/favicon.ico">

<!-- For iPad with high-resolution Retina display running iOS = 7: -->
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="//www.hshsl.umaryland.edu/bin/img/apple/apple-touch-icon-152x152-precomposed.png">
<!-- For iPad with high-resolution Retina display running iOS = 6: -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="//www.hshsl.umaryland.edu/bin/img/apple/apple-touch-icon-144x144-precomposed.png">
<!-- For iPhone with high-resolution Retina display running iOS = 7: -->
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="//www.hshsl.umaryland.edu/bin/img/apple/apple-touch-icon-120x120-precomposed.png">
<!-- For iPhone with high-resolution Retina display running iOS = 6: -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="//www.hshsl.umaryland.edu/bin/img/apple/apple-touch-icon-114x114-precomposed.png">
<!-- For first- and second-generation iPad: -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="//www.hshsl.umaryland.edu/bin/img/apple/apple-touch-icon-72x72-precomposed.png">
<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: (57x57) -->
<link rel="apple-touch-icon-precomposed" href="//www.hshsl.umaryland.edu/bin/img/apple/apple-touch-icon-precomposed.png">

<!-- iPhone Portrait 320x460-->
<link rel="apple-touch-startup-image" media="(max-device-width: 480px) and not (-webkit-min-device-pixel-ratio: 2)" href="//www.hshsl.umaryland.edu/bin/img/apple/iphone-startup.jpg" />
<!-- iPhone Portrait Retina 640x920 -->
<link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="//www.hshsl.umaryland.edu/bin/img/apple/iphone-startup-x2.jpg" />
<!-- iPhone 5 Portrait 640x1096 -->
<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="//www.hshsl.umaryland.edu/bin/img/apple/iphone5-startup.jpg">
<!-- iPad Portrait 768x1004 -->
<link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: portrait)" href="//www.hshsl.umaryland.edu/bin/img/apple/ipad-startup.jpg" />
<!-- iPad Landscape 748x1024 -->
<link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: landscape)" href="//www.hshsl.umaryland.edu/bin/img/apple/ipad-startup-landscape.jpg" />
<!-- iPad Portrait Retina 1536x2008 -->
<link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 2)" href="//www.hshsl.umaryland.edu/bin/img/apple/ipad-startup-x2.jpg" />
<!-- iPad Landscape Retina 1496x2048 -->
<link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 2)" href="//www.hshsl.umaryland.edu/bin/img/apple/ipad-startup-landscape-x2.jpg" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><!--JQuery from Google-->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script><!--JQuery UI from Google; Used for DatePicker on Forms-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/common.js"></script><!--Common HS/HSL Javascript Functions-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/breadcrums.js"></script><!--Breadcrumbs-->
<!-- Adobe Typekit; Used for Trajan-Pro and Open-Sans
<script type="text/javascript" src="//use.typekit.net/lmr6avg.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
 -->

<!--[if lt IE 8]>
<div class="unsupported-browser">
  <div class="container clearfix">
    <i class="icon-warning-sign icon-4x text-error pull-left" style="margin:0 20px 30px 0;"></i>
    <h5>Please note that the HS/HSL no longer supports Internet Explorer versions 6 or 7.</h5>
    <p>We recommend upgrading to the latest <a href="https://ie.microsoft.com/">Internet Explorer</a>, <a href="https://chrome.google.com">Google Chrome</a>, or <a href="https://mozilla.org/firefox/">Firefox</a>.</p>
    <p>If you are using IE 9 or later, make sure you <a href="http://windows.microsoft.com/en-US/windows7/webpages-look-incorrect-in-Internet-Explorer">turn off "Compatibility View"</a>.</p>
  </div>
</div>
<![endif]-->

<!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="//www.hshsl.umaryland.edu/bin/css/ie/ie.css" />
  <script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/modernizr.js"></script>
<![endif]-->

<!--[if gte IE 9]>
  <style type="text/css">
    #alerts.gradient,
    #searchbox.gradient,
    #rss-container.gradient,
    nav.popular ul li a.gradient,
    nav.popular ul li a.gradient:hover,
    .nav li.active a,
    div.dropdown > ul {
    	filter:none;
    }
  </style>
<![endif]-->

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.css">

</head>
<body>

<div id="HeaderContainer">
  <div id="Header">
    <div class="header-search">
      <div id="desktop-rss">
        <div class="rss">
          <div id="rss-container">
            <div style="margin: -10px 0px 10px;"> <a href="http://www.umaryland.edu" target="_blank"><img src="//www.hshsl.umaryland.edu/bin/img/Campus_Website_Icon@2x.png" class="hires" width="61" height="18" alt="UM Home" title="UM Home" /></a> | <a href="http://elm.umaryland.edu/" target="_blank"><img src="//www.hshsl.umaryland.edu/bin/img/TheElm_Icon@2x.png" class="hires" width="59" height="18" alt="The Elm" title="The Elm" /></a> | <a href="http://www.umaryland.edu/shuttlebus/" target="_blank"><img src="//www.hshsl.umaryland.edu/bin/img/UMshuttle_Icon@2x.png" class="hires" width="80" height="18" alt="UM Shuttle" title="UM Shuttle" /></a> | <a href="http://m.umaryland.edu/info/" target="_blank"><img src="//www.hshsl.umaryland.edu/bin/img/MobileUMB_Icon@2x.png" class="hires" width="78" height="18" alt="Mobile UMB" title="Mobile UMB" /></a> </div>
            <h3>Search the Library Website</h3>

            <form name="cse-search-box" id="cse-search-box-01" action="http://www.hshsl.umaryland.edu/search.cfm">
              <input type="hidden" value="000680159333302753794:kbzziifcala" name="cx">
              <input type="hidden" value="FORID:11" name="cof">
              <input type="hidden" value="UTF-8" name="ie">
              <i class="icon-remove-sign icon-large" id="icon_clear2"></i>
              <div class="input-group" style="margin-bottom:0; float:right; max-width:310px;">
                <input type="text" id="q" name="q" class="form-control" style="padding-right: 35px;" />
                <span class="input-group-btn">
                <input type="submit" value="Search" id="hsl_submit-01" name="sa" class="btn btn-default">
                </span> </div>
            </form>
          </div>
        </div>
      </div>
      <div id="LibraryLogo"><a href="http://www.hshsl.umaryland.edu/"><img src="//www.hshsl.umaryland.edu/bin/img/logo-200@2x.png" class="hires" width="340" height="96" alt="" /></a></div>
    </div>

    <!--START HEADER SEARCH MOBILE-->
    <div class="header-search-mobile">
      <div id="LibraryLogo"><a href="http://www.hshsl.umaryland.edu/"><img src="//www.hshsl.umaryland.edu/bin/img/logo-200@2x.png" class="hires" width="340" height="96" alt="" /></a></div>
    </div>
    <!--END HEADER SEARCH MOBILE-->

  </div>
  <!--Header-->
</div>
<!--HeaderContainer-->

<!--START MOBILE NAVIGATION-->
<div id="mobile-nav">
  <div class="YellowBar"></div>
  <div class="main-nav">
    <button type="button" class="btn btn-inverse btn-block" style="padding:11px 0;" data-toggle="collapse" data-target="#collapseOne"> <i class="icon-list icon-white"></i> &nbsp;Menu </button>
    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
        <ul class="nav nav-tabs nav-stacked">
          <li>

           <form name="cse-search-box" id="cse-search-box-02" action="http://www.hshsl.umaryland.edu/search.cfm">
              <input type="hidden" value="000680159333302753794:kbzziifcala" name="cx">
              <input type="hidden" value="FORID:11" name="cof">
              <input type="hidden" value="UTF-8" name="ie">
              <div id="parent">
                <div id="inner" style="display: table; width: 95%; margin: 10px auto;">
                  <input type="text" id="q3" name="q" placeholder="Search Library Website" class="form-control" style="width: 100%; margin:0;">
                  <span class="input-group-btn">
                    <input type="submit" value="Search" id="hsl_submit-02" name="sa" class="btn btn-default">
                  </span>
                </div>
              </div>
            </form>
          </li>
          <li><a href="http://www.hshsl.umaryland.edu/resources/">Resources <i class="icon-chevron-right icon-white pull-right"></i></a></li>
          <li><a href="http://www.hshsl.umaryland.edu/services/">Services <i class="icon-chevron-right icon-white pull-right"></i></a></li>
          <li><a href="http://www.hshsl.umaryland.edu/assistance/">Assistance <i class="icon-chevron-right icon-white pull-right"></i></a></li>
          <li><a href="http://www.hshsl.umaryland.edu/about/">About the Library <i class="icon-chevron-right icon-white pull-right"></i></a></li>
          <li><a href="http://gateway.hshsl.umaryland.edu/eresources.gw?id=7114"><i class="icon-search icon-flip-horizontal"></i>neSearch <i class="icon-chevron-right icon-white pull-right"></i></a></li>
          <li><a href="http://www.hshsl.umaryland.edu/assistance/askus.cfm"><i class="icon-comment-alt"></i> Ask Us! <i class="icon-chevron-right icon-white pull-right"></i></a></li>
          <li>
            <button type="button" class="btn btn-link" style="font-size: 16px; padding: 15px 12px; text-align: left; width: 100%;" data-toggle="collapse" data-target="#collapseTwo"><i class="icon-share-alt"></i> Follow Us! <i class="icon-chevron-right icon-white pull-right"></i></button>
            <div id="collapseTwo" class="accordion-body collapse">
              <div class="accordion-inner">
                <ul class="nav nav-tabs nav-stacked">
                  <li><a target="_blank" title="Like us on Facebook" href="https://www.facebook.com/umbhshsl"><i class="icon-facebook-sign icon-large icon-fixed-width"></i> &nbsp;Facebook</a></li>
                  <li><a target="_blank" title="Follow us on Twitter" href="https://twitter.com/hshsl"><i class="icon-twitter icon-large icon-fixed-width"></i> &nbsp;Twitter</a></li>
                  <li><a target="_blank" title="Watch us on YouTube" href="http://www.youtube.com/user/hshsl"><i class="icon-youtube-play icon-large icon-fixed-width"></i> &nbsp;YouTube</a></li>
                  <li><a target="_blank" title="Subscribe to HS/HSL Updates via RSS" href="http://feeds2.feedburner.com/hshsl-updates"><i class="icon-rss icon-large icon-fixed-width"></i> &nbsp;HS/HSL Updates RSS Feed</a></li>
                  <li><a target="_blank" title="The E-Newsletter of the HS/HSL" href="http://www.hshsl.umaryland.edu/newsletter/"><i class="icon-copy icon-large icon-fixed-width"></i> &nbsp;Connective Issues Newsletter</a></li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!--END MOBILE NAVIGATION-->

<!--START DESKTOP NAVIGATION-->
<div id="desktop-nav">
  <div class="YellowBar"></div>
  <div class="main-nav">
    <div class="btn-toolbar">
      <div class="btn-group">
        <a href="http://www.hshsl.umaryland.edu/" class="btn btn-inverse"><i class="icon-home icon-large"></i></a>
      </div>
      <div class="btn-group">
        <a href="http://www.hshsl.umaryland.edu/resources/" class="btn btn-inverse">Resources</a>
        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
        <ul id="menuresources" class="dropdown-menu">
        </ul>
      </div>
      <div class="btn-group">
        <a href="http://www.hshsl.umaryland.edu/services/" class="btn btn-inverse">Services</a>
        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
        <ul id="menuservices" class="dropdown-menu">
        </ul>
      </div>
      <div class="btn-group">
        <a href="http://www.hshsl.umaryland.edu/assistance/" class="btn btn-inverse">Assistance</a>
        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
        <ul id="menuassistance" class="dropdown-menu">
        </ul>
      </div>
      <div class="btn-group">
        <a href="http://www.hshsl.umaryland.edu/about/" class="btn btn-inverse">About the Library</a>
        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
        <ul id="menuabout" class="dropdown-menu">
        </ul>
      </div>
      <div class="btn-group pull-right">
        <a href="http://gateway.hshsl.umaryland.edu/eresources.gw?id=7114" class="btn btn-inverse"><i class="icon-search icon-flip-horizontal"></i>neSearch</a>
        <a href="http://www.hshsl.umaryland.edu/assistance/askus.cfm" class="btn btn-inverse"><i class="icon-comment-alt"></i> Ask Us!</a>
        <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-share-alt"></i> Follow Us &nbsp;<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a target="_blank" title="Like us on Facebook" href="https://www.facebook.com/umbhshsl"><i class="icon-facebook-sign icon-large icon-fixed-width"></i> &nbsp;Facebook</a></li>
          <li><a target="_blank" title="Follow us on Twitter" href="https://twitter.com/hshsl"><i class="icon-twitter icon-large icon-fixed-width"></i> &nbsp;Twitter</a></li>
          <li><a target="_blank" title="Watch us on YouTube" href="http://www.youtube.com/user/hshsl"><i class="icon-youtube-play icon-large icon-fixed-width"></i> &nbsp;YouTube</a></li>
          <li><a target="_blank" title="Subscribe to HS/HSL Updates via RSS" href="http://feeds2.feedburner.com/hshsl-updates"><i class="icon-rss icon-large icon-fixed-width"></i> &nbsp;HS/HSL Updates RSS Feed</a></li>
          <li><a target="_blank" title="The E-Newsletter of the HS/HSL" href="http://www.hshsl.umaryland.edu/newsletter/"><i class="icon-copy icon-large icon-fixed-width"></i> &nbsp;Connective Issues Newsletter</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  GetAllMenus();
</script>
<!--END DESKTOP NAVIGATION-->

<!--START CONTENT-->
<div id="Content" class="texture"> <!--grey or white or texture-->
  <div class="shadowclip">
    <div class="shadow"> <!--shadow or noshadow-->

<!--START ALERTS-->
<div class="gradient" id="alerts" style="display: none;">
  <div id="alertimage"><a title="Close this notice" onclick="CloseAlert(); return false;" href="#"><i class="icon-remove-sign"></i></a></div>
  <div id="alertmessage"></div>
</div>
<!--END ALERTS-->
<?php

if ($this->template->username->exists())
{
    ?>
<div class="row">
    <div class="col-xs-12 text-right">Hello, <?php echo $this->template->username ?>
    <?php echo anchor('logout', 'Sign Out', 'class="btn btn-success"')?>
    </div>
</div>
<?php
}
?>

<div class="row">
    <div class="col-xs-12"><h2 class="page-title"><?php echo $this->template->title ?></h2></div>
</div>

      <!--START FULL COLUMN-->
      <div class="full-column page-text">

      <?php echo $this->template->content ?>

      </div>
      <!--END FULL COLUMN-->

      <br style="clear:both" />
    </div>
    <!--END SHADOWCLIP-->
  </div>
  <!--END SHADOW-->
</div>
<!--END CONTENT-->

<!--START FOOTER-->
<div id="footer">
  <div id="footer-content">
    <div class="row-fluid">
      <div class="col-md-4" style="margin-top:20px;">
        <h3 class="quicklink-title">Sites Maintained by the HS/HSL</h3>
        <ul style="margin: 15px 0 0 -15px;">
          <li><a href="http://www.hshsl.umaryland.edu/chd/" target="_blank">Congenital Heart Disease</a></li>
          <li><a href="http://www.hshsl.umaryland.edu/faith/" target="_blank">Faith Community Nursing</a></li>
          <li><a href="http://guides.hshsl.umaryland.edu/SHARE/" target="_blank">Project SHARE</a></li>
          <li><a href="http://archive.hshsl.umaryland.edu/" target="_blank">UMB Digital Archive</a></li>
          <li><a href="http://www.hshsl.umaryland.edu/gallery/" target="_blank">Weise Gallery</a></li>
        </ul>
      </div>
      <div class="col-md-4" style="margin-top:20px;">
        <h3 class="quicklink-title"><a href="http://www.umaryland.edu" target="_blank">University of Maryland Schools</a></h3>
        <ul style="margin: 15px 0 0 -15px;">
          <li><a href="http://www.dental.umaryland.edu/" target="_blank">Dentistry</a></li>
          <li><a href="http://graduate.umaryland.edu/" target="_blank">Graduate</a></li>
          <li><a href="http://www.law.umaryland.edu/" target="_blank">Law</a></li>
          <li><a href="http://medschool.umaryland.edu/" target="_blank">Medicine</a></li>
          <li><a href="http://nursing.umaryland.edu/" target="_blank">Nursing</a></li>
          <li><a href="http://www.pharmacy.umaryland.edu/" target="_blank">Pharmacy</a></li>
          <li><a href="http://www.ssw.umaryland.edu/" target="_blank">Social Work</a></li>
        </ul>
      </div>
      <div class="col-md-4" style="margin-top:20px;">
        <h3 class="quicklink-title"><a href="http://www.hshsl.umaryland.edu/newsletter/" target="_blank">Connective Issues E-Newsletter</a></h3>
        <p><a href="http://www.hshsl.umaryland.edu/newsletter/" target="_blank" class="btn btn-danger btn-block" style="color:#fff; text-shadow:0 1px 0 rgba(0, 0, 0, 0.45);"><i class="icon-copy icon-large"></i> Read Our Latest Issue</a></p>
        <br>
        <h3>Join our <script type="text/javascript" language="JavaScript" src="//umaryland.us5.list-manage.com/subscriber-count?b=00&u=9d22d96f-585b-4565-95cf-4a21264051c1&id=1efeed477e"></script> subscribers!</h3>
        <form action="//umaryland.us5.list-manage.com/subscribe/post?u=8d6a2c0e62ab4cc63311ab6cd&id=1efeed477e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
          <input type="email" value="Email Address" name="EMAIL" class="email form-control" id="mce-EMAIL" style="background-color: #2A2A2A; border: 1px solid #484848; color: #7E7E7E; margin:0 0 10px; border-radius:5px; padding: 5px 0 6px 8px;" onfocus="javascript: if(this.value == 'Email Address'){ this.value = ''; }" onblur="javascript: if(this.value==''){this.value='Email Address';}" required>
          <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-warning btn-block" style="color:#fff; text-shadow:0 1px 0 rgba(0, 0, 0, 0.45);"><i class="icon-check icon-large"></i> Subscribe</button>
        </form>
      </div>
    </div>
    <!--END ROW-FLUID-->
  </div>
  <!--END FOOTER-CONTENT-->
  <div id="copyright">
    <div id="copyright-content">
      <p>Copyright &copy; 2013
      <script language="JavaScript">
        var d=new Date();
        yr=d.getFullYear();
        if (yr > 2013)
        document.write("- "+yr);
      </script>
      <a href="http://www.umaryland.edu">University of Maryland</a> - <a href="http://www.hshsl.umaryland.edu">Health Sciences & Human Services Library</a>. All rights reserved</p>
      <p><a href="http://www.hshsl.umaryland.edu/about/contact.cfm">Contact Us</a> | <a href="http://www.hshsl.umaryland.edu/about/hours.cfm">Hours</a> | <a href="http://www.hshsl.umaryland.edu/about/directions.cfm">Directions</a> | <a href="http://www.hshsl.umaryland.edu/about/privacy.cfm">Privacy Policy</a> | <a href="http://www.hshsl.umaryland.edu/about/disclaimers.cfm">Disclaimers</a> | <a href="http://www.hshsl.umaryland.edu/about/supporting.cfm">Supporting the Library</a> | <a href="http://www.hshsl.umaryland.edu/assistance/suggest.cfm">Suggestion Box</a></p>
    </div>
    <!--END COPYRIGHT-CONTENT-->
  </div>
  <!--END COPYRIGHT-->
</div>
<!--END FOOTER-->

<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script><!--Bootstrap-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/ebscohostsearch.js"></script><!--EDS Search-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/jquery.cookie.js"></script><!--Jquery Cookie Plugin-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/jquery.flexslider-min.js"></script><!--Slideshow-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/easybox.min.js"></script><!--Lightbox-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/jquery.maskedinput.min.js"></script><!--Format Phone Numbers-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/jquery.ui.timepicker.js"></script><!--TimePicker-->
<script type="text/javascript" src="//www.hshsl.umaryland.edu/bin/js/audioplayer.min.js"></script><!--Audio Player-->

<!--Format Phone Numbers-->
<script type="text/javascript">
jQuery(function($){
   $("#Phone").mask("999-999-9999");
});
</script>

<!--SLIDESHOW-->
<script type="text/javascript">
  $(window).load(function() {
    $('.flexslider').flexslider();
  });
</script>
<script type="text/javascript">
  $(window).load(function() {
    $('.flexslider').flexslider({
          directionNav: false
    });
  });
</script>

<!--Create Retina Images Using "hires" Class-->
<script type="text/javascript">
$(function () {
	//if (window.devicePixelRatio == 2) {
	if (window.devicePixelRatio >= 1.3) {
          var images = $("img.hires");
          // loop through the images and make them hi-res
          for(var i = 0; i < images.length; i++) {
            // create new image name
            var imageType = images[i].src.substr(-4);
            var imageName = images[i].src.substr(0, images[i].src.length - 4);
            imageName += "@2x" + imageType;
            //rename image
            images[i].src = imageName;
          }
     }
});
</script>

<!--ALERTS and HOURS-->
<script type="text/javascript">
    $(document).ready(function () {

        if ($.cookie("alerts") == null) {
            $.getJSON("//www.hshsl.umaryland.edu/bin/GetAlert.php?q=" + new Date().getTime() + "&callback=?", function (data) {
                var msg = $.trim(data);

                if (msg.length > 0) {
                    // show the alert msg in public website
                    $("#alertmessage").html(msg);
                    $("#alerts").show()
                }
                else {
                    // hide the alert msg in public website
                    $("#alerts").hide();
                }
            })
			.error(function () {
			    // hide the alert msg in public website
			    $("#alerts").hide(); // this should not happen
			});
        }

        // get current hours hshslHours
        var d = new Date();
        var currentDate = d.getMonth() + 1 + '/' + d.getDate() + '/' + d.getFullYear();
        $.getJSON("//www.hshsl.umaryland.edu/bin/GetCurrentHours.php?date=" + currentDate + "&q=" + d.getTime() + "&callback=?", function (data) {
            var hr = $.trim(data);

            if (hr.length > 0) {
				if (hr == "4:00AM -  4:00AM") {
					$("#hshslHours").html("CLOSED");
				}
				else {
                	$("#hshslHours").html(hr);
				}
            }
            else { // this will only happen when an error occurs in json web service
                $("#hshslHours").html("Service not available");
            }
        });
    });
</script>

<!--HIDE ADDRESS BAR ON MOBILE IOS DEVICES-->
<script type="text/javascript">
function hideAddressBar()
{
  if(!window.location.hash)
  {
      if(document.height < window.outerHeight)
      {
          document.body.style.height = (window.outerHeight + 50) + 'px';
      }

      setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
  }
}
window.addEventListener("load", function(){ if(!window.pageYOffset){ hideAddressBar(); } } );
window.addEventListener("orientationchange", hideAddressBar );
</script>

<!--BOOTSTRAP TOOLTIPS-->
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
</script>

<!--START BACK TO TOP-->
<script src="//www.hshsl.umaryland.edu/bin/js/backtotop/easing.js" type="text/javascript"></script>
<script src="//www.hshsl.umaryland.edu/bin/js/backtotop/jquery.ui.totop.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {

		var defaults = {
  			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear'
		};

		$().UItoTop({ easingType: 'easeOutQuart' });
	});
</script>
<!--END BACK TO TOP-->

<!--CLEAR SUCCESS MESSAGES-->
<script type="text/javascript">
  $('.alert-success').delay(5000).fadeOut(400)
</script>

<!--CRAZY EGG-->
<script type="text/javascript">
setTimeout(function(){var a=document.createElement("script");
var b=document.getElementsByTagName("script")[0];
a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0017/5793.js?"+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>


<!--GOOGLE ANALYTICS-->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-82868-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-formhelpers-min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrapValidator-min.js"></script>
<?php echo $this->template->javascript ?>
<?php echo $this->template->foot ?>
<?php
if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    echo '<script src="https://localhost:35729/livereload.js?snipver=1"></script>';
}
?>
</body>
</html>
