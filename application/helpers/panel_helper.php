<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('panelSelector'))
{
  function panelSelector($access = '')
  {
    switch ($access)
    {
      case 'user':
        $level = site_url("/user");
        break;
      case 'manager':
        $level = site_url("/manager");
        break;
      case 'admin':
        $level = site_url("/admin");
        break;
    }
    return $level;
  }
}

