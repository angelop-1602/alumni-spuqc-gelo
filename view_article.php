<?php include 'admin/db_connect.php'; ?>

<?php
// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $article_id = intval($_GET['id']); // Ensure the ID is an integer to prevent SQL injection
    $qry = $conn->query("SELECT * FROM article WHERE id=" . $article_id);
    
    if ($qry) {
        $data = $qry->fetch_assoc(); // Use fetch_assoc() for better clarity
        if ($data) { // Check if data was found
            foreach ($data as $k => $v) {
                $$k = htmlspecialchars($v); // Escape output to prevent XSS
            }
        } else {
            echo "<p>No article found.</p>"; // Handle case where no article is found
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

<div class="container-fluid">
    <p>Company: <b><large><?php echo ucwords($title); ?></large></b></p>
    <hr class="divider">
    
    <?php if (isset($img) && !empty($img)): ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($img); ?>" class="img-fluid" alt="Article Image">
    <?php endif; ?>
    
    <?php echo html_entity_decode($content); // Output content safely ?>
</div>

<div class="modal-footer display">
    <div class="row">
        <div class="col-md-12">
            <button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<style>
    p {
        margin: unset;
    }
    #uni_modal .modal-footer {
        display: none;
    }
    #uni_modal .modal-footer.display {
        display: block;
    }
    .container {
        position: relative;
        top: 12rem; /* Adjust position as needed */
    }
</style>

<script>
    // Initialize any necessary jQuery plugins if used
    $(document).ready(function() {
        $('.text-jqte').jqte(); // Ensure jqte is initialized properly

        // Submit handler for form, if required
        $('#manage-career').submit(function(e) {
            e.preventDefault();
            start_load(); // Assuming this function is defined elsewhere
            $.ajax({
                url: 'admin/ajax.php?action=save_article',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Data successfully saved.", 'success'); // Alert success message
                        setTimeout(function() {
                            location.reload(); // Reload the page after saving
                        }, 1000);
                    }
                },
                error: function() {
                    alert_toast("An error occurred while saving data.", 'danger'); // Alert error message
                }
            });
        });
    });
</script>
