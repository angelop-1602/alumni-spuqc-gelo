<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT a.*, c.course, CONCAT(a.lastname,', ',a.firstname,' ',a.middlename) as name 
                         FROM alumnus_bio a 
                         INNER JOIN courses c ON c.id = a.course_id 
                         WHERE a.id= ".$_GET['id']);
    foreach($qry->fetch_array() as $k => $val){
        $$k=$val;
    }
}

?>
<style type="text/css">
    .avatar {
        display: flex;
        border-radius: 100%;
        width: 100px;
        height: 100px;
        align-items: center;
        justify-content: center;
        border: 3px solid;
        padding: 5px;
    }
    .avatar img {
        max-width: calc(100%);
        max-height: calc(100%);
        border-radius: 100%;
    }
    p{
        margin:unset;
    }
    #uni_modal .modal-footer{
        display: none
    }
    #uni_modal .modal-footer.display{
        display: block
    }
</style>
<div class="container-fluid">
    <div class="col-lg-12">
        <div>
            <center>
                <div class="avatar">
                    <?php if(!empty($img)): ?>
                        <img src="data:image/png;base64,<?php echo base64_encode($img); ?>" alt="Alumni Avatar">
                    <?php else: ?>
                        <img src="path/to/default-avatar.png" alt="Default Avatar">
                    <?php endif; ?>
                </div>
            </center>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p>Name: <b><?php echo $name ?></b></p>
                <p>Email: <b><?php echo $email ?></b></p>
                <p>Student ID: <b><?php echo $studentId ?></b></p>
                <p>Gender: <b><?php echo $gender ?></b></p>
                <p>Batch: <b><?php echo $batch ?></b></p>
                <p>Course: <b><?php echo $course ?></b></p>
                <p>Home Address: <b><?php echo $homeAddress ?></b></p>
                <p>Mobile Number: <b><?php echo $mobileNumber ?></b></p>
                <p>LinkedIn: <b><?php echo $linkedin ? $linkedin : 'N/A' ?></b></p>
                <p>Preferred Contact Method: <b><?php echo $contact_method ? $contact_method : 'N/A' ?></b></p>
                <p>Interests: <b><?php echo $interests ? $interests : 'N/A' ?></b></p>
            </div>
            <div class="col-md-6">
                <p>Employment Status: <b><?php echo $currentlyEmployed == 1 ? 'Employed' : 'Unemployed' ?></b></p>
                <p>Occupation: <b><?php echo $occupation ? $occupation : 'N/A' ?></b></p>
                <p>Company: <b><?php echo $company ? $company : 'N/A' ?></b></p>
                <p>Account Status: <b><?php echo $status == 1 ? '<span class="badge badge-primary">Verified</span>' : '<span class="badge badge-secondary">Unverified</span>' ?></b></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4>Educational Background</h4>
                <p>Kindergarten: <b><?php echo $kinderSchool ?> (<?php echo $kinderYear ?>)</b></p>
                <p>Grade School: <b><?php echo $gradeSchool ?> (<?php echo $gradeSchoolYear ?>)</b></p>
                <p>Junior High School: <b><?php echo $juniorHighSchool ?> (<?php echo $juniorHighSchoolYear ?>)</b></p>
                <p>College: <b><?php echo $college ?> (<?php echo $collegeYear ?>)</b></p>
                <p>Post Graduate: <b><?php echo $postGrad ? $postGrad.' ('.$postGradYear.')' : 'N/A' ?></b></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4>Programs Attended</h4>
                <p><?php echo $programs ? nl2br($programs) : 'No programs listed.' ?></p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer display">
    <div class="row">
        <div class="col-lg-12">
            <button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
            <?php if($status == 1): ?>
            <button class="btn float-right btn-primary update mr-2" data-status = '0' type="button" data-dismiss="modal">Unverify Account</button>
            <?php else: ?>
                <button class="btn float-right btn-primary update mr-2" data-status = '1' type="button" data-dismiss="modal">Verify Account</button>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    $('.update').click(function(){
        start_load()
        $.ajax({
            url:'ajax.php?action=update_alumni_acc',
            method:"POST",
            data:{id:<?php echo $id ?>,status:$(this).attr('data-status')},
            success:function(resp){
                if(resp == 1){
                    alert_toast("Alumnus/Alumna account status successfully updated.")
                    setTimeout(function(){
                        location.reload()
                    },1000)
                }
            }
        })
    })
</script>