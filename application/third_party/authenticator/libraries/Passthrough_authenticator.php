<?php
/**
 * Dummy authenticator always returns true.
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

    public function username()
    {
        return 'username';
    }

    public function name()
    {
        return 'Dummy User';
    }
}
