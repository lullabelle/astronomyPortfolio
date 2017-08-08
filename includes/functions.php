<?php

//file used for common functions throughout project

//function removes the 0 from dates

function strip_zeros_from_date($marked_string=''){
	$no_zeros = str_replace('*','',$marked_string);
	$clean_string = str_replace('*','',$no_zeros);
	return $clean_string;
}

// function to redirect to location
function redirect_to($location = NULL){
	if($location !=NULL){
		header("Location: {$location}");
		exit;
	}
}

//function to output messages to client browser
function output_message($message=""){
	if(!empty($message)){
		return "<p class =\"message\"{$message}</p>";
	}else {
		return "";
	}
function include_layout_template($template="") {
	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}
}

//for includes paths at start of file. AutoLoads object classes
function __autoload($class_name){
	//converts to lower case string
	$class_name = strtolower($class_name);
	$path = "../includes/{$class_name}.php";
	//check if the file exists and require
	if(file_exists($path)){
		require_once($path);
	}else {
		//error - better user experience
		die("The file {$class_name}.php could not be found");
	}
	
}
?>