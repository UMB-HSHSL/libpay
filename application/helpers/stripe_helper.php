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