<?php
include 'admin/db_connect.php';

// Fetch topic details safely
$topic_id = intval($_GET['id']); // Sanitize input
$topic = $conn->query("SELECT f.*, u.name FROM forum_topics f INNER JOIN users u ON u.id = f.user_id WHERE f.id = $topic_id");

if ($topic && $topic->num_rows > 0) {
    foreach ($topic->fetch_array(MYSQLI_ASSOC) as $k => $v) {
        $$k = htmlspecialchars($v); // Escape output to prevent XSS
    }
} else {
    echo "<p>Topic not found.</p>";
    exit;
}

// Fetch comments for the topic
$comments = $conn->query("SELECT f.*, u.name, u.username FROM forum_comments f INNER JOIN users u ON u.id = f.user_id WHERE f.topic_id = $topic_id ORDER BY f.id ASC");
?>

<style>
    body {
        margin: 0;
        padding: 0;
    }
    #portfolio .img-fluid {
        width: 100%;
        height: 30vh;
        z-index: -1;
        position: relative;
        padding: 1em;
    }
    .gallery-img,
    .gallery-list .card-body {
        width: calc(50%);
    }
    .gallery-img img {
        border-radius: 5px;
        min-height: 50vh;
        max-width: 100%;
    }
    span.highlight {
        background: yellow;
    }
    .row-items {
        position: relative;
    }
    .container {
        position: relative;
        top: 12rem;
    }
</style>

<div class="container">
    <div class="row align-items-center justify-content-center text-center">
        <div class="col-lg-8 align-self-end mb-4 page-title">
            <h3><?php echo htmlspecialchars($title); ?></h3>
            <hr class="divider my-4" />
            <div class="row col-md-12 mb-2 justify-content-center">
                <span class="badge badge-primary px-3 pt-1 pb-1">
                    <b><i>Topic Created by: <?php echo htmlspecialchars($name); ?></i></b>
                </span>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <?php echo html_entity_decode($description); ?>
            <hr class="divider">
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-lg-12">
                <div class="row">
                    <h3><b><i class="fa fa-comments"></i> <?php echo $comments->num_rows; ?> Comments</b></h3>
                </div>
                <hr class="divider" style="max-width: 100%;">
                <?php while ($row = $comments->fetch_assoc()): ?>
                    <div class="form-group comment">
                        <?php if ($_SESSION['login_id'] == $row['user_id']): ?>
                            <div class="dropdown float-right">
                                <a class="text-dark" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <span class="fa fa-ellipsis-v"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item edit_comment" data-id="<?php echo $row['id']; ?>"
                                       href="javascript:void(0)">Edit</a>
                                    <a class="dropdown-item delete_comment" data-id="<?php echo $row['id']; ?>"
                                       href="javascript:void(0)">Delete</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <p class="mb-0">
                            <large><b><?php echo htmlspecialchars($row['name']); ?></b></large>
                        </p>
                        <small class="mb-0"><i><?php echo htmlspecialchars($row['username']); ?></i></small>
                        <br>
                        <?php echo html_entity_decode($row['comment']); ?>
                        <hr>
                    </div>
                <?php endwhile; ?>
            </div>
            <hr class="divider" style="max-width: 100%;">
            <div class="col-lg-12">
                <form action="" id="manage-comment">
                    <div class="form-group">
                        <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                        <textarea class="form-control jqte" name="comment" cols="30" rows="5" placeholder="New Comment"></textarea>
                    </div>
                    <button class="btn btn-primary">Save Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.jqte').jqte();

    $('#manage-comment').submit(function (e) {
        e.preventDefault();
        start_load(); // Assuming this function is defined elsewhere
        $.ajax({
            url: 'admin/ajax.php?action=save_comment',
            method: 'POST',
            data: $(this).serialize(),
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully saved.", 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            }
        });
    });

    $('.edit_comment').click(function () {
        uni_modal("Edit Comment", "manage_comment.php?id=" + $(this).attr('data-id'), 'mid-large');
    });

    $('.delete_comment').click(function () {
        _conf("Are you sure to delete this comment?", "delete_comment", [$(this).attr('data-id')], 'mid-large');
    });

    function delete_comment(id) {
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=delete_comment',
            method: 'POST',
            data: { id: id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
