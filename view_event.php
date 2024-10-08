<?php include 'admin/db_connect.php'; ?>

<?php
if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']); // Ensure the ID is an integer for security
    $qry = $conn->query("SELECT * FROM events WHERE id = $event_id");
    
    if ($qry) {
        $data = $qry->fetch_assoc(); // Use fetch_assoc for clarity
        if ($data) {
            foreach ($data as $k => $val) {
                $$k = htmlspecialchars($val); // Escape output to prevent XSS
            }
            $commits = $conn->query("SELECT user_id FROM event_commits WHERE event_id = $event_id");
            $cids = array();
            while ($row = $commits->fetch_assoc()) {
                $cids[] = $row['user_id'];
            }
        } else {
            echo "<p>No event found.</p>"; // Handle case where no event is found
            exit; // Stop further execution
        }
    } else {
        echo "Error: " . $conn->error; // Handle database errors
        exit; // Stop further execution
    }
} else {
    echo "<p>Invalid request.</p>"; // Handle case where 'id' is not set
    exit; // Stop further execution
}
?>

<style type="text/css">
    body {
        margin: 0; /* Remove body margin */
        padding: 0; /* Remove body padding */
    }
    .imgs {
        margin: 0.5em;
        max-width: 100%;
        max-height: 100%;
    }
    #imagesCarousel, #imagesCarousel .carousel-inner, #imagesCarousel .carousel-item {
        height: 40vh !important;
        background: black;
    }
    #imagesCarousel img {
        width: 100% !important;
        height: auto !important;
        cursor: pointer;
    }
    #banner {
        display: flex;
        justify-content: center;
    }
    #banner img {
        max-width: 100%;
        max-height: 50vh;
        cursor: pointer;
    }
    .container {
        margin-top: 2rem; /* Adjust margin to your preference */
    }
    <?php if (!empty($banner)): ?>
    header.masthead {
        background: url(admin/assets/uploads/<?php echo $banner ?>);
        background-repeat: no-repeat;
        background-size: cover;
    }
    <?php endif; ?>
</style>

<div class="container">
    <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-4 align-self-end mb-4 pt-2 page-title">
            <h4 class="text-center"><b><?php echo ucwords($title); ?></b></h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-lg-12">
        <div class="card mt-4 mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-3">
                            <b><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A", strtotime($schedule)); ?></b>
                        </p>
                        <?php echo html_entity_decode($content); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr class="divider" style="max-width: calc(100%);" />
                        <div class="text-center">
                            <?php if (isset($_SESSION['login_id'])): ?>
                                <?php if (in_array($_SESSION['login_id'], $cids)): ?>
                                    <span class="badge badge-primary">Committed to Participate</span>
                                <?php else: ?>
                                    <button class="btn btn-primary" id="participate" type="button">Participate</button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#imagesCarousel img, #banner img').click(function () {
        viewer_modal($(this).attr('src')); // Assuming viewer_modal is defined elsewhere
    });

    $('#participate').click(function () {
        _conf("Are you sure you want to commit to participating in this event?", "participate", [<?php echo $event_id; ?>], 'mid-large');
    });

    function participate(id) {
        start_load(); // Assuming this function is defined elsewhere
        $.ajax({
            url: 'admin/ajax.php?action=participate',
            method: 'POST',
            data: { event_id: id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Successfully committed to participate.", 'success');
                    setTimeout(function () {
                        location.reload(); // Reload the page after saving
                    }, 1500);
                } else {
                    alert_toast("Failed to commit participation.", 'danger'); // Alert error message
                }
            },
            error: function () {
                alert_toast("An error occurred while processing your request.", 'danger'); // Alert error message
            }
        });
    }
</script>
