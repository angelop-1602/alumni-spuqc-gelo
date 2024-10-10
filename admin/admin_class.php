<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'passwors' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				if($_SESSION['login_type'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					return 1;
			}else{
				return 3;
			}
	}
	function login2(){
		extract($_POST);
		if(isset($email))
			$username = $email;
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if(isset($_SESSION['login_alumnus_id']) && $_SESSION['login_alumnus_id'] > 0){
				$bio = $this->db->query("SELECT * FROM alumnus_bio where id = ".$_SESSION['login_alumnus_id']);
				if($bio->num_rows > 0){
					foreach ($bio->fetch_array() as $key => $value) {
						if($key != 'password' && !is_numeric($key))
							$_SESSION['bio'][$key] = $value;
					}
				}
			}
			if(isset($_SESSION['bio']) && $_SESSION['bio']['status'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";
		if($type == 1)
			$establishment_id = 0;
		$data .= ", establishment_id = '$establishment_id' ";
		$chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	
	function signup() {
		extract($_POST);
	
		// Determine employment status
		$currentlyEmployed = isset($_POST['currentlyEmployed']) ? 1 : 0;
	
		// Prepare user data
		$data = "name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
	
		// Check if username already exists
		$chk = $this->db->query("SELECT * FROM users WHERE username = '$email'")->num_rows;
		if ($chk > 0) {
			return "Username is already used!"; // Username already exists
		}
	
		// Insert user data
		$save = $this->db->query("INSERT INTO users SET $data");
		if (!$save) {
			die("Error inserting user: " . $this->db->error); // Output the SQL error
		}
	
		$uid = $this->db->insert_id;
	
		// Handle image upload
		if (isset($_FILES['img']['tmp_name']) && $_FILES['img']['tmp_name'] != '') {
			// Get image content as binary
			$img = addslashes(file_get_contents($_FILES['img']['tmp_name']));
		} else {
			// Use default image if no file is uploaded
			$img = addslashes(file_get_contents('path/to/default/image.png')); // Add your default image path here
		}
	
		// Prepare alumnus data
		$alumnus_data = "firstname = '$firstname', 
						 middlename = '$middlename', 
						 lastname = '$lastname', 
						 gender = '$gender', 
						 batch = '$batch', 
						 course_id = '$course_id', 
						 email = '$email', 
						 currentlyEmployed = '$currentlyEmployed',
						 status = '1',
						 img = '$img', 
						 studentId = '$studentId', 
						 homeAddress = '$homeAddress', 
						 mobileNumber = '$mobileNumber',
						 occupation = '$occupation', 
						 company = '$company', 
						 contact_method = '$contact_method',
						 kinderSchool = '$kinderSchool', 
						 kinderYear = '$kinderYear',
						 gradeSchool = '$gradeSchool', 
						 gradeSchoolYear = '$gradeSchoolYear',
						 juniorHighSchool = '$juniorHighSchool', 
						 juniorHighSchoolYear = '$juniorHighSchoolYear', 
						 college = '$college',
						 collegeYear = '$collegeYear', 
						 postGrad = '$postGrad', 
						 postGradYear = '$postGradYear',
						 programs = '".json_encode($programs)."',
						 consent = '$consent'";
	
		$insert_query = "INSERT INTO alumnus_bio SET $alumnus_data"; // Print the SQL query for debugging
		$save_alumnus = $this->db->query($insert_query);
		if (!$save_alumnus) {
			die("Error inserting alumnus data: " . $this->db->error); // Output the SQL error
		}
	
		if ($this->db->affected_rows > 0) {
			$aid = $this->db->insert_id;
			$this->db->query("UPDATE users SET alumnus_id = $aid WHERE id = $uid");
			$login = $this->login2();
			if ($login) return 1;
		}
		return 0; // Failure
	}
	
	
	function update_account() {
		extract($_POST);
	
		// Prepare user data for update
		$data = "name = '" . $this->db->real_escape_string($firstname . ' ' . $lastname) . "', ";
		$data .= "username = '" . $this->db->real_escape_string($email) . "' ";
	
		// Check for password update
		if (!empty($password)) {
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$data .= ", password = '$hashed_password' ";
		}
	
		// Check for existing username
		$chk = $this->db->query("SELECT * FROM users WHERE username = '" . $this->db->real_escape_string($email) . "' AND id != '{$_SESSION['login_id']}'")->num_rows;
	
		if ($chk > 0) {
			return 2; // Username already exists
		}
	
		// Update the users table
		$save = $this->db->query("UPDATE users SET $data WHERE id = '{$_SESSION['login_id']}'");
	
		if ($save) {
			$data = '';
			foreach ($_POST as $k => $v) {
				if ($k == 'password') continue; // Skip password
				if (empty($data) && !is_numeric($k)) {
					$data = " $k = '" . $this->db->real_escape_string($v) . "' ";
				} else {
					$data .= ", $k = '" . $this->db->real_escape_string($v) . "' ";
				}
			}
	
			// Handle image upload as binary data
			if ($_FILES['img']['tmp_name'] != '') {
				// Read the image file into a binary string
				$imgData = file_get_contents($_FILES['img']['tmp_name']);
				// Escape binary data for MySQL
				$imgData = $this->db->real_escape_string($imgData);
				// Add the image data to the query
				$data .= ", img = '$imgData' ";
			}
	
			// Update alumnus_bio
			if ($data) {
				$save_alumni = $this->db->query("UPDATE alumnus_bio SET $data WHERE id = '{$_SESSION['bio']['id']}'");
				if ($save_alumni) {
					// Clear session variables and re-login
					session_destroy();
					$login = $this->login2(); // Ensure this function resets session correctly
					if ($login) {
						return 1; // Update successful
					}
				}
			}
		}
	}
	

	function save_settings(){
		extract($_POST);
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['settings'][$key] = $value;
		}

			return 1;
				}
	}

	
	function save_course(){
		extract($_POST);
		$data = " course = '$course' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO courses set $data");
			if($save){
				return 1; // Return 1 for successful insert
			}
		} else {
			$save = $this->db->query("UPDATE courses set $data where id = $id");
			if($save){
				return 2; // Return 2 for successful update
			}
		}
		return 0; // Return 0 if there was an error
	}
	
	
	function delete_course(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM courses where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function update_alumni_acc(){
		extract($_POST);
		$update = $this->db->query("UPDATE alumnus_bio set status = $status where id = $id");
		if($update)
			return 1;
	}

	function save_article() {
    extract($_POST);
    $imageData = null; // Initialize variable for image data

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    } elseif (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
        return 'File upload error: ' . $_FILES['image']['error'];
    }

    if (empty($id)) {
        if ($imageData !== null) {
            $save = $this->db->prepare("INSERT INTO article (title, content, img) VALUES (?, ?, ?)");
            if ($save === false) {
                return 'Prepare failed: (' . $this->db->errno . ') ' . $this->db->error;
            }
            $save->bind_param("sss", $title, $content, $imageData);
        } else {
            $save = $this->db->prepare("INSERT INTO article (title, content) VALUES (?, ?)");
            if ($save === false) {
                return 'Prepare failed: (' . $this->db->errno . ') ' . $this->db->error;
            }
            $save->bind_param("ss", $title, $content);
        }
    } else {
        if ($imageData !== null) {
            $save = $this->db->prepare("UPDATE article SET title = ?, content = ?, img = ? WHERE id = ?");
            if ($save === false) {
                return 'Prepare failed: (' . $this->db->errno . ') ' . $this->db->error;
            }
            $save->bind_param("sssi", $title, $content, $imageData, $id);
        } else {
            $save = $this->db->prepare("UPDATE article SET title = ?, content = ? WHERE id = ?");
            if ($save === false) {
                return 'Prepare failed: (' . $this->db->errno . ') ' . $this->db->error;
            }
            $save->bind_param("ssi", $title, $content, $id);
        }
    }

    if ($save->execute()) {
        $save->close();
        return 1;
    } else {
        $error = 'Execute failed: (' . $save->errno . ') ' . $save->error;
        $save->close();
        return $error;
    }
}
	

	function delete_article() {
		extract($_POST);
		$article = $this->db->query("SELECT img FROM articles WHERE id = $id")->fetch_assoc();
		$delete = $this->db->query("DELETE FROM articles WHERE id = $id");
		if ($delete) {
			if (isset($article['img']) && is_file($article['img'])) {
				unlink($article['img']);
			}
			return 1;
		}
	}
	
	function delete_alumni() {
        extract($_POST);
        $delete = $this->$conn->query("DELETE FROM alumnus_bio where id = ".$id);
        if($delete)
            return 1;
    }

	
	function save_career(){
		extract($_POST);
		$data = " company = '$company' ";
		$data .= ", job_title = '$title' ";
		$data .= ", location = '$location' ";
		$data .= ", description = '".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", links = '$links' ";
		
		if(empty($id)){
			// echo "INSERT INTO careers set ".$data;
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("INSERT INTO career set ".$data);
		}else{
			$save = $this->db->query("UPDATE career set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_career(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM career where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_forum(){
		extract($_POST);
		$data = " title = '$title' ";
		$data .= ", description = '".htmlentities(str_replace("'","&#x2019;",$description))."' ";

		if(empty($id)){
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("INSERT INTO forum_topics set ".$data);
		}else{
			$save = $this->db->query("UPDATE forum_topics set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_forum(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM forum_topics where id = ".$id);
		if($delete){
			return 1;
		}
	}
	
	function save_comment() {
		// Start output buffering to catch any unexpected output
		ob_start();
	
		try {
			extract($_POST);
			$comment = htmlentities(str_replace("'", "&#x2019;", $comment));
			
			$sql = "comment = '$comment' ";
		
			if (empty($id)) {
				// Creating a new comment
				$sql .= ", topic_id = '$topic_id' ";
				$sql .= ", user_id = '{$_SESSION['login_id']}' ";
				$save = $this->db->query("INSERT INTO forum_comments SET $sql");
			} else {
				// Updating an existing comment
				$save = $this->db->query("UPDATE forum_comments SET $sql WHERE id = $id");
			}
		
			if ($save) {
				$response = ['status' => 'success', 'message' => 'Comment saved successfully'];
			} else {
				$response = ['status' => 'error', 'message' => 'Failed to save comment'];
			}
		} catch (Exception $e) {
			$response = ['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()];
		}
	
		// Clear the output buffer and discard any output
		ob_end_clean();
	
		// Send JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}
	
	
	function delete_comment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM forum_comments where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_event(){
		extract($_POST);
		$data = " title = '$title' ";
		$data .= ", schedule = '$schedule' ";
		$data .= ", content = '".htmlentities(str_replace("'","&#x2019;",$content))."' ";
		if($_FILES['banner']['tmp_name'] != ''){
						$_FILES['banner']['name'] = str_replace(array("(",")"," "), '', $_FILES['banner']['name']);
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['banner']['name'];
						$move = move_uploaded_file($_FILES['banner']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", banner = '$fname' ";

		}
		if(empty($id)){

			$save = $this->db->query("INSERT INTO events set ".$data);
		}else{
			$save = $this->db->query("UPDATE events set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_event(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM events where id = ".$id);
		if($delete){
			return 1;
		}
	}
	
	function participate(){
		extract($_POST);
		$data = " event_id = '$event_id' ";
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
		$commit = $this->db->query("INSERT INTO event_commits set $data ");
		if($commit)
			return 1;

	}
}