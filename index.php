<!DOCTYPE html>
<?php
session_start();
include ('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
  if (!is_numeric($key))
    $_SESSION['system'][$key] = $value;
}
ob_end_flush();
?>
<?php
include 'header.php';
include 'navbar.php';
?>
<style>
  body {
    background-color: #F5EDED !important;
    z-index: -999;
  }

  .loggedin-contact {
    position: relative;
    left: 10rem;
  }
</style>

<body>
  <div class="main-content">
    <?php if (!isset($_SESSION['login_id'])): ?>
      <div class="content">
        <!-- Content for not logged-in users -->
        <?php include "not_member.php"; ?>
      </div>
    <?php else: ?>
      <div class="content loggedin-contact">
        <?php 
          $page = isset($_GET['page']) ? $_GET['page'] : "home"; 
          include "{$page}.php"; 
        ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Sample button to trigger login prompt if not logged in -->
  <button class="btn btn-primary login-action">Click Me!</button>

  <!-- Login Modal -->
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Login Required</h5>
        </div>
        <div class="modal-body">
          <!-- Login form content (login.php can be included here) -->
          <?php include 'login.php'; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <?php include ('footer.php') ?>
</body>

<script type="text/javascript">
  $(document).ready(function () {
    console.log("jQuery version:", $.fn.jquery);

    // Trigger login modal if user clicks a button and is not logged in
    $('.login-action').click(function () {
      <?php if (!isset($_SESSION['login_id'])): ?>
        // Show login modal
        $('#uni_modal').modal('show');
      <?php else: ?>
        // Action for logged-in users
        alert('You are already logged in!');
      <?php endif; ?>
    });
  });
</script>

<?php $conn->close(); ?>
</html>
