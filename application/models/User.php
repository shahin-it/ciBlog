<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 10-Aug-18
 * Time: 10:45 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Model {

    function __construct() {
        $this->tableName = "user";
        parent::__construct();
    }



}
