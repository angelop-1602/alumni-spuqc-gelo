<?php
include 'admin/db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the data
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

$course_id = $alumnus['course_id'];
$course_sql = "SELECT course FROM courses WHERE id = ?";
$course_stmt = $conn->prepare($course_sql);
$course_stmt->bind_param("i", $course_id);
$course_stmt->execute();
$course_result = $course_stmt->get_result();
$course = $course_result->fetch_assoc();
?>
    <style>
    .container {
            max-width: 1000px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .profile-header {
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #eaeaea;
        }
        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }
        .profile-details {
            padding: 20px 0;
        }
        .profile-details h2 {
            font-size: 20px;
            color: #555;
            margin-bottom: 10px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            padding: 8px;
            border-bottom: 1px solid #eaeaea;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
        }
        .update-btn {
            float: right; /* Aligns the button to the right */
            padding: 10px 20px;
            margin-left: 80px;
            background-color: #007bff; /* Bootstrap primary color */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* No underline */
        }
        .update-btn:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
    <div class="container">
        <div class="profile-header">
            <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($alumnus['img']); ?>" alt="Profile Image">
            <h1><?php echo $alumnus['firstname'] . " " . $alumnus['lastname']; ?>'s Profile</h1>
        <a href="index.php?page=update_profile" class="update-btn">Update Profile</a> <!-- Update Profile Button -->
        </div>
        <div class="profile-details">
            <h2>Profile Information</h2>
            <div class="detail-row">
                <span class="detail-label">Last Name:</span>
                <span><?php echo $alumnus['lastname']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">First Name:</span>
                <span><?php echo $alumnus['firstname']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Middle Name:</span>
                <span><?php echo $alumnus['middlename']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Gender:</span>
                <span><?php echo $alumnus['gender']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Batch:</span>
                <span><?php echo $alumnus['batch']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Course ID:</span>
                <span><?php echo $course['course']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span><?php echo $alumnus['email']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Student ID:</span>
                <span><?php echo $alumnus['studentId']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Home Address:</span>
                <span><?php echo $alumnus['homeAddress']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Mobile Number:</span>
                <span><?php echo $alumnus['mobileNumber']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Currently Employed:</span>
                <span><?php echo $alumnus['currentlyEmployed'] ? 'Yes' : 'No'; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Occupation:</span>
                <span><?php echo $alumnus['occupation']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Company:</span>
                <span><?php echo $alumnus['company']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Preferred Contact Method:</span>
                <span><?php echo $alumnus['contact_method']; ?></span>
            </div>
            <h2>Education</h2>
            <div class="detail-row">
                <span class="detail-label">Kinder School:</span>
                <span><?php echo $alumnus['kinderSchool']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Kinder Year:</span>
                <span><?php echo $alumnus['kinderYear']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Grade School:</span>
                <span><?php echo $alumnus['gradeSchool']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Grade School Year:</span>
                <span><?php echo $alumnus['gradeSchoolYear']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Junior High School:</span>
                <span><?php echo $alumnus['juniorHighSchool']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Junior High School Year:</span>
                <span><?php echo $alumnus['juniorHighSchoolYear']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">College:</span>
                <span><?php echo $alumnus['college']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">College Year:</span>
                <span><?php echo $alumnus['collegeYear']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Post Grad:</span>
                <span><?php echo $alumnus['postGrad']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Post Grad Year:</span>
                <span><?php echo $alumnus['postGradYear']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Programs taken in SPUQC:</span>
                <span><?php echo $alumnus['programs']; ?></span>
            </div>
        </div>
    </div>
