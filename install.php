<?php 
/**
 * This file copy the main command to project root
 */
$path = realpath(dirname(__FILE__));
copy("$path/kernel/commands/manage.php", "$path/../../../manage.php");