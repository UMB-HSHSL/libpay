<?php
/**
 * Dummy authenticator always returns false.
 * @author zburke
 *
 */
class Deny_authenticator
{

    public function is_authenticated() {
        return FALSE;
    }

    public function authenticate()
    {
        throw new Authentication_exception(__CLASS__ . ' rejects all authentication attempts.');
    }
}