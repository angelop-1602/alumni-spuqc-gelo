<?php 
include 'admin/db_connect.php'; 

?>
<style>
    img#cimg{
        max-height: 10vh;
        max-width: 6vw;
    }
</style>
            <div class="container mt-3 pt-2">
               <div class="col-lg-12">
                   <div class="card mb-4">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <form action="" id="update_account">
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Last Name</label>
                                                <input type="text" class="form-control" name="lastname" value="<?php echo $_SESSION['bio']['lastname'] ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">First Name</label>
                                                <input type="text" class="form-control" name="firstname" value="<?php echo $_SESSION['bio']['firstname'] ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Middle Name</label>
                                                <input type="text" class="form-control" name="middlename" value="<?php echo $_SESSION['bio']['middlename'] ?>" >
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Gender</label>
                                                <select class="custom-select" name="gender" required>
                                                    <option <?php echo $_SESSION['bio']['gender'] =='Male' ? 'selected' : '' ?>>Male</option>
                                                    <option <?php echo $_SESSION['bio']['gender'] =='Female' ? 'selected' : '' ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Batch</label>
                                                <input type="input" class="form-control datepickerY" name="batch" value="<?php echo $_SESSION['bio']['batch'] ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Course Graduated</label>
                                                <select class="custom-select select2" name="course_id" required>
                                                    <option></option>
                                                    <?php 
                                                    $course = $conn->query("SELECT * FROM courses order by course asc");
                                                    while($row=$course->fetch_assoc()):
                                                    ?>
                                                        <option value="<?php echo $row['id'] ?>"  <?php echo $_SESSION['bio']['course_id'] ==$row['id'] ? 'selected' : '' ?>><?php echo $row['course'] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-5">
                                                <label for="" class="control-label">Currently Connected To</label>
                                                <textarea name="connected_to" id="" cols="30" rows="3" class="form-control"><?php echo $_SESSION['bio']['connected_to'] ?></textarea>
                                            </div>
                                            <?php 
