<?php
/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/16/17
 * Time: 5:21 AM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/Requests-1.7.0/Requests.php";

class PHPRequests {
    public function __construct() {
        Requests::register_autoloader();
    }
}