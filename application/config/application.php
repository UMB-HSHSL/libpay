<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// default authenticator; may be overridden by FCPATH/config/application.php
$config['authenticator'] = 'Ldap_authenticator';

// default authorizer; may be overridden by FCPATH/config/application.php
$config['authorizer'] = 'Array_authorizer';

// authorized users; overridden by in FCPATH/config/application.php
$config['authorized_users'] = array();


// pull in Stripe credentials from the config file at the application root,
// which is not part of the repo. see FCPATH/config/application.php-default
// for details on what should be stored there.
require_once FCPATH . 'config/application.php';


/*
 * Stripe accepts the following: Visa, American Express, MasterCard,
 * Discover, JCB, Diners Club, but we only accept the following.
 *
 * HSHSL only accepts Visa and MasterCard. This value configures server-side
 * validation only. To enable other brands
 */
$config['stripe_valid_brands'] = array('visa', 'mastercard');


// unknown error code: 400
$config['stripe_error_codes'] = array(
    // request has invalid parameters, e.g. bad API key
    'invalid_request_error' => (object) array('code' => 'e401' ),

    // a temporary problem with Stripe's servers) and should turn up only very infrequently.
    'api_error' => (object) array('code' => 'e402' ),

    // Card errors are the most common type of error you should expect to handle. They result when the user enters a card that can't be charged for some reason.
    'card_error' => (object) array('code' => 'e403' ),

);


// LDAP/AD authentication config
$config['ldap_host']    = 'hshsl-staff.umaryland.edu';
$config['ldap_base_dn'] = 'OU=HSHSL Staff,DC=hshsl-staff,DC=umaryland,DC=edu';
$config['ldap_filter']  = '(samaccountname={USERNAME})';
$config['ldap_fields']  = array('cn');
