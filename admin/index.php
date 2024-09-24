<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?></title>
    
    <?php
    session_start();
    if(!isset($_SESSION['login_id']))
        header('location:login.php');
    include('./header.php'); 
    // include('./auth.php'); 
    ?>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        body {
            background: #f8f9fa;
        }
        .main-content {
            min-height: calc(100vh - 4rem); /* Adjust height to accommodate topbar and footer */
        }
        .modal-dialog.large {
            max-width: 80% !important;
        }
        .modal-dialog.mid-large {
            max-width: 50% !important;
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
            height: 90vh;
        }
        #viewer_modal .modal-content {
            background: black;
            border: unset;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #viewer_modal img, #viewer_modal video {
            max-height: 100%;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <?php include 'topbar.php' ?>
    
    <div class="toast position-fixed top-0 end-0 p-3" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white"></div>
    </div>
    
    <div class="main-content container-fluid py-3">
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        include $page.'.php';
        ?>
    </div>

    <footer class="bg-dark text-light py-3">
        <div class="container text-center">
            &copy; <?php echo date('Y') . ' ' . (isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '') ?>
        </div>
    </footer>

    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="fas fa-chevron-up"></i></a>

    <!-- Modals -->
    <div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirm" onclick="">Continue</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uni_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit" onclick="$('#uni_modal form').submit()">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewer_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal"><span class="fas fa-times"></span></button>
                <img src="" alt="">
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // ... (previous JavaScript code remains the same)
    </script>
</body>
<!-- </html> -->