<?php
  class Ldap_model extends CI_Model
  {
    function __construct()
    {
        parent::__construct();
    }

    function get_user($username)
    {
      // Get Configuration Items
      $ldapServer = $this->config->item('ldapServer');
      $ldapDCRoot = $this->config->item('ldapDCRoot');

      // Connect to LDAP
      $ldapConnection = ldap_connect($ldapServer);

      if($ldapConnection)
      {
        $isBound = ldap_bind($ldapConnection);
        if (!$isBound)
        {
          // Bind Not Complete
          die("Unsuccessful Bind");
        }

        $filter = "uid=$username";
        $attrib = array('givenname','sn','street','postaladdress','st','postalcode','mobile');
        $search = ldap_search($ldapConnection, $ldapDCRoot, $filter, $attrib);
        
        if(ldap_count_entries($ldapConnection,$search) == 1)
        {
          // Make sure only one user found
          $info = ldap_get_entries($ldapConnection, $search);
          $user['username'] = $username;
          $user['first_name'] = $info[0]["givenname"][0];
          $user['last_name'] = $info[0]["sn"][0];
          $user['phone'] = $info[0]["mobile"][0];
          //// Current Address
          $user['cur_street'] = $info[0]["street"][0];
          $user['cur_city'] = $info[0]["postaladdress"][0];
          $user['cur_state'] = $info[0]["st"][0];
          $user['cur_zip'] = $info[0]["postalcode"][0];
          // Permenent Address
          $user['perm_street'] = '';
          $user['perm_city'] = '';
          $user['perm_state'] = '';
          $user['perm_zip'] = '';
          return $user;
        }
        die("Error: Too many results returned");
      }
      die("Error: Can't connect to LDAP");

      //if($ldapConnection)
      //{
        //$isBound = ldap_bind($ldapConnection);
          //if(!$isBound)
          //{
            //return False; // Can't anonmously bind
          //}

          //$filter = "uid=$username";
          //$attrib = array('givenname','sn','street','postaladdress','st','postalcode','mobile');
          //$search = ldap_search($ldapConnection, $ldapDCRoot, $filter, $attrib);

          //if(ldap_count_entries($ldapConnection,$search) == 1)
          //{
            //// Make sure only one user found
            //$info = ldap_get_entries($ldapConnection, $search);
            //$user['username'] = $username;
            //$user['first_name'] = $info[0]["givenname"][0];
            //$user['last_name'] = $info[0]["sn"][0];
            //$user['phone'] = $info[0]["mobile"][0];
            ////// Current Address
            //$user['cur_street'] = $info[0]["street"][0];
            //$user['cur_city'] = $info[0]["postaladdress"][0];
            //$user['cur_state'] = $info[0]["st"][0];
            //$user['cur_zip'] = $info[0]["postalcode"][0];
            //// Permenent Address
            //$user['perm_street'] = '';
            //$user['perm_city'] = '';
            //$user['perm_state'] = '';
            //$user['perm_zip'] = '';
            //return $user;
          //}
        //// More than one result found, bad deal, so return false.
      //}
    //// No LDAP connection, bad deal
    //return False;
    }

    function set_user($dn, $password, $data)
    {
      /* This function sets the users infomation */

      // Get Configuration Items
      $ldapServer = $this->config->item('ldapServer');
      $ldapDCRoot = $this->config->item('ldapDCRoot');


      // Connect to LDAP
      $ldapConnection = ldap_connect($ldapServer);

      if($ldapConnection)
      {
        $r = ldap_bind($ldapConnection, $dn, $password);
        if ($r)
        {
          // Bind completed successfully
          $r = ldap_modify($ldapConnection, $dn, $data);
          return True;
        }
        die("Unsuccessful Bind");
      }
      die("Can't connect to LDAP");
    }

    function admin_set_user($dn, $data)
    {
      // This function sets the users infomation using an authticated bind

      // Get Configuration Items
      $ldapServer = $this->config->item('ldapServer');
      $ldapDCRoot = $this->config->item('ldapDCRoot');
      $bindUser = $this->config->item('bindUser');
      $bindPassword = $this->config->item('bindPassword');

      // Connect to LDAP
      $ldapConnection = ldap_connect($ldapServer);

      if($ldapConnection)
      {
        $r = ldap_bind($ldapConnection, $bindUser, $bindPassword);
        if($r)
        {
          $r = ldap_modify($ldapConnection, $dn, $data);
          return True;
        }
      }
      die("Can't connect to LDAP");
    }
  }
?>
