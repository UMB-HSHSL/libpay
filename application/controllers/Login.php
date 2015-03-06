<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }


    public function index()
    {
        if ($this->is_post()) {
            $this->authenticate();
            return;
        }

        $this->template->title = 'Sign In';
        $this->template->content->view('login/index');
        $this->template->publish();
    }

    private function authenticate()
    {
        $cx = ldap_connect( config_item('ldap_host'), 389)
            or exit(">>Could not connect to LDAP server<<");

        ldap_set_option($cx, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($cx, LDAP_OPT_REFERRALS, 0);

        $bind = ldap_bind($cx, $this->input->post('username'), $this->input->post('password'))
            or exit(">>Could not bind to " . config_item('ldap_host') . "<<");

        $filter = str_replace('{USERNAME}', $this->input->post('username'), config_item('ldap_filter'));

        $read = ldap_search($cx, config_item('ldap_base_dn'), $filter, config_item('ldap_fields'))
            or exit(">>Unable to search ldap server<<\nldap_error: " . ldap_error($cx));

        $info = ldap_get_entries($connect, $read);

        $user_info = array(
            'cn' => $info[0]['cn'][0],
            'username' => $this->input->post('username'),
            'is_authenticated' => true
        );
        $this->session->set_userdata($user_info);

        ldap_close($connect);

        redirect('admin');
    }

}
