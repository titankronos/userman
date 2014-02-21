<?php
  class User_model extends CI_Model
  {
    private $data = array();

    function __construct()
    {
      parent::__construct();

      $fields = array();
      $i = 0;

      $handle = @fopen(FCPATH."users.csv", "r");
      if ($handle)
      {
          while (($row = fgetcsv($handle, 4096)) !== false)
          {
              if (empty($fields)) {
                  $fields = $row;
                  continue;
              }
              foreach ($row as $k=>$value) {
                  $this->data[$i][$fields[$k]] = $value;
              }
              $i++;
          }
          if (!feof($handle))
          {
              die ("Error: unexpected fgets() fail");
          }
          fclose($handle);
      }
    }

    function get_user($username)
    {
      $user['username'] = $username;
      $user['first_name'] = $this->data[0]['first_name'];
      $user['last_name'] = $this->data[0]['last_name'];
      $user['phone'] = '';
      //// Current Address
      $user['cur_street'] = '';
      $user['cur_city'] = '';
      $user['cur_state'] = '';
      $user['cur_zip'] = '';
      // Permenent Address
      $user['perm_street'] = '';
      $user['perm_city'] = '';
      $user['perm_state'] = '';
      $user['perm_zip'] = '';
      return $user;
    }

    function set_user($dn, $password, $data)
    {
      /* This function lets the user change all of their own infomation */
      // TODO
    }

    function mangager_set_user($dn, $data)
    {
      /* Allows Managers to change all users personal infomation, but not password. */
      //TODO
    }

    function admin_set_user($dn, $data)
    {
      /* Allows Admin users to change all aspects of a user. */
      //TODO
    }
  }
?>
