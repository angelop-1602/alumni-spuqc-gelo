<?php include 'db_connect.php'; ?>
<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM article WHERE id=" . $_GET['id']);
    if ($qry) {
        $data = $qry->fetch_array();
        foreach ($data as $k => $v) {
            $$k = $v;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<div class="container-fluid">
    <form action="" id="manage-article" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" class="form-control">
        <div class="row form-group">
            <div class="col-md-8">
                <label class="control-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-8">
                <label class="control-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo isset($title) ? $title : ''; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <label class="control-label">Content</label>
                <textarea name="content" class="text-jqte"><?php echo isset($content) ? $content : ''; ?></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script>
    $('.text-jqte').jqte();
    $('#manage-article').submit(function(e){
        e.preventDefault();
        start_load();

        var formData = new FormData(this); // Create a FormData object

        $.ajax({
            url: 'ajax.php?action=save_article',
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from converting the data
            contentType: false, // Prevent jQuery from overriding the content type
            success: function(resp){
                if (resp == 1) {
                    alert_toast("Data successfully saved.", 'success');
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                } else {
                    alert_toast("An error occurred: " + resp, 'danger');
                }
            },
            error: function(xhr, status, error){
                alert_toast("An error occurred: " + xhr.responseText, 'danger');
            }
        });
    });
</script>
