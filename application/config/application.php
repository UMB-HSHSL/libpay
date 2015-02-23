<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'config/application.php';

/*
 * Stripe accepts the following: Visa, American Express, MasterCard,
 * Discover, JCB, Diners Club, but we only accept the following.
 *
 * HSHSL only accepts Visa and MasterCard. This value configures server-side
 * validation only. To enable other brands
 */
$config['stripe_valid_brands'] = array('Visa', 'MasterCard');


