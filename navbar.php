<?php
include 'header.php';
?>
  <style>
    @font-face {
      font-family: 'Old English MT'; 
      src: url('fonts/oldenglishtextmt.ttf') format('truetype'); 
      font-weight: normal;
      font-style: normal;
    }

    body {
      
      margin: 0;
      padding-top: 100px; /* Adjust based on the navbar height */
    }

    .navbar {
      width: 100%;
      height: 100px;
      background-color: #ffffff;
      color: #343a40;
      justify-content: space-between;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      position: absolute; /* Fix navbar at the top */
      top: 0;
      z-index: 1000;
    }

    .nav-main {
      width: 100%;
    }

    .navbar .navbar-brand {
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }

    .navbar img {
      width: 80px;
      margin-left: 1rem;
    }

    .title-section {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-left: 2rem;
    }

    .title-section h3 {
      margin: 0;
    }

    .title-1 {
      font-family: 'Old English MT';
      font-size: 26px;
      color: #28a745;
    }

    .title-2 {
      font-family: 'Montserrat';
      font-size: 18px;
      color: #28a745;
    }

    .navbar .nav-link {
      font-family: 'Poppins';
      font-size: 600;
      text-decoration: none;
      font-size: 27px;
      color: #343a40;
      transition: all 0.3s ease;
      margin: 0 10px;
    }

    @media (max-width: 768px) {
      .navbar .navbar-brand img {
        width: 60px;
      }

      .title-section h3 {
        font-size: 22px;
      }

      .navbar-nav {
        padding-top: 4rem;
        text-align: center;
      }
    }

    @media (max-width: 425px) {
      .navbar .navbar-brand img {
        width: 50px;
      }

      .title-section h3 {
        font-size: 18px;
      }
    }
  </style>

<body>
  <div class="nav-main">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <div class="navbar-brand">
          <!-- Logo Section -->
          <a href="index.php?page=home">
            <img src="assets/img/logo-qc.png" alt="Logo" class="img-fluid">
          </a>
          <!-- Title Section -->
          <div class="title-section">
            <h3 class="title-1">St. Paul University Quezon City</h3>
            <h3 class="title-2">ALUMNI TRACKING SYSTEM</h3>
          </div>
        </div>
        <button class="navbar-toggler ml-auto" style="border: none;" type="button" data-toggle="collapse"
          data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30px" height="20px">
              <path
                d="M 5 8 A 2.0002 2.0002 0 1 0 5 12 L 45 12 A 2.0002 2.0002 0 1 0 45 8 L 5 8 z M 5 23 A 2.0002 2.0002 0 1 0 5 27 L 45 27 A 2.0002 2.0002 0 1 0 45 23 L 5 23 z M 5 38 A 2.0002 2.0002 0 1 0 5 42 L 45 42 A 2.0002 2.0002 0 1 0 45 38 L 5 38 z" />
            </svg>
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto my-2 my-lg-0">
            <li class="nav-item"><a class="nav-link" href="index.php?page=home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=contact">Contact Us</a></li>

            <?php if (!isset($_SESSION['login_id'])): ?>
            <li class="nav-item"></li>
            <?php else: ?>
            <li class="nav-item">
              <div class="dropdown mr-4">
                <a href="#" class="nav-link" id="account_settings" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name']; ?>
                  <i class="fa fa-angle-down"></i></a>
                <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                  <a class="dropdown-item" href="index.php?page=my_account" id="manage_my_account"><i
                      class="fa fa-cog"></i> Manage Account</a>
                  <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i>
                    Logout</a>
                </div>
              </div>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</body>

</html>
