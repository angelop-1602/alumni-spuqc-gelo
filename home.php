<?php
include 'admin/db_connect.php';
?>
<style>
    body {
        background-color: #f8f9fa;
    }
    .feed-card {
        margin-bottom: 2rem;
        border: none;
    }
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        background-color: white;
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card img {
        height: auto;
        width: 100%;
        object-fit: cover;
    }
    .card-body {
        padding: 15px;
    }
    .card-body h3 {
        font-size: 1.25rem;
        color: #333;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .card-body p {
        font-size: 0.9rem;
        color: #666;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .truncate {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .feed-title {
        padding: 1rem 0;
        font-size: 1.75rem;
        font-weight: bold;
        text-align: center;
        color: #343a40;
    }
</style>

<div class="container mt-5">
    <!-- Feed Title -->
    <div class="feed-title">Latest Updates</div>

    <!-- Events Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <?php
            $event = $conn->query("SELECT * FROM events WHERE date_format(schedule, '%Y-%m-%d') >= '" . date('Y-m-d') . "' ORDER BY unix_timestamp(schedule) ASC");
            while ($row = $event->fetch_assoc()):
                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                $desc = strtr(html_entity_decode($row['content']), $trans);
                $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
            ?>
            <div class="feed-card">
                <div class="card" data-id="<?php echo $row['id'] ?>">
                    <?php if (!empty($row['banner'])): ?>
                    <img src="admin/assets/uploads/<?php echo $row['banner'] ?>" alt="Event Banner" class="img-fluid">
                    <?php endif; ?>
                    <div class="card-body">
                        <h3 class="filter-txt"><?php echo ucwords($row['title']) ?></h3>
                        <p><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A", strtotime($row['schedule'])) ?></p>
                        <p class="truncate"><?php echo strip_tags($desc) ?></p>
                        <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Articles Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <?php
            $article = $conn->query("SELECT * from article order by id desc");
            while ($row = $article->fetch_assoc()):
                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                $desc = strtr(html_entity_decode($row['content']), $trans);
                $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
            ?>
            <div class="feed-card">
                <div class="card" data-id="<?php echo $row['id'] ?>">
                    <div class="card-body">
                        <h3 class="filter-txt"><?php echo ucwords($row['title']) ?></h3>
                        <p class="truncate"><?php echo strip_tags($desc) ?></p>
                        <button class="btn btn-primary float-right read_more_article" data-id="<?php echo $row['id'] ?>">Read More</button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Careers Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <?php
            $article = $conn->query("SELECT * from career order by id desc");
            while ($row = $article->fetch_assoc()):
                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                $desc = strtr(html_entity_decode($row['description']), $trans);
                $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
            ?>
            <div class="feed-card">
                <div class="card" data-id="<?php echo $row['id'] ?>">
                    <div class="card-body">
                        <h3 class="filter-txt"><?php echo ucwords($row['job_title']) ?></h3>
                        <h5 class="text-muted"><?php echo ucwords($row['company']) ?></h5>
                        <p class="truncate"><?php echo strip_tags($desc) ?></p>
                        <button class="btn btn-primary float-right read_more_article" data-id="<?php echo $row['id'] ?>">Read More</button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<script>
    // Events - Read More
    $('.read_more').click(function() {
        location.href = "index.php?page=view_event&id=" + $(this).attr('data-id');
    });

    // Articles - Read More
    $('.read_more_article').click(function() {
        location.href = "index.php?page=view_article&id=" + $(this).attr('data-id');
    });

    $('#filter').keyup(function(e) {
        var filter = $(this).val().toLowerCase();

        $('.card .filter-txt').each(function() {
            var txt = $(this).html().toLowerCase();
            if (txt.includes(filter)) {
                $(this).closest('.card').fadeIn(); // Smooth transition for showing cards
            } else {
                $(this).closest('.card').fadeOut(); // Smooth transition for hiding cards
            }
        });
    });
</script>
