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
  }

  /* Center the main content vertically and horizontally */
  .main-content {
    min-height: 100vh; /* Full viewport height */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .content {
    background-color: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px; /* Limit max width */
    text-align: center;
  }

  .modal-content {
    border-radius: 10px;
  }

  .modal-header {
    background-color: #007bff;
    color: white;
  }

  .modal-footer button {
    background-color: #f8f9fa;
  }
</style>

<body>
  <div class="main-content">
    <div class="container">
      <!-- Check if the user is logged in -->
      <?php if (!isset($_SESSION['login_id'])): ?>
        <div class="content">
          <!-- Content for not logged-in users -->
          <?php include "not_member.php"; ?>
        </div>
      <?php else: ?>
        <div class="content">
          <!-- Content for logged-in users -->
          <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : "home"; 
            include "{$page}.php"; 
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Login Modal -->
  <div class="modal fade" id="uni_modal" tabindex="-1" role="dialog" aria-labelledby="uniModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uniModalLabel">Login Required</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Include the login form -->
          <?php include 'login.php'; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include ('footer.php') ?>
</body>

<script type="text/javascript">
  $(document).ready(function () {
    console.log("jQuery version:", $.fn.jquery);

    // Trigger login modal if the user is not logged in
    $('.login-action').click(function () {
      <?php if (!isset($_SESSION['login_id'])): ?>
        $('#uni_modal').modal('show');
      <?php else: ?>
        alert('You are already logged in!');
      <?php endif; ?>
    });
  });
</script>

<?php $conn->close(); ?>
</html>
