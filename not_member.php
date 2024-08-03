<style>

    .btn {
        background-color: #025F1D;
        color: #fff;
        border-radius: 5px;
        padding: 16px;
        transition: background-color 0.3s, box-shadow 0.3s;
    }
    .hero-sec{
        position: relative;
        top: 20rem;
    }
    .container h1, {
        font-size: 3rem; 
    }
    @media (max-width: 425px) {
       .hero-sec{
        position: relative;
        top: 20rem;
       } 
    }
    @media (max-width: 768px) {
       .hero-sec{
        position: relative;
        top: 120rem;
       } 
    }
    @media (max-width: 1024px) {
       .hero-sec{
        position: relative;
        top: 15rem;
       } 
    }

</style>

<div class="container hero-sec">
    <div class="row justify-content-center">
        <div class="col-lg-6 d-flex flex-column justify-content-center align-items-start hero-left">
            <h1>Leave a message!</h1>
            <p>Be part of our community</p>
            <button type="button" class="btn" onclick="uni_modal('Login', 'login.php')">Log In</button>
        </div>
        <div class="col-lg-6">
            <form action="" method="post" style="margin-top: 2rem;">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message"></textarea>
                </div>
                <button type="submit" class="btn">Send
                    Message</button>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Ensure the uni_modal function is defined to open the modal
    function uni_modal(title, url) {
        // Example of how you might define this function to load a URL into a modal
        $('#uni_modal .modal-title').text(title);
        $('#uni_modal .modal-body').load(url, function () {
            $('#uni_modal').modal('show');
        });
    }
</script>