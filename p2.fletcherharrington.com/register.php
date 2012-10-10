<?php session_start(); //always start Sessions FIRST ?>
<!doctype html>  
<html lang="en">  
<head>  
  <meta charset="utf-8">  
  <title>Saysomething</title>  
  <meta name="description" content="saysomething registration">  
  <meta name="author" content="SitePoint">  
  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  
  <?php
    function logged_in() { //checkif person is logged in (Session)
        return isset($_SESSION['user_id']);
    }
    function confirm_loggedin() { // forbids access and redirects
        if(!logged_in()) {
            echo "Please log in.";
            }
    }
?>  
  


<?php	  // set variables to null(temporary until proper functions/pages setup)
          $username = "";
		  $firstname = "";
		  $lastname = "";
          $password = "";
          $hashed_password = "";
		  $interests = "";
		  $online = 0;
?>	  
	  
<?php

	// Database constants
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "BBs&3440");
	define("DB_NAME", "saysomething");
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
?>

<?php
// 1. Create a database connection
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if (!$connection) {
		die("database connection failed: " . mysql_error());
	}

	$db_select = mysql_select_db(DB_NAME, $connection);
	if(!$db_select) {
		die("database selection failed: " . mysql_error());
	}
?>
<?php
function mysql_prep($value) {
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists("mysql_real_excape_string"); //i.e. PHP >= v4.3.0
    if ($new_enough_php){
        //undo any magic quote effects in order to use mysql_real_escape_string
        if($magic_quotes_active) { $value = stripslashes($value); }
        $value = mysql_real_excape_string($value);
    } else {
        //if magic quotes aren't already on then add slashes manually
        if(!$magic_quotes_active) { $value = addslashes( $value ); }
        // if magic quotes are active then slashes already exist
    }
    return $value;
}
?>
	  
<?php if (isset($_POST['submit'])) { // pulls submit info from post variable from submit button to see if any data was sent
        //Form Validation
          $errors = array();
          $required_fields = array('username', 'password');
          foreach($required_fields as $fieldname){
              if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && !is_numeric($_POST[$fieldname]))) {
                  $errors[] = $fieldname;
              }
          }
          $fields_with_lengths = array('username' => 30, 'password' => 30);
          foreach($fields_with_lengths as $fieldname => $maxlength) {
              if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) {
                  $errors[] = $fieldname;}
          }
          
          $username = trim(mysql_prep($_POST['username']));
		  $firstname = trim(mysql_prep($_POST['firstname']));
		  $lastname = trim(mysql_prep($_POST['lastname']));
          $password = trim(mysql_prep($_POST['password']));
          $hashed_password = sha1($password);
		  $interests = trim(mysql_prep($_POST['interests']));
		  $online = 0;
		  
		 

          if (empty($errors)) {
          //Perform Update
		  

                $query = "INSERT INTO users (
                              username, firstname, lastname, hashed_password, interests, online
                              ) VALUES (
                                      '{$username}', '{$firstname}', '{$lastname}', '{$hashed_password}', '{$interests}', '{$online}'
                              )";                        
                $result = mysql_query($query, $connection);
                      if ($result) {
                          //Success
                          $message = "The user was successfully created.";
                      } else {
                          //failed
                          $message = "The user could not be created";
                          $message .= "<br />" . mysql_error();
                      }
                } else {
                    //Errors occured
                    $message = "There were " . count($errors) . " errors in the form.";
                    
                }                
        } else {
        $username = "";
        $password = "";
        }
		
	if (empty($errors)) {
	//Perform Query

		$query = "SELECT id, username "; //only return id/username, not hashed_password for security
		$query .= "FROM users ";
		$query .= "WHERE username = '{$username}' ";
		$query .= "AND hashed_password = '{$hashed_password}'";
		$result = mysql_query($query, $connection);
			  if (mysql_num_rows($result) == 1) {
				  //Success 1 row matched
				  $found_user = mysql_fetch_array($result);
				  $_SESSION['user_id'] = $found_user['id'];
				  $_SESSION['username'] = $found_user['username'];
			  } else {
				  //failed
				  $message = "Could not log in.";
				  $message .= "<br />" . mysql_error();
			  }
		} else {
			//Errors occured
			$message = "There were " . count($errors) . " errors in the form.";
			
		} 		
?>
	    
    </head>  
    <body>  
	
	
<?php 

	if (logged_in()) { 
		echo "You are logged in.";
		}
		
	else { confirm_loggedin();
	} 
?>


	<h2>Add User</h2>
	<?php if (!empty($message)) { echo "<p class=\"message\">" . $message . "</p>"; } ?>
	<?php if (!empty($errors)) {
			echo "<p class=\"errors\">";
			echo "Please review the following fields:<br />";
			foreach($errors as $error) {
					echo " - " . $error . "<br />";
			}
			echo "</p>";
			}
	?>
	<form action="register.php" method="post">
		<p>User Name:
			<input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
		</p>
		<p>First Name:
			<input type="text" name="firstname" value="<?php echo htmlentities($firstname); ?>" />
		</p>
		<p>Last Name:
			<input type="text" name="lastname" value="<?php echo htmlentities($lastname); ?>" />
		</p>
		<p>Password:
			<input type="text" name="password" value="<?php echo htmlentities($password); ?>" />
		</p>
		<p>interests:
			<input type="text" name="interests" value="<?php echo htmlentities($interests); ?>" />
		</p>
		
			<input type="submit" name="submit" value="Add User">
	</form>
	<br />
	<a href="register.php">Cancel</a>
	
	<br><br>
	
	<a href="logout.php">Logout</a> <!--sends to a php page that destroys section and back to this page->

	
    </body>  
	
	
    </html>  
