<?php
/**
 * Accept all requests.
 * @author zburke
 *
 */
class Passthrough_authorizer
{
    public function is_authorized($username)
    {
        return true;
    }
}