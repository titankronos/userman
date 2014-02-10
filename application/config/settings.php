<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Input your LDAP server Infomation
$config['ldapServer'] = 'ldap.rocky.edu';
$config['ldapDCRoot'] = 'dc=rocky,dc=edu';
$config['bindUser'] = 'cn=manager,dc=rocky,dc=edu';
$config['bindPassword'] = 'changeme';

// Manager(s)
$config['managers'] = array("cindy.hessler", "dianne.capron", "coleen.schultz", "teresa.rowen", "deb.faw");

// Administrator(s)
$config['admins'] = array("andrew.niemantsverdriet", "dan.wolters");

// Email Address to notify of changes
$config['email'] = array('andrew@rocky.edu');
