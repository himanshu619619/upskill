<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '236851499086-5p1p4fhd4hpgen2f2r3d5o254ibsnjd8.apps.googleusercontent.com';
$config['google']['client_secret']    = 'zqy1GZIWtqXmv_9mcjVD7kvZ';
$config['google']['redirect_uri']     = 'https://7cmrealty.com/amass/user_authentication';
$config['google']['application_name'] = 'amass gmaillogin';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();