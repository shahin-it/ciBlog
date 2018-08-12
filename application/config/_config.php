<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 04-Aug-18
 * Time: 1:43 AM
 */
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $_SERVER['CI_ENV'] = 'development';
} else {
    $_SERVER['CI_ENV'] = 'production';
}
$config['_config'] = json_decode(file_get_contents('config.json'), true);


date_default_timezone_set('Asia/Dhaka');

$config['index_page'] = '';
$config['csrf_protection'] = FALSE;

if (ENVIRONMENT == "development") {
    $config['base_url'] = '/ciblog/';
    $db['default']['hostname'] = 'localhost';
    $db['default']['username'] = 'root';
    $db['default']['password'] = '';
    $db['default']['database'] = 'ciblog';
} else {
    $config['base_url'] = '/ciblog/';
    $db['default']['hostname'] = 'localhost';
    $db['default']['username'] = 'id6645557_root';
    $db['default']['password'] = '01920489953';
    $db['default']['database'] = 'id6645557_tiger';
}




// Set line to collect lines that wrap
$templine = '';

// Read in entire file
$lines = file('data.sql');

// Loop through each line
foreach ($lines as $line) {
// Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

// Add this line to the current templine we are creating
    $templine .= $line;

// If it has a semicolon at the end, it's the end of the query so can process this templine
    if (substr(trim($line), -1, 1) == ';') {
// Perform the query
//        $this->db->query($templine);

// Reset temp variable to empty
        $templine = '';
    }
}