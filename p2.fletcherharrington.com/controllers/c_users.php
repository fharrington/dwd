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
		
		# Setup view
			$this->template->content = View::instance('v_users_signup');
			$this->template->title   = "Signup";
			
		# Render template
			echo $this->template;
	}
	
	public function p_signup() {
			
		# Dump out the results of POST to see what the form submitted
		// print_r($_POST);
		
		# Encrypt the password	
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);	
		
		#More data we want stored with the user
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		$_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
					
			
		# Insert this user into the database
		$user_id = DB::instance(DB_NAME)->insert("users", $_POST);
		
		# For now, just confirm they've signed up - we can make this fancier later
		echo "You're signed up";
			
	}	
	
	public function login() {
		echo "This is the login page";

	# Setup view
		$this->template->content = View::instance('v_users_login');
		$this->template->title   = "Login";
		
	# Render template
		echo $this->template;
	

	}
	
	public function p_login() {
	
	# Hash submitted password so we can compare it against one in the db
	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	
	# Search the db for this email and password
	# Retrieve the token if it's available
	$q = "SELECT token 
		FROM users 
		WHERE email = '".$_POST['email']."' 
		AND password = '".$_POST['password']."'";
	
	$token = DB::instance(DB_NAME)->select_field($q);
				
	# If we didn't get a token back, login failed
	if(!$token) {
			
		# Send them back to the login page
		Router::redirect("/users/login/");
		
	# But if we did, login succeeded! 
	} else {
			
		# Store this token in a cookie
		@setcookie("token", $new_token, strtotime('+1 year'), '/');
		
		# Send them to the main page - or whever you want them to go
		Router::redirect("/");
					
	}

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
	
	public function logout() {
		
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$email.Utils::generate_random_string());
		
		# Create the data array we'll use with the update method
		# In this case, we're only updating one field, so our array only has one entry
		$data = Array("token" => $new_token);
		
		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$token."'");
		
		# Delete their token cookie - effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');
		
		echo "You have been logged out.";

	}
		
} # end of the class
