<?php

class index_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	/*-------------------------------------------------------------------------------------------------
	Access via http://yourapp.com/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "project3";
	
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
			$client_files = Array(
						""
	                    );
	    
	    	$this->template->client_files = Utils::load_client_files($client_files);   
	      		
		# Render the view
			echo $this->template;

	}	
	
	public function about () {
	
		#just render it 
		$this->template->content = View::instance('v_index_about');
		
		echo $this->template;
		
	}
	
	
	
	public function posts() {
	
		# Set up view
		$this->template->content = View::instance('v_index_posts');
		$this->template->title   = "Posts";
		
		# Build our query
		$q = "SELECT * 
			FROM posts
			JOIN users USING (user_id)";
		
		# Run our query, grabbing all the posts and joining in the users	
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		#reverse order (newest first)
		$posts = array_reverse($posts);

		# Pass data to the view
		$this->template->content->posts = $posts;
		
		# Render view
		echo $this->template;
	
	}
		
	public function project4() {
		
		# Set up view
		$this->template->content = View::instance('v_index_project4');
		$this->template->title   = "Project4";
		
		echo $this->template;
	}
	
} // end class


