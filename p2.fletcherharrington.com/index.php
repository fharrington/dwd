<?php

# The DOC_ROOT and APP_PATH constant have to happen in the actual app

	# Document root, ex: /path/to/home/app.com/../ (uses ./ on CLI)
	define('DOC_ROOT', empty($_SERVER['DOCUMENT_ROOT']) ? './' : realpath($_SERVER['DOCUMENT_ROOT']).'/../');
	  
	# App path, ex: /path/to/home/app.com/
	define('APP_PATH', realpath(dirname(__FILE__)).'/');
         
# Environment
	require_once DOC_ROOT.'environment.php'; 
   
# Where is core located?
	define('CORE_PATH',  $_SERVER['DOCUMENT_ROOT']."/../core/");
	   
# Load app configs
	require APP_PATH."/config/config.php";
	require APP_PATH."/config/feature_flags.php";
	  
# Bootstrap
	require CORE_PATH."bootstrap.php";

# Routing
    Router::$routes = array(
    	'/' => '/index',     # default controller when "/" is requested
    );
    
# Match requested uri to any routes and instantiate controller
    Router::init();
    
# Display environment details
	require CORE_PATH."environment-details.php";
	
?>

    <?php  
    class MyClass  
    {  
        public $prop1 = "I'm a class property!";  
        public function __construct()  
        {  
            echo 'The class "', __CLASS__, '" was initiated!<br />'; 
        } 
        public function __destruct() 
        { 
            echo 'The class "', __CLASS__, '" was destroyed.<br />';  
        }  
        public function __toString()  
        {  
            echo "Using the toString method: ";  
            return $this->getProperty();  
        }  
        public function setProperty($newval)  
        {  
            $this->prop1 = $newval;  
        }  
        public function getProperty()  
        {  
            return $this->prop1 . "<br />";  
        }  
    }  
    class MyOtherClass extends MyClass  
    {  
        public function __construct()  
        {  
            echo "A new constructor in " . __CLASS__ . ".<br />";  
        }  
        public function newMethod()  
        {  
            echo "From a new method in " . __CLASS__ . ".<br />";  
        }  
    }  
    // Create a new object  
    $newobj = new MyOtherClass;
	$newobj2=new myOtherClass;
    // Output the object as a string  
    echo $newobj->newMethod();  
	echo $newobj2->getProperty();
    // Use a method from the parent class  
    echo $newobj->getProperty();  
?> 