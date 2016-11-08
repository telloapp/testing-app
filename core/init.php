<?php 
session_start();
require 'connect/database.php';
require 'classes/users.php';
require 'classes/general.php';
require 'classes/bcrypt.php';
require 'classes/chartforum.php';
require 'classes/designer.php';

// error_reporting(0);

$users 		  	= new Users($db);
$chartforum 	= new Chartforum($db);
$designer    	= new designer($db);
$general 		= new General();
$bcrypt 		= new Bcrypt(12);

$errors = array();

if ($general->logged_in() === true)  {
	$designer_id 	= $_SESSION['id'];
	$user 		    = $designer->userdata($designer_id);
}

ob_start(); // Added to avoid a common error of 'header already sent'