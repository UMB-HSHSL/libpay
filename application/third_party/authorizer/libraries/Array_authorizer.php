<?php
/**
 * Accept users given an array of valid usernames.
 *
 * @author zburke
 *
 */
class Array_authorizer
{
    public function is_authorized($username)
    {
        return in_array($username, config_item('authorized_users'));
    }
}