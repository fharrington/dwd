<?php
class users_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		echo "users_controller construct called<br><br>";
	} 
	
	public function index() {
		echo "Welcome to the users's department";
	}
	
	public function signup() {
		echo "This is the signup page";
	}
	
	public function login() {
		echo "This is the login page";
	}
	
	public function logout() {
		echo "This is the logout page";
	}
	
	public function profile($user_name = NULL) {
		
		if($user_name == NULL) {
			echo "No user specified";
		}
		else {
			$this->template->content = View::instance("v_users_profile"); //set up the view
			$this->template->title = "profile for" . $user_name; //set the title of the page via controller
			$this->template->content->user_name = $user_name; //pass $user_name variable to template
			
			$client_files = Array("/css/users.css", "/js/users.js"); //create array of client files we want to send
			
			$this->template->client_files = Utils::load_client_files($client_files); //send them in proper format
			
			echo $this->template; //render the view
			
		}
	}
		
} # end of the class
