<?php
include 'admin/db_connect.php';

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the user data
$user_id = $_SESSION['login_id']; // Get the logged-in user's ID from the session
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

if ($user) {
    // Now fetch the alumnus bio using the alumnus_id from the users table
    $alumnus_id = $user['alumnus_id']; // Get the alumnus_id from the users table
    $sql = "SELECT * FROM alumnus_bio WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $alumnus_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $alumnus = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update profile logic here
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $gender = $_POST['gender'];
    $batch = $_POST['batch'];
    $course_id = $_POST['course_id'];
    $email = $_POST['email'];
    $studentId = $_POST['studentId'];
    $homeAddress = $_POST['homeAddress'];
    $mobileNumber = $_POST['mobileNumber'];
    $currentlyEmployed = isset($_POST['currentlyEmployed']) ? 1 : 0;
    $occupation = $_POST['occupation'];
    $company = $_POST['company'];
    $linkedin = $_POST['linkedin'];
    $contact_method = $_POST['contact_method'];
    $interests = $_POST['interests'];
    $kinderSchool = $_POST['kinderSchool'];
    $kinderYear = $_POST['kinderYear'];
    $gradeSchool = $_POST['gradeSchool'];
    $gradeSchoolYear = $_POST['gradeSchoolYear'];
    $juniorHighSchool = $_POST['juniorHighSchool'];
    $juniorHighSchoolYear = $_POST['juniorHighSchoolYear'];
    $college = $_POST['college'];
    $collegeYear = $_POST['collegeYear'];
    $postGrad = $_POST['postGrad'];
    $postGradYear = $_POST['postGradYear'];
    $programs = $_POST['programs'];
    $consent = isset($_POST['consent']) ? 1 : 0;

    // Update the alumnus_bio table
    $sql = "UPDATE alumnus_bio SET 
        firstname = ?, 
        lastname = ?, 
        middlename = ?, 
        gender = ?, 
        batch = ?, 
        course_id = ?, 
        status = ?, 
        email = ?, 
        studentId = ?, 
        homeAddress = ?, 
        mobileNumber = ?, 
        currentlyEmployed = ?, 
        occupation = ?, 
        company = ?, 
        linkedin = ?, 
        contact_method = ?, 
        interests = ?, 
        kinderSchool = ?, 
        kinderYear = ?, 
        gradeSchool = ?, 
        gradeSchoolYear = ?, 
        juniorHighSchool = ?, 
        juniorHighSchoolYear = ?, 
        college = ?, 
        collegeYear = ?, 
        postGrad = ?, 
        postGradYear = ?, 
        programs = ?, 
        consent = ? 
        WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissssssisiisssssssssssssss", 
        $firstname, $lastname, $middlename, $gender, $batch, 
        $course_id, $status, $email, $studentId, $homeAddress, 
        $mobileNumber, $currentlyEmployed, $occupation, $company, 
        $linkedin, $contact_method, $interests, $kinderSchool, 
        $kinderYear, $gradeSchool, $gradeSchoolYear, 
        $juniorHighSchool, $juniorHighSchoolYear, $college, 
        $collegeYear, $postGrad, $postGradYear, $programs, 
        $consent, $alumnus_id);
    
    $stmt->execute();

    // Redirect back to profile page after updating
    header('Location: profile.php');
    exit;
}
?>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 800px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 30px;
            color: #343a40;
        }
        .form-group label {
            font-weight: bold;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
        }
        .checkbox-group input {
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 15px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <div class="container">
        <h1>Update Your Profile</h1>
        <?php if ($alumnus): ?>
            <form id="update_account" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($alumnus['firstname']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($alumnus['lastname']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="middlename">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo htmlspecialchars($alumnus['middlename']); ?>">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" <?php echo ($alumnus['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($alumnus['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($alumnus['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="batch">Batch</label>
                    <input type="text" class="form-control" id="batch" name="batch" value="<?php echo htmlspecialchars($alumnus['batch']); ?>">
                </div>

                <div class="form-group">
                    <label for="course_id">Course ID</label>
                    <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo htmlspecialchars($alumnus['course_id']); ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($alumnus['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="studentId">Student ID</label>
                    <input type="text" class="form-control" id="studentId" name="studentId" value="<?php echo htmlspecialchars($alumnus['studentId']); ?>">
                </div>

                <div class="form-group">
                    <label for="homeAddress">Home Address</label>
                    <input type="text" class="form-control" id="homeAddress" name="homeAddress" value="<?php echo htmlspecialchars($alumnus['homeAddress']); ?>">
                </div>

                <div class="form-group">
                    <label for="mobileNumber">Mobile Number</label>
                    <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" value="<?php echo htmlspecialchars($alumnus['mobileNumber']); ?>">
                </div>

                <div class="form-group">
                    <label for="currentlyEmployed">Currently Employed</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="currentlyEmployed" name="currentlyEmployed" <?php echo $alumnus['currentlyEmployed'] ? 'checked' : ''; ?>>
                        <label for="currentlyEmployed">Yes</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($alumnus['occupation']); ?>">
                </div>

                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="<?php echo htmlspecialchars($alumnus['company']); ?>">
                </div>

                <div class="form-group">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($alumnus['linkedin']); ?>">
                </div>

                <div class="form-group">
                    <label for="contact_method">Preferred Contact Method</label>
                    <input type="text" class="form-control" id="contact_method" name="contact_method" value="<?php echo htmlspecialchars($alumnus['contact_method']); ?>">
                </div>

                <div class="form-group">
                    <label for="interests">Interests</label>
                    <input type="text" class="form-control" id="interests" name="interests" value="<?php echo htmlspecialchars($alumnus['interests']); ?>">
                </div>

                <h4>Education</h4>

                <div class="form-group">
                    <label for="kinderSchool">Kinder School</label>
                    <input type="text" class="form-control" id="kinderSchool" name="kinderSchool" value="<?php echo htmlspecialchars($alumnus['kinderSchool']); ?>">
                </div>

                <div class="form-group">
                    <label for="kinderYear">Kinder Year</label>
                    <input type="text" class="form-control" id="kinderYear" name="kinderYear" value="<?php echo htmlspecialchars($alumnus['kinderYear']); ?>">
                </div>

                <div class="form-group">
                    <label for="gradeSchool">Grade School</label>
                    <input type="text" class="form-control" id="gradeSchool" name="gradeSchool" value="<?php echo htmlspecialchars($alumnus['gradeSchool']); ?>">
                </div>

                <div class="form-group">
                    <label for="gradeSchoolYear">Grade School Year</label>
                    <input type="text" class="form-control" id="gradeSchoolYear" name="gradeSchoolYear" value="<?php echo htmlspecialchars($alumnus['gradeSchoolYear']); ?>">
                </div>

                <div class="form-group">
                    <label for="juniorHighSchool">Junior High School</label>
                    <input type="text" class="form-control" id="juniorHighSchool" name="juniorHighSchool" value="<?php echo htmlspecialchars($alumnus['juniorHighSchool']); ?>">
                </div>

                <div class="form-group">
                    <label for="juniorHighSchoolYear">Junior High School Year</label>
                    <input type="text" class="form-control" id="juniorHighSchoolYear" name="juniorHighSchoolYear" value="<?php echo htmlspecialchars($alumnus['juniorHighSchoolYear']); ?>">
                </div>

                <div class="form-group">
                    <label for="college">College</label>
                    <input type="text" class="form-control" id="college" name="college" value="<?php echo htmlspecialchars($alumnus['college']); ?>">
                </div>

                <div class="form-group">
                    <label for="collegeYear">College Year</label>
                    <input type="text" class="form-control" id="collegeYear" name="collegeYear" value="<?php echo htmlspecialchars($alumnus['collegeYear']); ?>">
                </div>

                <div class="form-group">
                    <label for="postGrad">Post Grad</label>
                    <input type="text" class="form-control" id="postGrad" name="postGrad" value="<?php echo htmlspecialchars($alumnus['postGrad']); ?>">
                </div>

                <div class="form-group">
                    <label for="postGradYear">Post Grad Year</label>
                    <input type="text" class="form-control" id="postGradYear" name="postGradYear" value="<?php echo htmlspecialchars($alumnus['postGradYear']); ?>">
                </div>

                <div class="form-group">
                    <label for="programs">Programs</label>
                    <input type="text" class="form-control" id="programs" name="programs" value="<?php echo htmlspecialchars($alumnus['programs']); ?>">
                </div>


                <input type="submit" value="Update Profile" class="btn btn-primary btn-block mt-4">
            </form>
        <?php else: ?>
            <h2 class="text-danger">No profile found to update.</h2>
        <?php endif; ?>
    </div>
    <script>
    $(document).ready(function() {
    $('#update_account').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // AJAX request to update the account
        $.ajax({
            url: 'admin/ajax.php?action=update_account',
            data: new FormData(this), // Send the form data
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Account successfully updated.", 'success');
                    window.location.href = 'index.php?page=login';
                } else if (resp == 2) {
                    $('#msg').html('<div class="alert alert-danger">Email already exists.</div>');
                    end_load(); // End loading
                } else {
                    $('#msg').html('<div class="alert alert-danger">An error occurred.</div>');
                    end_load(); // End loading
                }
            },
            error: function(err) {
                console.error(err);
                end_load(); // End loading in case of error
                $('#msg').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
            }
        });
    });
});
    </script>
