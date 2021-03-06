<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 04-Aug-18
 * Time: 1:43 AM
 */

// Set line to collect lines that wrap
$templine = '';

// Read in entire file
$lines = file('db.sql');

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
