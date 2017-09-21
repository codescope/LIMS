<?php
      function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
    function unique_sample_id($sample_id){
        global $connection;
        $query  = "SELECT * ";
        $query .= "FROM samples ";
        $query .= "WHERE sample_id= '{$sample_id}' ";
        $query .= "LIMIT 1";
        $sample_set = mysqli_query($connection, $query);
        confirm_query($sample_set);
        if($sample = mysqli_fetch_assoc($sample_set)) {
            return false;
        } else {
            return true;
        }
    }
    function unique_customer_id($customer_id){
        global $connection;
        $query  = "SELECT * ";
        $query .= "FROM commercial_customers ";
        $query .= "WHERE customer_id='{$customer_id}' ";
        $query .= "LIMIT 1";
        $customer_set = mysqli_query($connection, $query);
        confirm_query($customer_set);
        if($customer = mysqli_fetch_assoc($customer_set)) {
            return false;
        } else {
            return true;
        }

    }
    function generate_sample_id($length)
      {
          $chars = "1234567890";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }
       
          return ($id);
      }
    function get_sample_id(){
          do{
            $sample_id  = date ("m");
            $sample_id .= generate_sample_id(8);
            $sample_id .= date ("y");
          }while(!unique_sample_id($sample_id));
        return $sample_id;
        
    }
    function generate_customer_id($length)
      {
          $chars = "1234506789";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[random_int(0,$clen)];
          }

          return ($id);
      }
	 function get_customer_id(){
        do {
            $customer_id = date("d");
            $customer_id .= date("m");
            $customer_id .= generate_customer_id(8);
        }while(!unique_customer_id($customer_id));
        return $customer_id;
        
    }
	function find_all_subjects($public=true) {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		if ($public) {
			$query .= "WHERE visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$subject_set = mysqli_query($connection, $query);
		confirm_query($subject_set);
		return $subject_set;
	}

	
	
	
	function find_all_admins() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM lab_managers ";
        $query .= "WHERE visible=1 ";
		$query .= "ORDER BY privileges ASC";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		return $admin_set;
	}

    function find_all_test_prices() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM testing_charges ";
		$query .= "ORDER BY id ASC";
		$price_set = mysqli_query($connection, $query);
		confirm_query($price_set);
		return $price_set;
	}
    function find_test_by_name($test_name) {
		global $connection;
		
		$safe_test_name = mysqli_real_escape_string($connection, $test_name);
		
		$query  = "SELECT * ";
		$query .= "FROM testing_charges ";
		$query .= "WHERE nature_of_test = '{$safe_test_name}' ";
		$query .= "LIMIT 1";
		$test_set = mysqli_query($connection, $query);
		confirm_query($test_set);
		if($test = mysqli_fetch_assoc($test_set)) {
			return $test;
		} else {
			return null;
		}
	}

    function find_test_by_id($test_id) {
		global $connection;
		
		$safe_test_id = mysqli_real_escape_string($connection, $test_id);
		
		$query  = "SELECT * ";
		$query .= "FROM testing_charges ";
		$query .= "WHERE id = {$safe_test_id} ";
		$query .= "LIMIT 1";
		$test_set = mysqli_query($connection, $query);
		confirm_query($test_set);
		if($test = mysqli_fetch_assoc($test_set)) {
			return $test;
		} else {
			return null;
		}
	}
    function find_root_admin() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM lab_managers ";
        $query .= "WHERE visible=0 ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	
	function find_subject_by_id($subject_id, $public=true) {
		global $connection;
		
		$safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
		
		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id = {$safe_subject_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$subject_set = mysqli_query($connection, $query);
		confirm_query($subject_set);
		if($subject = mysqli_fetch_assoc($subject_set)) {
			return $subject;
		} else {
			return null;
		}
	}

	function find_page_by_id($page_id, $public=true) {
		global $connection;
		
		$safe_page_id = mysqli_real_escape_string($connection, $page_id);
		
		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = {$safe_page_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		if($page = mysqli_fetch_assoc($page_set)) {
			return $page;
		} else {
			return null;
		}
	}
	
	function find_admin_by_id($admin_id) {
		global $connection;
		
		$safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
		
		$query  = "SELECT * ";
		$query .= "FROM lab_managers ";
//        we are only examining visible users
		$query .= "WHERE id = {$safe_admin_id} AND visible = 1 ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}

    function find_root_admin_by_id($admin_id) {
		global $connection;
		
		$safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
		
		$query  = "SELECT * ";
		$query .= "FROM lab_managers ";
//        we are only examining visible users
		$query .= "WHERE id = {$safe_admin_id} AND visible = 0 ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}

	function find_admin_by_username($username) {
		global $connection;
		
		$safe_username = mysqli_real_escape_string($connection, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM lab_managers ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}

	function find_default_page_for_subject($subject_id) {
		$page_set = find_pages_for_subject($subject_id);
		if($first_page = mysqli_fetch_assoc($page_set)) {
			return $first_page;
		} else {
			return null;
		}
	}
	
	function find_selected_page($public=false) {
		global $current_subject;
		global $current_page;
		
		if (isset($_GET["subject"])) {
			$current_subject = find_subject_by_id($_GET["subject"], $public);
			if ($current_subject && $public) {
				$current_page = find_default_page_for_subject($current_subject["id"]);
			} else {
				$current_page = null;
			}
		} elseif (isset($_GET["page"])) {
			$current_subject = null;
			$current_page = find_page_by_id($_GET["page"], $public);
		} else {
			$current_subject = null;
			$current_page = null;
		}
	}

	// navigation takes 2 arguments
	// - the current subject array or null
	// - the current page array or null
	function navigation($subject_array, $page_array) {
		$output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects(false);
		while($subject = mysqli_fetch_assoc($subject_set)) {
			$output .= "<li";
			if ($subject_array && $subject["id"] == $subject_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"manage_content.php?subject=";
			$output .= urlencode($subject["id"]);
			$output .= "\">";
			$output .= htmlentities($subject["menu_name"]);
			$output .= "</a>";
			
			$page_set = find_pages_for_subject($subject["id"], false);
			$output .= "<ul class=\"pages\">";
			while($page = mysqli_fetch_assoc($page_set)) {
				$output .= "<li";
				if ($page_array && $page["id"] == $page_array["id"]) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"manage_content.php?page=";
				$output .= urlencode($page["id"]);
				$output .= "\">";
				$output .= htmlentities($page["menu_name"]);
				$output .= "</a></li>";
			}
			mysqli_free_result($page_set);
			$output .= "</ul></li>";
		}
		mysqli_free_result($subject_set);
		$output .= "</ul>";
		return $output;
	}

	function public_navigation($subject_array, $page_array) {
		$output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects();
		while($subject = mysqli_fetch_assoc($subject_set)) {
			$output .= "<li";
			if ($subject_array && $subject["id"] == $subject_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"index.php?subject=";
			$output .= urlencode($subject["id"]);
			$output .= "\">";
			$output .= htmlentities($subject["menu_name"]);
			$output .= "</a>";
			
			if ($subject_array["id"] == $subject["id"] || 
					$page_array["subject_id"] == $subject["id"]) {
				$page_set = find_pages_for_subject($subject["id"]);
				$output .= "<ul class=\"pages\">";
				while($page = mysqli_fetch_assoc($page_set)) {
					$output .= "<li";
					if ($page_array && $page["id"] == $page_array["id"]) {
						$output .= " class=\"selected\"";
					}
					$output .= ">";
					$output .= "<a href=\"index.php?page=";
					$output .= urlencode($page["id"]);
					$output .= "\">";
					$output .= htmlentities($page["menu_name"]);
					$output .= "</a></li>";
				}
				$output .= "</ul>";
				mysqli_free_result($page_set);
			}

			$output .= "</li>"; // end of the subject li
		}
		mysqli_free_result($subject_set);
		$output .= "</ul>";
		return $output;
	}

	function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $submitted_password) {
	  if($password===$submitted_password){
          return true;
      }
        else{
            return false;
        }
	}

	function attempt_login($username, $password) {
		$admin = find_admin_by_username($username);
		if ($admin) {
			// found admin, now check password
			if (password_check($password, $admin["password"])) {
				// password matches
				return $admin;
			} else {
				// password does not match
				return false;
			}
		} else {
			// admin not found
			return false;
		}
	}

    function get_success(){
        if(isset($_GET['success'])) {
            $output = "<div class=\"success\">";
			$output .= $_GET['success'];
			$output .= "</div>";
		
			return $output;
            
        }
    }

	function logged_in() {
//		return isset($_SESSION['admin_id']);
        if((isset($_SESSION['username']) && isset($_SESSION['admin_id'])) || isset($_COOKIE['username']))
        return true;
    else
        return false;
    
}
	
	
	function confirm_logged_in() {
		//Check whether admin already logged in or not
    if(logged_in()){
        if($_SESSION["privileges"]==='admin' || $_COOKIE['privileges']==='admin'){
            redirect_to("admin.php");
        }
        elseif($_SESSION["privileges"]==='reception' || $_COOKIE['privileges']==='reception'){
            redirect_to("reception.php");
        }
        elseif($_SESSION["privileges"]==='lab' || $_COOKIE['privileges']==='lab'){
            redirect_to("lab_manager.php");
        }
        else{
/*            In case where cookie or session exists but session or cookie privileges does not exists*/
            redirect_to("login.php");
        }
    
    }
    else{
        redirect_to("login.php");
    }    
	}
?>