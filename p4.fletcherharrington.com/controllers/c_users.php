<?php
class users_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
	} 
	
	public function index() {
	}
	
	public function signup($error = NULL, $success = NULL) {
		
		# Setup view
		$this->template->content = View::instance('v_users_signup');
		$this->template->title   = "Signup";
			
		# Pass data to the view
		$this->template->content->error = $error;
			
		# Render template
		echo $this->template;
	}
	
	public function p_signup() {
		
		foreach ($_POST as $exists => $value) {
			if ($value == "") { 
				Router::redirect("/users/signup/error");
			}
		}
			
		# Encrypt the password	
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);	
		
		#More data we want stored with the user
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		$_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
					
		
		# Insert this user into the database
		$user_id = DB::instance(DB_NAME)->insert("users", $_POST);
		
		sleep(2);
				
		# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		# Search the db for this email and password
		# Retrieve the token if it's available
		
		$q = "SELECT token 
			FROM users 
			WHERE email = '".$_POST['email']."' 
			AND password = '".$_POST['password']."'";
		
		$token = DB::instance(DB_NAME)->select_field($q);
					
		# If we didn't get a token back, login failed
		if($token == "") {
		Router::redirect("/users/login/error");
		
		#But if we did, login succeeded!
		
		} else {
			
			# Store this token in a cookie
			setcookie("token", $token, time()+3600, '/');
			
			# Send them to the main page - or whever you want them to go
			Router::redirect("/users/profile/");
		}
		
		//header('location: /users/login');
			
	}	
	
	public function login($error = NULL) {
	
		# Setup view
		$this->template->content = View::instance('v_users_login');
		$this->template->title   = "Login";
		
		# Pass data to the view
		$this->template->content->error = $error;
		
		# Render template
		echo $this->template;
		
	}
	
	public function p_login() {
	
		# Hash submitted password so we can compare it against one in the db
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
		//$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		# Search the db for this email and password
		# Retrieve the token if it's available
		
		$q = "SELECT token 
			FROM users 
			WHERE email = '".$_POST['email']."' 
			AND password = '".$_POST['password']."'";
		
		$token = DB::instance(DB_NAME)->select_field($q);
					
		# If we didn't get a token back, login failed
		if($token == "") {
		Router::redirect("/users/login/error");
		
		#But if we did, login succeeded! 
		
	} else {
		
		# Store this token in a cookie
		setcookie("token", $token, time()+3600, '/');
		
		# Send them to the main page - or whever you want them to go
		Router::redirect("/users/profile/");
	}
}
	
	public function profile($streamerror = NULL, $mypostserror = NULL, $noposts = NULL) {
	
		# Load client files
		$client_files = Array(
				"/css/users.css",
				"/js/users.js",
	            );
	
        $this->template->client_files = Utils::load_client_files($client_files);


		# If user is blank, they're not logged in, show message and don't do anything else
		if(!$this->user) {
			echo "Members only. <a href='/users/login'>Login</a>";
			
			# Return will force this method to exit here so the rest of 
			# the code won't be executed and the profile view won't be displayed.
			return false;
		}
		
		#Posts of users this user is following
		$q = "SELECT *
			FROM posts
			JOIN users USING (user_id)
			WHERE user_id = " .$this->user->user_id;
		
		# Run our query, grabbing all the posts and joining in the users	
		$myposts = DB::instance(DB_NAME)->select_rows($q);
		
		#reverse order (newest first)
		$myposts = array_reverse($myposts);
		
		# get list of files uploaded by user
		$q = "SELECT *
			FROM audio
			WHERE user_id = ".$this->user->user_id;
			
		#execute query with select_array method: returns results in an array and uses the #user_id field as the index
		#Store results in variable $file
		
		$files = DB::instance(DB_NAME)->select_array($q, 'file'); 
		
		
		if (!$myposts) { $noposts = "1"; }

		# Setup view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Profile of".$this->user->first_name;
		$this->template->content->streamerror = $streamerror;
		$this->template->content->myposts = $myposts;
		$this->template->content->mypostserror = $mypostserror;
		$this->template->content->noposts = $noposts;
		$this->template->content->files = $files;
			
		# Render template
		echo $this->template;
}
		
	
	public function logout() {
			
		
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		# Create the data array we'll use with the update method
		# In this case, we're only updating one field, so our array only has one entry
		$data = Array("token" => $new_token);
		
		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		# Delete their token cookie - effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');
		
		Router::redirect('/index/');
		
		#setup view
		$this->template->content = View::instance('v_users_logout');
		$this->template->title = "See ya";
		
		#rnder view
		echo $this->template;
		
			
	}
	
} # end of the class