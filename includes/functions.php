<?php

//file used for common functions throughout project

//function removess the 0 from dates

function strip_zeros_from_date($marked_string=''){
	$no_zeros = str_replace('*','',$marked_string);
	$clean_string = str_replace('*','',$no_zeros);
	return $clean_string;
}

// function to redirect to location
function redirect_to($location + NULL){
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
}
?>