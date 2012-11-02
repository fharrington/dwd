<?php

class base_controller {
	
	public $user;
	public $userObj;
	public $template;
	public $email_template;
	public $inout;
	public $logout;

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
	
		# Instantiate User class
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();		

		# Instantiate User class for loginout view
			$this->inout = new User();
		
		# Set view fragment
			$this->logout = $this->inout->see_logout();
							
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');	
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);
		#variable to show login/logout on views
			$this->template->set_global('logout', $this->logout);
	

		#navigation array
		
		$loggedin = Array(
			"profile" => '/users/profile/',
			"logout" => '/users/logout/'
			);
		
		$loggedout = Array(
			"signup" => '/users/signup/',
			"login" => '/users/login/'
			);
		
		$navigation = Array(
			"strea" => '/posts/index/',
			"posts" => '/posts/',
			"add posts" => '/posts/add/',
			"about" => '/about/'
			);
		
		$navigationout = Array(
			"stream" => '/posts/index/',
			"about" => '/about/'
			);
		
		$this->template->loggedin = $loggedin;
		$this->template->loggedout = $loggedout;
		$this->template->navigation = $navigation;
		$this->template->navigationout = $navigationout;
			
	
	}
	
} # eoc

