<?php

class file_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
		# Make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Login</a>");
		}
	}
	
	
	
	public function upload() {
	
		# Setup view
		$this->template->content = View::instance('v_file_upload');
		$this->template->title   = "Add a new audio file";
		
		# Get all files in upload dir
		
		# get list of all files so there are no duplicates 
		$s = "SELECT file
			FROM audio";
			
		$allFiles = DB::instance(DB_NAME)->select_array($s, 'file');
		
	
		$this->template->content->allFiles = $allFiles;
			
		# Render template
		echo $this->template;
	}
	
	public function p_upload() {
			
		# Associate this file with this user
		$_POST['user_id']  = $this->user->user_id;

		# Unix timestamp of when this file was added
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# get list of all files so there are no duplicates 
		
		# get list of all files so there are no duplicates 
		$s = "SELECT file
			FROM audio";

		$allFiles = DB::instance(DB_NAME)->select_array($s, 'file');
		
		$dup = "";
		foreach ($allFiles as $key => $files) {
			if ($_FILES["file"]["name"] == $files) { $dup = "true"; }
			else { break; } 
			}
		
		If (!empty($_POST) && ($dup != "true")) {
		
		$_POST['file'] = $_FILES["file"]["name"];

		Upload::upload($_FILES, "/uploads/", array("jpg", "jpeg", "gif", "png", "wav", "mp3", "ogg"));
		# Insert and redirect
		# Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
		DB::instance(DB_NAME)->insert('audio', $_POST);
		Router::redirect('/users/profile/');
		}else{
		# Send back to profile (code in an error msg for future)
		Router::redirect('/');
		}
	}
	

	
}