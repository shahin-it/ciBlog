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

if(ENVIRONMENT == "development") {
	$config['base_url'] = '/ciblog';
	$db['default']['hostname'] = 'localhost';
	$db['default']['username'] = 'root';
	$db['default']['password'] = '';
	$db['default']['database'] = 'ciblog';
} else {
	$config['base_url'] = '/ciblog';
	$db['default']['hostname'] = 'localhost';
	$db['default']['username'] = 'id6645557_root';
	$db['default']['password'] = '01920489953';
	$db['default']['database'] = 'id6645557_tiger';
}
