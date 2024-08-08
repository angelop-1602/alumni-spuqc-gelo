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
    <p>Company: <b><large><?php echo ucwords($title); ?></large></b></p>
    <hr class="divider">
    <?php if (isset($img) && !empty($img)): ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($img); ?>" class="img-fluid">
    <?php endif; ?>
    <?php echo html_entity_decode($content); ?>
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
</style>
<script>
    $('.text-jqte').jqte();
    $('#manage-career').submit(function(e){
        e.preventDefault();
        start_load();
        $.ajax({
            url:'admin/ajax.php?action=save_article',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Data successfully saved.",'success');
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
            }
        });
    });
</script>
