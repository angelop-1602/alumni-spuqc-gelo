<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        position: relative;
        top: 12rem;
    }

    .hero-left,
    .hero-right {
        flex: 1;
        padding: 30px;
        min-width: 450px;
    }

    .section-2 {
        width: 100%;
        margin: auto;
    }

    .container h1 {
        font-size: 2rem;
        text-align: center;
    }

    .hero-right p {
        font-size: 1.1rem;
    }

    .color-bg {
        z-index: -2;
        position: absolute;
        bottom: -29rem;
        width: 100%;
        padding: 10rem 0 14rem 0;
        background: rgb(245, 246, 107);
        background: linear-gradient(90deg, rgba(245, 246, 107, 1) 0%, rgba(38, 142, 42, 1) 19%, rgba(38, 142, 42, 1) 81%, rgba(245, 246, 107, 1) 100%);
    }

    .container header {
        background-color: white;
        padding: 3rem;
        border: 2px solid black;
        text-align: center;
        margin: 0 auto 2rem auto;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    .partners-img {
        display: flex;
        overflow: hidden;
        width: 100%;
        grid-column-gap: 1rem;
    }

    .marquee-content {
        display: flex;
        justify-content: flex-start;
        flex: 0 0 auto;
        grid-column-gap: 1rem;
        width: auto;
    }

    .partners-img img {
        max-width: 100%;
        height: auto;
    }

    .scroll {
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

    @media (width: 425px) {
        .section-1 {
            top: 5rem;
        }
    }

    @media (width: 768px) {

        .color-bg {
            z-index: -2;
            position: absolute;
            bottom: -77rem;
            width: 100%;
        }

        .container header h1 {
            font-size: 1.2rem;
            padding: .2rem;
        }

    }

    @media (width: 1024px) {
        .color-bg {
            bottom: -19rem;
            width: 100%;
        }


    }

    @media (width: 1440px) {
        .color-bg {
            z-index: -2;
            position: absolute;
            bottom: -6rem;
            width: 100%;
        }
    }
</style>

<div class="container section-1">
    <div class="hero-left">
        <img src="./assets/img/about-image.png" alt="">
    </div>

    <div class="hero-right">
        <h1>About St. Paul University Quezon City</h1>
        <p>
            St. Paul University Quezon City (SPUQC) is a not-for-profit Catholic university in the Philippines. It is
            one
            of thirty-six (36) schools operating under the Sisters of St. Paul of Chartres (SPC) management in the
            Philippines. Situated on a gentle slope of what was initially known as New Manila, the campus now occupies
            an entire block bordered by busy Aurora Boulevard, Gilmore Avenue, Third Street, and Doña Magdalena Hemady
            Street in Quezon City. It is recognized by the Commission on Higher Education (CHEd), the Philippine
            Accrediting Association of Schools, Colleges, and Universities (PAASCU), the Philippine Association of
            Colleges and Universities Commission on Accreditation (PACUCOA), the International Organization for
            Standardization (ISO), and United Nations Academic Impact (UNAI) accredited university.
        </p>
        <p>
            While tremendous changes have occurred, one important factor has remained constant: the SPUQC Paulinian,
            whether a religious, faculty member, non-teaching staff member, or student, has remained warm, simple, and
            active.
        </p>
    </div>
</div>
<div class="color-bg"></div>
<div class="container section-2">
    <header>
        <h1>Our Institutional Partners for Transformative Education</h1>
    </header>

    <div class="partners-img">
        <div class="scroll marquee-content">
            <?php
            $images = glob('./assets/img/partners-images/*.{jpg,jpeg,png,gif}', GLOB_BRACE); // Get all image files
            foreach ($images as $image) {
                echo '<img src="' . $image . '" alt="Partner Image" style="max-width: 250px; height: auto; padding: 10px;" loading="lazy">'; // Display each image
            }
            ?>
        </div>
    </div>
    <script>
        function updateMarqueDivWidth() {

            const flexContainer = document.querySelector('.marquee');
            const flexItems = document.querySelectorAll('.marquee .scroll');

            let totalWidth = 0;
            flexItems.forEach((item) => {
                totalWidth += item.offsetWidth;
            });

            flexContainer.style.width = totalWidth + 'px';

        }
        window.addEventListener('load', updateMarqueDivWidth);
        window.addEventListener('resize', updateMarqueDivWidth);
    </script>