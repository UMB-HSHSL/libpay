<?php

function cc_img($str)
{
    $hash = array(
        'Visa' => '<img alt="Visa" src="https://stripe-images.s3.amazonaws.com/emails/receipt_assets/card/visa-dark.png" height="16" width="36">',
        'MasterCard' => '<img alt="MasterCard" src="https://stripe-images.s3.amazonaws.com/emails/receipt_assets/card/mastercard-dark.png" height="16" width="36">',
        'Discover' => '<img alt="Discover" src="https://stripe-images.s3.amazonaws.com/emails/receipt_assets/card/discover-dark.png" height="16" width="36">',
        'American Express' => '<img alt="AmEx" src="https://stripe-images.s3.amazonaws.com/emails/receipt_assets/card/amex-dark.png" height="16" width="36">'
    );

    if (array_key_exists($str, $hash))
    {
        return $hash[$str];
    }

    return $str;
}

/**
 * Return boolean TRUE if $str is in the array of accepted credit card brands; FALSE otherwise.
 * @param string $str
 * @return boolean
 */
function cc_valid_brand($str)
{
    return in_array(strtolower($str), config_item('stripe_valid_brands'));
}

function cleared($charge)
{
    $str = '&nbsp;';
    if ($charge->hshsl_cleared) {
        $str = date("Y/m/d g:i:s a", $charge->hshsl_cleared_date) . " by " . $charge->hshsl_cleared_by;
    }
    return $str;
}