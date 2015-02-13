<?php

class MY_Controller extends CI_Controller
{
  public function is_post()
  {
    return 'post' == strtolower($_SERVER['REQUEST_METHOD']);
  }
}
