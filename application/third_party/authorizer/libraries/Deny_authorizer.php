<?php
/**
 * Deny all requests.
 * @author zburke
 *
 */
class Deny_authorizer
{
    public function is_authorized($username)
    {
        return false;
    }
}