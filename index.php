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
include 'navbar.php'; // Include the navbar file
?>
<style>
  body {
    background-color: #F5EDED !important;
    z-index: -999;
  }

  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
  }

  #viewer_modal .modal-dialog {
    width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
  }

  #viewer_modal .modal-content {
    background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #viewer_modal img,
  #viewer_modal video {
    max-height: calc(100%);
    max-width: calc(100%);
  }

  a.jqte_tool_label.unselectable {
    height: auto !important;
    min-width: 4rem !important;
    padding: 5px
  }

  .list-group .nav-item {
    list-style-type: none;
    text-decoration: none !important;
  }

  .not_member {
    position: relative;
    top: 18rem;
  }
.loggedin-contact{
  position: relative;
  left: 10rem;
}
</style>

<body>

  <?php
  $page = isset($_GET['page']) ? $_GET['page'] : "home";
  if (!isset($_SESSION['login_id'])): ?>
    <div class="main-content">
      <?php if (in_array($page, ['about', 'contact', 'signup'])): ?>
        <div class="content">
          <?php include "{$page}.php"; ?>
        </div>
      <?php else: ?>
        <div class="content">
          <?php include "not_member.php"; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <div class="main-content">
      <?php if (!in_array($page, ['about', 'contact', 'article', 'forum', 'careers'])): ?>
        <div class="side-bar">
          <?php include 'sidebar.php'; ?>
        </div>
      <?php endif; ?>
      <div class="content .loggedin-contact">
        <?php include "{$page}.php"; ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit'
            onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-righ t"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
        <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>

  <?php include ('footer.php') ?>
</body>

<script type="text/javascript">
  $(document).ready(function () {
    console.log("jQuery version:", $.fn.jquery);
    $('.login').click(function () {
      uni_modal("Login", 'login.php');
    });
  });
</script>
<?php $conn->close(); ?>

</html>