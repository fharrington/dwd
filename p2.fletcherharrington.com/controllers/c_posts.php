<?php

class posts_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
		# Make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Login</a>");
		}
	}
	
	
	public function mystream($streamerror = NULL) {
	
		# Set up view
		$this->template->content = View::instance('v_posts_mystream');
		$this->template->title   = "Posts";
		
		#Posts of users this user is following
		$q = "SELECT *
			FROM users_users
			WHERE user_id = " .$this->user->user_id;
		
		#Execute our query, storing the results in a variable $connections
		$connections = DB::instance(DB_NAME)->select_rows($q);
		
		if ($connections == NULL) {
		$streamerror = 1;
		Router::redirect('/users/profile/streamerror');
		} else {
		
		#In order to query for the posts we need, we're going to need a string of user id's, separated by commas
		#To create this, loop through our connections array
		$connections_string = "";
		foreach($connections as $connection) {
			$connections_string .= $connection['user_id_followed'].",";
		}
		
		#remove the final comma
		$connections_string = substr($connections_string, 0, -1);
		
		# Build our query to grab the posts
		$q = "SELECT * 
			FROM posts
			JOIN users USING (user_id)
			WHERE posts.user_id IN (".$connections_string.")"; 
		
		# Run our query, grabbing all the posts and joining in the users	
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		#reverse order (newest first)
		$posts = array_reverse($posts);
	
		}
		
		# Pass data to the view
		
		$this->template->content->streamerror = $streamerror;
		
		$this->template->content->posts = $posts;
			
		# Render view
		echo $this->template;
	
	}

	
	public function users() {
	
		#set up the view
		$this->template->content = View::instance("v_posts_users");
		$this->template->title = "Users";
		
		$this_userid = $this->user->user_id;
		
		#Build our query to get all the users except logged in
		$q = "SELECT *
			FROM users";
			//WHERE user_id <> " .$this_userid;
		
		#Execute the query to get all teh users. Store result array in var $users
		
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		#Build query to determine what connections user already has (following who)
		$q = "SELECT *
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
			
		#execute query with select_array method: returns results in an array and uses the #users_id_followed field as the index
		#will come in hand when settin up this view
		#Store results in variable $connections
		
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		#Pass data (users and connections) to the view
		$this->template->content->users = 	   	$users;
		$this->template->content->connections = $connections;
		
		#Render the view
		echo $this->template;
	}

	
	public function add() {
	
		# Setup view
		$this->template->content = View::instance('v_posts_add');
		$this->template->title   = "Add a new post";
			
		# Render template
		echo $this->template;
	
	}
	
	public function p_add() {
			
		# Associate this post with this user
		$_POST['user_id']  = $this->user->user_id;

		# Unix timestamp of when this post was created / modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# Insert
		# Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
		DB::instance(DB_NAME)->insert('posts', $_POST);
		
		# Send back to profile
		Router::redirect('/users/profile/');
	
	}
	
	public function follow($user_id_followed) {
		
		#prepare data array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
			);
		
		#Do the insert
		DB::instance(DB_NAME)->insert('users_users',$data);
		
		#Send them back
		Router::redirect("/posts/users");
	
	}
	
	public function unfollow($user_id_followed) {
		
		#Find what to delete
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' 
		AND user_id_followed = '.$user_id_followed;
		#delete it
		DB::instance(DB_NAME)->delete('users_users', $where_condition);
		
		#Send them back
		Router::redirect('/posts/users/');
	}
	
	
	
}