LibPay
====================================
Accept on-line payments from patrons. This application was forked from
https://github.com/myg0v/Simple-Bootstrap-Stripe-Payment-Form. It uses
Stripe to handle payment processing, including submission of the user's
credit card data directly to Stripe, before the payment form is submitted
to our own servers, so we do not need to worry about PCI compliance.

The backend is written in PHP 5.2.x using CodeIgniter 2.2.1.

Manifest
===============
application - application PHP code
config - default config files
htdocs - static assets and the CodeIgniter index.php file
htdocs/web.config - denies access to application and config directories
system - CodeIgniter framework
deploy.sh - deployment script
web.config - IIS config file denies web-access to application directories

Deployment
===============
First release:
1. Run deploy.sh; this will install the application.
2. Rename the config files in the deployment directory's "config" directory
   from "somefile.php-default" to "somefile.php" and edit them as needed.
   These files will NOT be overwritten by subsequent releases.

Subsequent releases:
1. Run deploy.sh.



Used Components
===============

=> Stripe - http://stripe.com

=> jQuery (v1.11.0) - http://jquery.com/

=> Bootstrap (v3.1.1) - http://getbootstrap.com/

=> Bootstrap Form Helper (v2.3.0) - http://bootstrapformhelpers.com/

=> Bootstrap Validator (v0.4.4) - http://bootstrapvalidator.com/
