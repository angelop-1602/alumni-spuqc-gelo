<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Paul University Quezon</title>
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Link to your CSS -->
    <script src="path/to/jquery.js"></script> <!-- Include jQuery -->
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Include Bootstrap CSS -->
    <style>
        body {
            font-family: "Poppins";
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
        .modal {
            padding-top: 100px; /* Adjust as necessary */
        }
        .modal-dialog {
            max-height: 80vh; /* Limit height of modal */
            overflow: hidden; /* Prevent scrolling */
        }
        .modal-body {
            overflow-y: auto; /* Allow vertical scrolling inside the body only if necessary */
        }
        .main-content {
            margin: 0; /* Remove margins that could affect the modal */
            padding: 0; /* Remove padding that could affect the modal */
        }
        .not-member-container {
            text-align: center;
            margin-top: 5rem; /* Space from the top */
        }
        .not-member-container h2 {
            color: #333; /* Dark text for the heading */
        }
        .not-member-container p {
            color: #555; /* Gray text for the paragraph */
        }
        .not-member-container a {
            background-color: #007bff; /* Button color */
            color: white; /* Button text color */
            padding: 10px 20px; /* Button padding */
            border-radius: 5px; /* Rounded corners */
            text-decoration: none; /* No underline */
            display: inline-block; /* Make it a block element */
            margin-top: 1rem; /* Space above the button */
        }
        .not-member-container a:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .signup-link {
            display: block; /* Make it a block element */
            margin-top: 1rem; /* Space above the link */
            color: #007bff; /* Link color */
            text-decoration: none; /* No underline */
        }
        .signup-link:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
    
    // Fetch system settings
    $query = $conn->query("SELECT * FROM system_settings LIMIT 1")->fetch_array();
    foreach ($query as $key => $value) {
        if (!is_numeric($key)) {
            $_SESSION['system'][$key] = $value;
        }
    }
    ob_end_flush();

    include 'header.php';
    if (isset($_SESSION['login_id'])): 
        include 'navbar.php';
    endif;
    ?>

    <div class="main-content">
        <div class="container">
            <?php 
            // Get current page
            $page = isset($_GET['page']) ? $_GET['page'] : "not_member"; 

            // Define pages that can be accessed without logging in
            $public_pages = ['not_member','about', 'contact', 'signup', 'login']; 
            
            // Check if user is not logged in
            if (!isset($_SESSION['login_id'])): 
                // If user is not logged in, set 'not_member' as the current page
            endif; 
            ?>

            <div class="content">
                <?php 
                // Load the requested page for logged-in users or the not_member page for non-logged-in users
                if (in_array($page, $public_pages) || isset($_SESSION['login_id'])): 
                    include "{$page}.php"; 
                else: ?>
                    <div class="not-member-container">
                        <h2>Access Denied</h2>
                        <p>You need to log in to view this page.</p>
                        <a href="#" class="login-action">Login</a>
                        <a href="index.php?page=signup" class="signup-link">Create New Account</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="uni_modal" tabindex="-1" role="dialog" aria-labelledby="uniModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uniModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include 'login.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>

    <script type="text/javascript">
        $(document).ready(function () {
            console.log("jQuery version:", $.fn.jquery);

            // Trigger login modal if the user is not logged in
            $('.login-action').click(function (e) {
                e.preventDefault(); // Prevent default action
                $('#uni_modal').modal('show'); // Show the modal
            });
        });

        // Ensure the uni_modal function is defined to open the modal
        function uni_modal(title, url) {
            $('#uni_modal .modal-title').text(title);
            $('#uni_modal .modal-body').load(url, function () {
                $('#uni_modal').modal('show');
            });
        }
    </script>

    <?php $conn->close(); ?>
</body>
</html>
