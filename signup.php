<?php
include 'admin/db_connect.php';
?>
<style>
    img#cimg {
        max-height: 10vh;
        max-width: 6vw;
    }
    .container{
        position: relative;
        top: 12rem;
    }
</style>
<div class="container">
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class=" ">Create Account</h3>
                <hr class="divider my-4" />
                <div class="col-md-12 mb-2 justify-content-center"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-3 pt-2">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <form action="" id="create_account">
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Last Name</label>
                                        <input type="text" class="form-control" name="lastname" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">First Name</label>
                                        <input type="text" class="form-control" name="firstname" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Middle Name</label>
                                        <input type="text" class="form-control" name="middlename">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Gender</label>
                                        <select class="custom-select" name="gender" required>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Batch</label>
                                        <input type="input" class="form-control datepickerY" name="batch" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Course Graduated</label>
                                        <select class="custom-select select2" name="course_id" required>
                                            <option></option>
                                            <?php
                                            $course = $conn->query("SELECT * FROM courses order by course asc");
                                            while ($row = $course->fetch_assoc()):
                                                ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['course'] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-5">
                                        <label for="" class="control-label">Currently Connected To</label>
                                        <textarea name="connected_to" id="" cols="30" rows="3"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="" class="control-label">Image</label>
                                        <input type="file" class="form-control" name="img"
                                            onchange="displayImg(this,$(this))">
                                        <img src="" alt="" id="cimg">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <!-- Additional Fields -->
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Student ID</label>
                                        <input type="text" class="form-control" name="studentId" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Home Address</label>
                                        <input type="text" class="form-control" name="homeAddress" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Mobile Number</label>
                                        <input type="tel" class="form-control" name="mobileNumber" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Currently Employed</label>
                                        <input type="checkbox" id="currentlyEmployed" name="currentlyEmployed">
                                        <input type="hidden" id="currentlyEmployedHidden" name="currentlyEmployedHidden"
                                            value="0">
                                    </div>
                                </div>
                                <div id="employmentDetails" style="display: none;">
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <label for="" class="control-label">Job Title</label>
                                            <input type="text" class="form-control" name="occupation" id="occupation">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="control-label">Company/Organization</label>
                                            <input type="text" class="form-control" name="company" id="company">
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="" class="control-label">LinkedIn Profile</label>
                                        <input type="url" class="form-control" name="linkedin">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Preferred Contact Method</label>
                                        <select class="custom-select" name="contact_method">
                                            <option>Email</option>
                                            <option>Phone</option>
                                            <option>Mail</option>
                                        </select>
                                    </div>
                                    <div class="col-md-10">
                                        <label for="" class="control-label">Interests/Hobbies</label>
                                        <textarea name="interests" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Kindergarten - School Attended</label>
                                        <input type="text" class="form-control" name="kinderSchool" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Year Completed</label>
                                        <input type="text" class="form-control" name="kinderYear" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Grade School - School/s Attended</label>
                                        <input type="text" class="form-control" name="gradeSchool" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Year Completed</label>
                                        <input type="text" class="form-control" name="gradeSchoolYear" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Junior High School - School/s
                                            Attended</label>
                                        <input type="text" class="form-control" name="juniorHighSchool" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Year Completed</label>
                                        <input type="text" class="form-control" name="juniorHighSchoolYear" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="" class="control-label">College - School/s Attended</label>
                                        <input type="text" class="form-control" name="college" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Year Graduated</label>
                                        <input type="text" class="form-control" name="collegeYear" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Post-Graduate - School/s Attended</label>
                                        <input type="text" class="form-control" name="postGrad">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="control-label">Year Graduated</label>
                                        <input type="text" class="form-control" name="postGradYear">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="" class="control-label">Program/s or Grade Level/s Completed in
                                            SPUQC</label>
                                        <p>Please select at most 6 options:</p>
                                        <div>
                                            <label><input type="checkbox" name="programs[]" value="Kinder">
                                                Kinder</label><br>
                                            <label><input type="checkbox" name="programs[]" value="Grade School"> Grade
                                                School</label><br>
                                            <label><input type="checkbox" name="programs[]" value="Junior High School">
                                                Junior High School</label><br>
                                            <label><input type="checkbox" name="programs[]" value="Senior High School">
                                                Senior High School</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CBT - BS Business Administration major in Human Resource Mgt">
                                                CBT - BS Business Administration major in Human Resource Mgt</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CBT - BS Business Administration major in Marketing"> CBT -
                                                BS Business Administration major in Marketing</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CBT - BS Entrepreneurship"> CBT - BS
                                                Entrepreneurship</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CBT - BS Hospitality Management"> CBT - BS Hospitality
                                                Management</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CBT - BS Tourism Management"> CBT - BS Tourism
                                                Management</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CBT - BS Information Technology"> CBT - BS Information
                                                Technology</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CBT - BS in Accountancy"> CBT - BS in Accountancy</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CBT - BS in Management Accounting"> CBT - BS in Management
                                                Accounting</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CASE - AB Political Science"> CASE - AB Political
                                                Science</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CASE - BA Communication"> CASE - BA Communication</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CASE - Bachelor in Secondary Education major in English">
                                                CASE - Bachelor in Secondary Education major in English</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CASE - Bachelor in Secondary Education major in Integrated Social Studies">
                                                CASE - Bachelor in Secondary Education major in Integrated Social
                                                Studies</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CASE - Bachelor in Inclusive and Special Needs Education">
                                                CASE - Bachelor in Inclusive and Special Needs Education</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CASE - AB Religious Education"> CASE - AB Religious
                                                Education</label><br>
                                            <label><input type="checkbox" name="programs[]" value="CASE - BS Biology">
                                                CASE - BS Biology</label><br>
                                            <label><input type="checkbox" name="programs[]" value="CASE - BS Nursing">
                                                CASE - BS Nursing</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CASE - BS Psychology"> CASE - BS Psychology</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="CASE - BS Psych with HRD Management"> CASE - BS Psych with
                                                HRD Management</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="IGS - Master of Arts in Psychology"> IGS - Master of Arts in
                                                Psychology</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="IGS - Master of Arts in Values Education"> IGS - Master of
                                                Arts in Values Education</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="IGS - Master in Business Administration"> IGS - Master in
                                                Business Administration</label><br>
                                            <label><input type="checkbox" name="programs[]" value="IGS - All Women MBA">
                                                IGS - All Women MBA</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="IGS - Teacher Certificate Program"> IGS - Teacher Certificate
                                                Program</label><br>
                                            <label><input type="checkbox" name="programs[]"
                                                    value="IGS - Certificate in Values Education"> IGS - Certificate in
                                                Values Education</label><br>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Fields -->

                                <!-- Consent Statement -->
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="" class="control-label">Consent Statement</label>
                                        <p>I hereby grant SPUQC Communications and Marketing Center (CMC) permission to
                                            collect, process, and use my information as data for education, research,
                                            and marketing purposes of the institution and to be able to comply with its
                                            legal and reportorial obligations under the Philippine laws and regulations.
                                        </p>
                                        <p>I understand that my data will be used solely for the purposes outlined in
                                            this form. I have the right to access, rectify, delete, or restrict the
                                            processing of my data and object to data portability as per applicable laws.
                                        </p>
                                        <p>I may withdraw this consent without affecting the lawfulness of processing
                                            based on consent before its withdrawal.</p>
                                        <label><input type="checkbox" name="consent" value="yes" required> Yes, I
                                            understand.</label>
                                    </div>
                                </div>

                                <!-- Acknowledgment -->
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="" class="control-label">Acknowledgment</label>
                                        <p>By submitting this form, I acknowledge that I have read and understood these
                                            terms and am permitting SPUQC to use my data as stated above.</p>
                                    </div>
                                </div>

                                <div id="msg"></div>
                                <hr class="divider">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary">Create Account</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
    });
    $('.select2').select2({
        placeholder: "Please Select Here",
        width: "100%"
    });
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
        let employedCheckbox = document.getElementById('currentlyEmployed');
        let employmentDetails = document.getElementById('employmentDetails');
        let occupationField = document.getElementById('occupation');
        let companyField = document.getElementById('company');
        let employedHidden = document.getElementById('currentlyEmployedHidden');

        employedCheckbox.addEventListener('change', function () {
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

    $('#create_account').submit(function (e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=signup',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function (resp) {
                if (resp == 1) {
                    location.replace('index.php');
                } else {
                    $('#msg').html('<div class="alert alert-danger">' + resp + '</div>');
                    end_load();
                }
            }
        });
    });

</script>