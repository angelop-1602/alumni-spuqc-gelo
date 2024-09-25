<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPUQC Alumni Page</title>
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Link to your CSS -->
    <script src="path/to/jquery.js"></script> <!-- Include jQuery -->
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Include Bootstrap CSS -->
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .hero-sec {
            padding: 200px 0;
            background-image: url(assets/img/hero.jpg);
            background-size: cover; /* Change from contain to cover */
            background-position: center; /* Center the image */
            color: white;
            text-align: center;
            
        }
        .hero-sec h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .hero-sec p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }
        .btn {
            background-color: #005E26;
            color: #fff;
            border-radius: 5px;
            padding: 16px 32px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn:hover {
            background-color: #004b1f;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        .card img {
            border-radius: 10px 10px 0 0;
        }
        .content {
            margin: 40px 0;
        }
        .text-section {
            margin-bottom: 40px;
            text-align: center;
        }
        .text-section h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .alumni-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="hero-sec">
        <h1>Welcome to SPUQC Alumni!</h1>
        <p>Join our community of successful alumni and stay connected!</p>
        <button type="button" class="btn" onclick="uni_modal('Login', 'login.php')">Log In</button>
    </div>

    <div class="container content">
        <div class="text-section">
            <h2>About Us</h2>
            <p>Our alumni are our pride. At SPUQC, we believe in fostering connections and providing support to our alumni as they embark on their professional journeys. Stay engaged with your alma mater and connect with fellow graduates!</p>
        </div>

        <div class="text-section">
            <h2>Upcoming Events</h2>
            <p>Join us for our upcoming alumni events! Network with fellow alumni, attend workshops, and participate in exciting activities.</p>
        </div>

        <div class="text-section">
            <h2>Alumni Gallery</h2>
            <p>Check out our gallery to see photos from recent events and reunions!</p>
            <div class="row alumni-gallery">
                <div class="col-md-3">
                    <div class="card">
                        <img src="path/to/image1.jpg" class="card-img-top" alt="Alumni Event 1">
                        <div class="card-body">
                            <h5 class="card-title">Alumni Gathering 2023</h5>
                            <p class="card-text">A memorable reunion with old friends and faculty.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="path/to/image2.jpg" class="card-img-top" alt="Alumni Event 2">
                        <div class="card-body">
                            <h5 class="card-title">Career Development Workshop</h5>
                            <p class="card-text">Enhancing skills and networking opportunities.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="path/to/image3.jpg" class="card-img-top" alt="Alumni Event 3">
                        <div class="card-body">
                            <h5 class="card-title">Annual Alumni Awards</h5>
                            <p class="card-text">Celebrating achievements of our distinguished alumni.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="path/to/image4.jpg" class="card-img-top" alt="Alumni Event 4">
                        <div class="card-body">
                            <h5 class="card-title">Networking Night</h5>
                            <p class="card-text">Connecting alumni with industry leaders.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-section">
            <h2>Stay Connected</h2>
            <p>Follow us on our social media platforms to stay updated on alumni news and events!</p>
        </div>
    </div>

    <?php include('footer.php'); ?>
    
    <script type="text/javascript">
        // Ensure the uni_modal function is defined to open the modal
        function uni_modal(title, url) {
            $('#uni_modal .modal-title').text(title);
            $('#uni_modal .modal-body').load(url, function () {
                $('#uni_modal').modal('show');
            });
        }
    </script>
</body>
</html>