$avatar = !empty($_SESSION['bio']['avatar']) ? $_SESSION['bio']['avatar'] : 'default_avatar.png'; // Use a default image if none is set
?>
                                            <div class="col-md-5">
                                                <label for="" class="control-label">Image</label>
                                                <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
                                                <img src="admin/assets/uploads/<?php echo $avatar; ?>" alt="Profile Picture" id="cimg">

                                            </div>  
                                        </div>
                                        <div class="row">
                                             <div class="col-md-4">
                                                <label for="" class="control-label">Email</label>
                                                <input type="email" class="form-control" name="email"  value="<?php echo $_SESSION['bio']['email'] ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Password</label>
                                                <input type="password" class="form-control" name="password">
                                                <small><i>Leave this blank if you dont want to change your password</i></small>
                                            </div>
                                        </div>

                                        <!-- Additional Fields -->
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Student ID</label>
                                                <input type="text" class="form-control" name="studentId" value="<?php echo $_SESSION['bio']['studentId'] ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Home Address</label>
                                                <input type="text" class="form-control" name="homeAddress" value="<?php echo $_SESSION['bio']['homeAddress'] ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Mobile Number</label>
                                                <input type="tel" class="form-control" name="mobileNumber" value="<?php echo $_SESSION['bio']['mobileNumber'] ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Currently Employed</label>
                                                <input type="checkbox" id="currentlyEmployed" name="currentlyEmployed" <?php echo $_SESSION['bio']['currentlyEmployed'] ? 'checked' : '' ?>>
                                                <input type="hidden" id="currentlyEmployedHidden" name="currentlyEmployedHidden" value="<?php echo $_SESSION['bio']['currentlyEmployed'] ? '1' : '0' ?>">
                                            </div>
                                        </div>
                                        <div id="employmentDetails" style="display: <?php echo $_SESSION['bio']['currentlyEmployed'] ? 'block' : 'none' ?>;">
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <label for="" class="control-label">Job Title</label>
                                                    <input type="text" class="form-control" name="occupation" id="occupation" value="<?php echo $_SESSION['bio']['occupation'] ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="" class="control-label">Company/Organization</label>
                                                    <input type="text" class="form-control" name="company" id="company" value="<?php echo $_SESSION['bio']['company'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Preferred Contact Method</label>
                                                <select class="custom-select" name="contact_method">
                                                    <option <?php echo $_SESSION['bio']['contact_method'] == 'Email' ? 'selected' : '' ?>>Email</option>
                                                    <option <?php echo $_SESSION['bio']['contact_method'] == 'Phone' ? 'selected' : '' ?>>Phone</option>
                                                    <option <?php echo $_SESSION['bio']['contact_method'] == 'Mail' ? 'selected' : '' ?>>Mail</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Kindergarten - School Attended</label>
                                                <input type="text" class="form-control" name="kinderSchool" value="<?php echo $_SESSION['bio']['kinderSchool'] ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Year Completed</label>
                                                <input type="text" class="form-control" name="kinderYear" value="<?php echo $_SESSION['bio']['kinderYear'] ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Grade School - School/s Attended</label>
                                                <input type="text" class="form-control" name="gradeSchool" value="<?php echo $_SESSION['bio']['gradeSchool'] ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Year Completed</label>
                                                <input type="text" class="form-control" name="gradeSchoolYear" value="<?php echo $_SESSION['bio']['gradeSchoolYear'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Junior High School - School/s Attended</label>
                                                <input type="text" class="form-control" name="juniorHighSchool" value="<?php echo $_SESSION['bio']['juniorHighSchool'] ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Year Completed</label>
                                                <input type="text" class="form-control" name="juniorHighSchoolYear" value="<?php echo $_SESSION['bio']['juniorHighSchoolYear'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label for="" class="control-label">College - School/s Attended</label>
                                                <input type="text" class="form-control" name="college" value="<?php echo $_SESSION['bio']['college'] ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="control-label">Year Graduated</label>
                                                <input type="text" class="form-control" name="collegeYear" value="<?php echo $_SESSION['bio']['collegeYear'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <label for="" class="control-label">Program/s or Grade Level/s Completed in SPUQC</label>
                                                <p>Please select at most 6 options:</p>
                                                <div>
                                                    <?php
                                                    $programs = [
                                                        "Kinder", "Grade School", "Junior High School", "Senior High School",
                                                        "CBT - BS Business Administration major in Human Resource Mgt",
                                                        "CBT - BS Business Administration major in Marketing",
                                                        "CBT - BS Entrepreneurship", "CBT - BS Hospitality Management",
                                                        "CBT - BS Tourism Management", "CBT - BS Information Technology",
                                                        "CBT - BS in Accountancy", "CBT - BS in Management Accounting",
                                                        "CASE - AB Political Science", "CASE - BA Communication",
                                                        "CASE - Bachelor in Secondary Education major in English",
                                                        "CASE - Bachelor in Secondary Education major in Integrated Social Studies",
                                                        "CASE - Bachelor in Inclusive and Special Needs Education",
                                                        "CASE - AB Religious Education", "CASE - BS Biology",
                                                        "CASE - BS Nursing", "CASE - BS Psychology",
                                                        "CASE - BS Psych with HRD Management", "IGS - Master of Arts in Psychology",
                                                        "IGS - Master of Arts in Values Education", "IGS - Master in Business Administration",
                                                        "IGS - All Women MBA", "IGS - Teacher Certificate Program",
                                                        "IGS - Certificate in Values Education"
                                                    ];
                                                    $selectedPrograms = json_decode($_SESSION['bio']['programs'], true); // Decode the JSON string to an array
foreach ($programs as $program) {
    $checked = (is_array($selectedPrograms) && in_array($program, $selectedPrograms)) ? 'checked' : '';
    echo "<label><input type='checkbox' name='programs[]' value='$program' $checked> $program</label><br>";
}
?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional Fields -->

                                        <div id="msg">
                                            
                                        </div>
                                        <hr class="divider">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-primary">Update Account</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
                
            </div>


<script>
   $('.datepickerY').datepicker({
        format: " yyyy", 
        viewMode: "years", 
        minViewMode: "years"
   })
   $('.select2').select2({
    placeholder:"Please Select Here",
    width:"100%"
   })
   function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
document.addEventListener('DOMContentLoaded', function() {
    let employedCheckbox = document.getElementById('currentlyEmployed');
    let employmentDetails = document.getElementById('employmentDetails');
    let occupationField = document.getElementById('occupation');
    let companyField = document.getElementById('company');
    let employedHidden = document.getElementById('currentlyEmployedHidden');

    employedCheckbox.addEventListener('change', function() {
        if (this.checked) {
            employmentDetails.style.display = 'block';
            employedHidden.value = '1';
        } else {
            employmentDetails.style.display = 'none';
            occupationField.value = '';
            companyField.value = '';
            employedHidden.value = '0';
        }
    });
});

$('#update_account').submit(function(e){
    e.preventDefault()
    start_load()
    $.ajax({
        url:'admin/ajax.php?action=update_account',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(resp){
            if(resp == 1){
                alert_toast("Account successfully updated.",'success');
                setTimeout(function(){
                 location.reload()
                },700)
            }else{
                $('#msg').html('<div class="alert alert-danger">email already exist.</div>')
                end_load()
            }
        }
    })
})
</script>