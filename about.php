<!DOCTYPE html>
<html lang="en">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f2ef;  
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
        .scroll {
            animation: scroll 80s linear infinite;
        }
        @keyframes scroll {
            from { transform: translateX(0); }
            to { transform: translateX(calc(-100% - 1rem)); }
        }
        .btn {
            background-color: #005E26;
            color: #fff;
            border-radius: 5px;
            padding: 16px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .hero-sec {
            margin-top: 4rem;
            margin-bottom: 4rem;
        }
        @media (max-width: 768px) {
            .hero-sec {
                margin-top: 2rem;
                margin-bottom: 2rem;
            }
        }
    </style>
<body>
    <main class="container mx-auto px-4 py-8">
        <!-- About Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-wrap">
                <div class="w-full lg:w-1/3 pr-8 mb-6 lg:mb-0">
                    <img src="./assets/img/about-image.png" alt="St. Paul University Quezon City" class="rounded-lg shadow-md w-full">
                </div>
                <div class="w-full lg:w-2/3">
                    <h2 class="text-2xl font-bold spuqc-green-text mb-4">Our Legacy of Excellence</h2>
                    <p class="text-gray-700 mb-4">
                        St. Paul University Quezon City (SPUQC) is a prestigious not-for-profit Catholic university in the Philippines. As one of thirty-six schools under the Sisters of St. Paul of Chartres (SPC) management, we carry a rich tradition of academic excellence and spiritual growth.
                    </p>
                    <p class="text-gray-700 mb-4">
                        Our campus, nestled in the heart of Quezon City, provides a nurturing environment for students to learn, grow, and excel. We are proud to be recognized by esteemed institutions such as the Commission on Higher Education (CHEd), PAASCU, PACUCOA, ISO, and the United Nations Academic Impact (UNAI).
                    </p>
                    <a href="https://spuqc.edu.ph/" class="spuqc-green text-white py-2 px-4 rounded hover:bg-green-700 transition duration-300">Learn More</a>
                </div>
            </div>
        </div>

        <!-- Core Values Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-2xl font-bold spuqc-green-text mb-6">Our Core Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-semibold spuqc-green-text mb-2">Faith</h3>
                    <p class="text-gray-700">Guided by Catholic principles in all our endeavors</p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-semibold spuqc-green-text mb-2">Excellence</h3>
                    <p class="text-gray-700">Striving for the highest standards in education and research</p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-semibold spuqc-green-text mb-2">Service</h3>
                    <p class="text-gray-700">Committed to serving our community and society at large</p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-semibold spuqc-green-text mb-2">Innovation</h3>
                    <p class="text-gray-700">Embracing new ideas and technologies to advance education</p>
                </div>
            </div>
        </div>

        <!-- Alumni System Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-2xl font-bold spuqc-green-text mb-4">SPUQC Alumni System: Bridging Past and Future</h2>
            <div class="flex flex-wrap">
                <div class="w-full lg:w-2/3 pr-8">
                    <p class="text-gray-700 mb-4">
                        The St. Paul University Quezon City Alumni System is a vital platform designed to foster lasting connections between our esteemed graduates and their alma mater. This dynamic network serves as a bridge, linking the rich legacy of our past with the promising future of our institution and its alumni.
                    </p>
                    <p class="text-gray-700 mb-4">
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
                <div class="w-full lg:w-1/3">
                    <img src="/api/placeholder/400/300" alt="SPUQC Alumni" class="rounded-lg shadow-md w-full">
                </div>
            </div>
        </div>

        <!-- Message and Login Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8 hero-sec">
            <div class="row justify-content-center">
                <div class="col-lg-6 d-flex flex-column justify-content-center align-items-start hero-left">
                    <h2 class="text-2xl font-bold spuqc-green-text mb-4">Leave a message!</h2>
                    <p class="text-gray-700 mb-4">Be part of our community</p>
                    <button type="button" class="btn" onclick="uni_modal('Login', 'login.php')">Log In</button>
                </div>
                <div class="col-lg-6">
                    <form action="" method="post" class="mt-4">
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="form-group mb-4">
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Institutional Partners Section -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-bold spuqc-green-text mb-6">Our Institutional Partners</h2>
            <div class="overflow-hidden">
                <div class="flex scroll">
                    <?php
                    $images = glob('./assets/img/partners-images/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    foreach ($images as $image) {
                        echo '<img src="' . $image . '" alt="Partner" class="mx-4" style="max-width: 150px; height: auto;" loading="lazy">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="spuqc-green text-white py-8 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 St. Paul University Quezon City. All rights reserved.</p>
            <div class="mt-4">
                <a href="#" class="mx-2 hover:text-yellow-300">Privacy Policy</a>
                <a href="#" class="mx-2 hover:text-yellow-300">Terms of Service</a>
                <a href="#" class="mx-2 hover:text-yellow-300">Contact Us</a>
            </div>
        </div>
    </footer>

    <!-- Modal structure for login -->
    <div class="modal fade" id="uni_modal" tabindex="-1" role="dialog" aria-labelledby="uni_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uni_modalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- The login form will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateMarqueeWidth() {
            const scrollContainer = document.querySelector('.scroll');
            const scrollContent = scrollContainer.innerHTML;
            scrollContainer.innerHTML = scrollContent + scrollContent;
        }
        window.addEventListener('load', updateMarqueeWidth);
        window.addEventListener('resize', updateMarqueeWidth);

        // Function to open the modal
        function uni_modal(title, url) {
            $('#uni_modal .modal-title').text(title);
            $('#uni_modal .modal-body').load(url, function () {
                $('#uni_modal').modal('show');
            });
        }
    </script>
</body>
</html>