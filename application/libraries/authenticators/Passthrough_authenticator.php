<?php
/**
 * Dummy authenticator always returns true.
 * @author zburke
 *
 */
class Passthrough_authenticator
{

    public function is_authenticated() {
        return TRUE;
    }

    public function authenticate()
    {

    }
}