<?php
include 'header.php';
?>
<style>
  @font-face {
      font-family: 'Old English MT'; 
      src: url('../fonts/oldenglishtextmt.ttf') format('truetype'); 
      font-weight: normal;
      font-style: normal;
    }
  
  .navbar {
    width: 100%;
    height: auto;
    background-color: #ffffff;
    color: #343a40;
    justify-content: space-between;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    display: flex;
    align-items: center;
    padding: 10px 20px;
    font-weight: 600;
  }

  .container-fluid {
    width: 100%;
  }

  .row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
  }

  .navbar img {
    width: 80px;
    margin-right: 15px;
  }

  .navbar h3 {
    margin: 0;
  }

  .navbar .title-section h3:first-child {
    font-family: 'Old English MT';
    font-size: 26px;
    color: #28a745;
  }

  .navbar .title-section h3:last-child {
    font-family: 'Montserrat';
    font-size: 18px;
    color: #28a745;
  }

  .navbar-toggler {
    border: none;
  }

  .navbar-nav {
    display: flex;
    align-items: center;
  }

  .navbar-nav .nav-item {
    margin: 0 10px;
  }

  .navbar-nav .nav-link {
    font-size: 18px;
    color: #343a40;
    text-decoration: none;
  }

  .nav-link:hover {
    color: #28a745;
  }

  @media (max-width: 768px) {
    .navbar {
      flex-direction: column;
      text-align: center;
    }

    .title-section {
      margin: 10px 0;
    }

    .navbar-nav {
      flex-direction: column;
    }

    .nav-item {
      margin: 5px 0;
      font-weight: bold;
    }
  }
</style>

<nav class="navbar sticky-top navbar-expand-md mb-5">
  <div class="container-fluid">
    <div class="row align-items-center w-50">
      <!-- Logo Section -->
      <div class="col-md-2 text-center">
        <a href="index.php?page=home">
          <img src="assets/img/logo-qc.png" alt="Logo" class="img-fluid">
        </a>
      </div>

      <!-- Title Section -->
      <div class="col-md-8 text-center title-section">
        <h3>St. Paul University Quezon City</h3>
        <h3>ALUMNI TRACKING SYSTEM</h3>
      </div>

      <!-- Empty for future content -->
      <div class="col-md-2 text-center"></div>
    </div>

    <!-- Navbar Menu Section -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item mx-1">
          <a class="nav-link px-2" href="index.php?page=home">Home</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link px-2" href="index.php?page=articles">Article</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link px-2" href="index.php?page=events">Events</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link px-2" href="index.php?page=courses">Course List</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link px-2" href="index.php?page=alumni">Alumni List</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link px-2" href="index.php?page=jobs">Job</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link px-2" href="index.php?page=forums">Forums</a>
        </li>
      </ul>
    </div>
    <div class="float-right">
                <div class="dropdown mr-4">
                    <a href="#" class="text-dark dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
                    <div class="dropdown-menu" aria-labelledby="account_settings">
                        <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                        <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
  </div>
</nav>


    <div class="content">
        <!-- Page Content goes here -->
    </div>

    <script>
        $(document).ready(function() {
            $('#manage_my_account').click(function() {
                uni_modal("Manage Account", "manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
            });
        });
    </script>