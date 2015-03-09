<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! $this->input->is_cli_request()) {
            show_error('sorry; cli only');
        }
    }

    public function index()
    {
        $this->load->library('migration');
        if ($version = $this->migration->latest())
        {
            echo "migrated to {$version}\n";
        }
        else {
            show_error($this->migration->error_string());
        }
    }

}

