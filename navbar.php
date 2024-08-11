<!DOCTYPE html>
<style>
  .greentop {
    width: 100%;
    height: 3.75rem;
    background-color: #025F1D;
  }

  .navbar {
    width: 100%;
    height: 6.9rem;
    background-color: #ffffff;
    color: #343a40;
    justify-content: space-between;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: height 0.3s ease;
    display: flex;
    align-items: center;
  }

  .nav-main {
    z-index: 999;
    width: 100%;
    position: fixed;
  }

  .navbar .navbar-brand {
    position: absolute;
    top: -30px;
    left: 20px;
    display: flex;
    align-items: center;
  }

  .navbar img {
    position: relative;
    margin-left: 10rem;
    top: .2rem;
    width: 20rem;
    animation: moveImageToLeft 1s ease-out forwards;
  }

  @keyframes moveImageToLeft {
    from {
      margin-left: -50rem;
      top: .2rem;
    }

    to {
      margin-left: 10rem;
      top: .2rem;
    }
  }

  .navbar .nav-link {
    text-decoration: none;
    font-size: 27px;
    color: #343a40;
    transition: all 0.3s ease;
    border-radius: 4px;
    margin: 0 10px;
    height: 100%;
  }

  @media (max-width: 768px) {

    .navbar .navbar-brand img {
      width: 14rem;
      right: 8rem;
    }

    .navbar-nav {
      padding-top: 4rem;
      text-align: center;
    }

    .navbar-nav li a {
      padding: 1rem;
    }

    .navbar {
      padding: 1.2rem 1.5rem;
      height: auto;
    }
  }

  @media (max-width: 425px) {
    .greentop {
      width: 100%;
      height: 1.75rem;
      background-color: #025F1D;
    }

    .navbar .navbar-brand img {
      width: 10.5rem;
      margin-top: .7rem;
    }

    .navbar .navbar-brand {
      width: 10rem;
    }

    .navbar {
      padding: .8rem;
      height: auto;
    }

    .navbar-nav {
      margin-top: 1.2rem;
    }
  }

  @media (max-width: 1024px) {
    .navbar .navbar-brand img {
      right: 8rem;
    }
  }

  @media (max-width: 414px) {
    .nav-item {
      display: block;
      text-align: center;
      margin: 10px 0;
    }

    .nav-item a {
      display: block;
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }

    .dropdown-menu {
      position: static;
      width: 100%;
      left: 0 !important;
    }

    .dropdown-menu a {
      display: block;
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }
  }

  a {
    font-size: 25px;
  }

  @media (min-width: 1280px) {
    .nav-show{
      display: none;
    }
  }
  @media (max-width: 1280px) {
    .nav-show{
      display: block;
    }
  }
</style>

<div class="nav-main">
  <div class="greentop"></div>
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body"></div>
  </div>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="./">
        <img src="assets/img/Logo.png" alt="logo">
      </a>
      <button class="navbar-toggler ml-auto" style="border: none;" type="button" data-toggle="collapse"
        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler svg-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30px"
            height="20px">
            <path
              d="M 5 8 A 2.0002 2.0002 0 1 0 5 12 L 45 12 A 2.0002 2.0002 0 1 0 45 8 L 5 8 z M 5 23 A 2.0002 2.0002 0 1 0 5 27 L 45 27 A 2.0002 2.0002 0 1 0 45 23 L 5 23 z M 5 38 A 2.0002 2.0002 0 1 0 5 42 L 45 42 A 2.0002 2.0002 0 1 0 45 38 L 5 38 z" />
          </svg></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=contact">Contact Us</a></li>
     
            <li class="nav-item nav-show"><a class="nav-link js-scroll-trigger" href="index.php?page=article">Article</a></li>
            <li class="nav-item nav-show"><a class="nav-link js-scroll-trigger" href="index.php?page=job">Job</a></li>
            <li class="nav-item nav-show"><a class="nav-link js-scroll-trigger" href="index.php?page=forums">Forums</a></li>
       
          <?php if (!isset($_SESSION['login_id'])): ?>
            <li class="nav-item"></li>
          <?php else: ?>
            <li class="nav-item">
              <div class="dropdown mr-4">
                <a href="#" class="nav-link js-scroll-trigger" id="account_settings" data-toggle="dropdown"
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