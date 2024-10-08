<?php include 'admin/db_connect.php'; ?>

<?php
// Sanitize the input from the query parameter
$career_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($career_id > 0) {
    $qry = $conn->query("SELECT * FROM career WHERE id = $career_id");
    
    if ($qry && $qry->num_rows > 0) {
        $career_data = $qry->fetch_array(MYSQLI_ASSOC);
        foreach ($career_data as $k => $v) {
            $$k = htmlspecialchars($v); // Escape output to prevent XSS
        }
    } else {
        echo "<p>Career opportunity not found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid request.</p>";
    exit;
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header text-center">
            <h4><?php echo ucwords($job_title); ?></h4>
        </div>
        <div class="card-body">
            <p><strong>Company:</strong> <b><?php echo ucwords($company); ?></b></p>
            <p><strong>Location:</strong> <i class="fa fa-map-marker"></i> <b><?php echo ucwords($location); ?></b></p>
            <hr class="divider">
            <div class="job-description">
                <?php echo html_entity_decode($description); ?>
            </div>
        </div>
        <div class="modal-footer display">
            <button class="btn btn-secondary float-right" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<style>
    body {
        font-family: "Poppins", sans-serif;
    }

    .container-fluid {
        padding: 20px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background-color: #007bff;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        padding: 20px;
    }

    .job-description {
        line-height: 1.6;
        color: #333;
    }

    .divider {
        border: 1px solid #e0e0e0;
    }

    p {
        margin: 0;
    }

    #uni_modal .modal-footer {
        display: none;
    }

    #uni_modal .modal-footer.display {
        display: block;
    }
</style>

<script>
    // Initialize jqte editor
    $('.text-jqte').jqte();

    // Handle form submission (if you have a form)
    $('#manage-career').submit(function(e) {
        e.preventDefault();
        start_load(); // Ensure this function is defined elsewhere
        $.ajax({
            url: 'admin/ajax.php?action=save_career',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully saved.", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    alert_toast("Failed to save data.", 'error');
                }
            },
            error: function() {
                alert_toast("An error occurred during the request.", 'error');
            }
        });
    });
</script>
