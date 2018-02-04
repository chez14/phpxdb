<?php
/**
 * This is the typical way to setup a database.
 * the MySQLi PHP Plugin are setted with parameters:
 *  mysqli( db-host, db-username, db-password, db-name)
 * 
 * ref: http://php.net/manual/en/mysqli.examples-basic.php
 */
$db = new mysqli('localhost', 'dev_chris', '', 'dev_phpxdb');

if ($db->connect_errno) {
    die('DB Error: (' . $db->connect_errno . ') ' . $db->connect_error .'.');   
}

// If your php file didn't send any response, keep it quiet by never
// give it any php close tag. This will prevent PHP to give any
// unwated char out of nowhere.