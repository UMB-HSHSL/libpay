<?php
/**
 * LDAP Authenticator stores authentication information in the session.
 */
class Ldap_authenticator
{
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function authenticate($username, $password)
    {
        // separate domain\username into "domain\username" and "username"
        $bind_username = $username;
        $search_username = substr(strstr($username, '\\'), 1);

        if (! ($cx = ldap_connect(config_item('ldap_host'), 389))) {
            throw new Authentication_exception('Connection error; please try again later.');
            //@@ or exit(">>Unable to search ldap server<<\nldap_error: " . ldap_error($cx));
        }

        ldap_set_option($cx, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($cx, LDAP_OPT_REFERRALS, 0);

        if (! ($bind = ldap_bind($cx, $bind_username, $password))) {
            throw new Authentication_exception("Your username or password was invalid. Please try again.");
        }

        $filter = str_replace('{USERNAME}', $search_username, config_item('ldap_filter'));

        if (! ($read = ldap_search($cx, config_item('ldap_base_dn'), $filter, config_item('ldap_fields')))) {
            throw new Authentication_exception("Connection error; please try again.");
            //@@ or exit(">>Unable to search ldap server<<\nldap_error: " . ldap_error($cx));
        }

        $info = ldap_get_entries($cx, $read);

        $user_info = array(
            'cn' => $info[0]['cn'][0],
            'username' => $search_username,
            'is_authenticated' => true
        );
        $this->ci->session->set_userdata($user_info);

        ldap_close($cx);
    }

    public function is_authenticated()
    {
        return ($this->ci->session->userdata('is_authenticated')) ? true : false;
    }

    public function username()
    {
        if ($this->is_authenticated()) {
            return $this->ci->session->userdata('username');
        }

        throw new Authentication_exception('User is not authenticated.');
    }

    public function name()
    {
        if ($this->is_authenticated()) {
            return $this->ci->session->userdata('cn');
        }

        throw new Authentication_exception('User is not authenticated.');
    }

}
