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

    function find_user($username)
    {
      foreach ($this->data as $key=>$item)
      {
        if($item['username'] === $username)
        {
          return $key;
        }
      }
      return -1; // No user found
    }

    function search_users($search_term)
    {
      foreach ($this->data as $key=>$item)
      {
        if (stristr($item, $search_term))
          return $key;
      }
    }

    function get_user($key)
    {
      $user['username'] = $this->data[$key]['username'];
      $user['first_name'] = $this->data[$key]['first_name'];
      $user['last_name'] = $this->data[$key]['last_name'];
      $user['phone'] = $this->data[$key]['phone'];
      //// Current Address
      $user['cur_street'] = $this->data[$key]['cur_street'];
      $user['cur_city'] = $this->data[$key]['cur_city'];
      $user['cur_state'] = $this->data[$key]['cur_state'];
      $user['cur_zip'] = $this->data[$key]['cur_zip'];
      // Permenent Address
      $user['perm_street'] = $this->data[$key]['perm_street'];
      $user['perm_city'] = $this->data[$key]['perm_city'];
      $user['perm_state'] = $this->data[$key]['perm_state'];
      $user['perm_zip'] = $this->data[$key]['perm_zip'];
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
