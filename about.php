<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Paul University Quezon City</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f2ef;
            margin: 0;
        }

        .spuqc-green {
            background-color: #268e2a;
        }

        .spuqc-yellow {
            background-color: #f5f66b;
        }

        .spuqc-green-text {
            color: #268e2a;
        }

        .btn {
            background-color: #005E26;
            color: #fff;
            border-radius: 5px;
            padding: 16px;
            transition: background-color 0.3s, box-shadow 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #003d1b;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            padding: 2rem;
        }

        .section img {
            width: 100%;
            border-radius: 8px;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }

        /* Flexbox alignment for sections */
        .flex {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .text-section {
            flex: 1 1 60%;
        }

        .img-section {
            flex: 1 1 35%;
        }

        .core-values {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .value-card {
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            background-color: #fff;
        }

        .value-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .scroll {
            display: flex;
            gap: 20px;
            animation: scroll 80s linear infinite;
        }

        @keyframes scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(calc(-100% - 1rem));
            }
        }

        footer {
            background-color: #268e2a;
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        footer a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-weight: 600;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .hero-sec {
                margin-top: 2rem;
                margin-bottom: 2rem;
            }

            .flex {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <main class="container mx-auto px-4 py-10">
        <!-- About Section -->
        <div class="section">
            <div class="flex">
                <div class="img-section">
                    <img src="./assets/img/about-image.png" alt="St. Paul University Quezon City" class="rounded-lg shadow-md">
                </div>
                <div class="text-section">
                    <h2 class="spuqc-green-text">Our Legacy of Excellence</h2>
                    <p>
                        St. Paul University Quezon City (SPUQC) is a prestigious not-for-profit Catholic university in the Philippines. As one of thirty-six schools under the Sisters of St. Paul of Chartres (SPC) management, we carry a rich tradition of academic excellence and spiritual growth.
                    </p>
                    <p>
                        Our campus, nestled in the heart of Quezon City, provides a nurturing environment for students to learn, grow, and excel. We are proud to be recognized by esteemed institutions such as the Commission on Higher Education (CHEd), PAASCU, PACUCOA, ISO, and the United Nations Academic Impact (UNAI).
                    </p>
                    <a href="https://spuqc.edu.ph/" class="btn">Learn More</a>
                </div>
            </div>
        </div>

        <!-- Core Values Section -->
        <div class="section">
            <h2 class="spuqc-green-text">Our Core Values</h2>
            <div class="core-values">
                <div class="value-card">
                    <h3 class="spuqc-green-text">Faith</h3>
                    <p>Guided by Catholic principles in all our endeavors</p>
                </div>
                <div class="value-card">
                    <h3 class="spuqc-green-text">Excellence</h3>
                    <p>Striving for the highest standards in education and research</p>
                </div>
                <div class="value-card">
                    <h3 class="spuqc-green-text">Service</h3>
                    <p>Committed to serving our community and society at large</p>
                </div>
                <div class="value-card">
                    <h3 class="spuqc-green-text">Innovation</h3>
                    <p>Embracing new ideas and technologies to advance education</p>
                </div>
            </div>
        </div>

        <!-- Alumni System Section -->
        <div class="section">
            <h2 class="spuqc-green-text">SPUQC Alumni System: Bridging Past and Future</h2>
            <div class="flex">
                <div class="text-section">
                    <p>
                        The St. Paul University Quezon City Alumni System is a vital platform designed to foster lasting connections between our esteemed graduates and their alma mater. This dynamic network serves as a bridge, linking the rich legacy of our past with the promising future of our institution and its alumni.
                    </p>
                    <p>
                        Our alumni system facilitates:
                    </p>
                    <ul class="list-disc list-inside text-gray-700 mb-4">
                        <li>Continuous engagement through events, reunions, and networking opportunities</li>
                        <li>Professional development resources and career advancement support</li>
                        <li>Mentorship programs connecting current students with experienced alumni</li>
                        <li>Philanthropic initiatives to support scholarships and university development</li>
                        <li>Access to exclusive SPUQC resources and facilities</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Institutional Partners Section -->
        <div class="section">
            <h2 class="spuqc-green-text">Our Institutional Partners</h2>
            <div class="overflow-hidden">
                <div class="scroll">
                    <?php
                    $images = glob('./assets/img/partners-images/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    foreach ($images as $image) {
                        echo '<img src="' . $image . '" alt="Partner Logo" style="width: 150px; height: auto; border-radius: 10px; margin-right: 20px;">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
