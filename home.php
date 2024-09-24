<?php
include 'admin/db_connect.php';
?>
<style>
    #portfolio .img-fluid {
        width: calc(100%);
        height: 30vh;
        z-index: -1;
        position: relative;
        padding: 1em;
    }
    .events-card, .article-card {
        width: 40rem;
        position: relative;
        left: 17rem;
        top: 12rem;
        transition: transform 0.3s ease-in-out;
    }
    .events-card:hover, .article-card:hover {
        transform: scale(1.02); /* Slight scale effect on hover */
    }
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a slight shadow to card */
        transition: box-shadow 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Enhance shadow on hover */
    }
    .card-body h3 {
        font-size: 1.5rem;
        color: #333;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    @media only screen and (max-width: 768px) {
        .events-card, .article-card {
            width: 100%; /* Adjust width for smaller screens */
            left: 0; /* Reset left position */
            top: 10rem; /* Reset top position */
        }
    }
    @media only screen and (max-width: 425px) {
        .events-card, .article-card {
            top: 7rem;
        }
    }
</style>

<div class="container">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="">Upcoming Events</h3>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <?php
    $event = $conn->query("SELECT * FROM events WHERE date_format(schedule, '%Y-%m-%d') >= '" . date('Y-m-d') . "' ORDER BY unix_timestamp(schedule) ASC");
    while ($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['content']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
    ?>
        <div class="events-card">
            <div class="card" data-id="<?php echo $row['id'] ?>">
                <div class='card-img-top'>
                    <?php if (!empty($row['banner'])): ?>
                        <img src="admin/assets/uploads/<?php echo $row['banner'] ?>" alt="Event Banner" class="img-fluid">
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <h3><b class="filter-txt"><?php echo ucwords($row['title']) ?></b></h3>
                    <div><small>
                        <p><b><i class="fa fa-calendar"></i> 
                        <?php echo date("F d, Y h:i A", strtotime($row['schedule'])) ?></b></p>
                    </small></div>
                    <hr>
                    <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                    <br>
                    <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                </div>
            </div>
        </div>
        <br>
    <?php endwhile; ?>
</div>

<div class="container">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="">Article List</h3>
            </div>
        </div>
    </div>

    <!-- Articles Section -->
    <?php
    $article = $conn->query("SELECT * from article order by id desc");
    while ($row = $article->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['content']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
    ?>
        <div class="article-card">
            <div class="card job-list" data-id="<?php echo $row['id'] ?>">
                <div class="card-body">
                    <h3><b class="filter-txt"><?php echo ucwords($row['title']) ?></b></h3>
                    <hr>
                    <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                    <br>
                    <button class="btn btn-primary float-right read_more_article" data-id="<?php echo $row['id'] ?>">Read More</button>
                </div>
            </div>
        </div>
        <br>
    <?php endwhile; ?>
</div>
<?php
    $article = $conn->query("SELECT * from career order by id desc");
    while ($row = $article->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
    ?>
        <div class="article-card">
            <div class="card job-list" data-id="<?php echo $row['id'] ?>">
                <div class="card-body">
                    <h3><b class="filter-txt"><?php echo ucwords($row['job_title']) ?></b></h3>
                    <h3><b class="filter-txt"><?php echo ucwords($row['company']) ?></b></h3>
                    <hr>
                    <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                    <br>
                    <button class="btn btn-primary float-right read_more_article" data-id="<?php echo $row['id'] ?>">Read More</button>
                </div>
            </div>
        </div>
        <br>
    <?php endwhile; ?>
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

        $('.card.event-list .filter-txt, .card.job-list .filter-txt').each(function() {
            var txt = $(this).html().toLowerCase();
            if (txt.includes(filter)) {
                $(this).closest('.card').fadeIn(); // Smooth transition for showing cards
            } else {
                $(this).closest('.card').fadeOut(); // Smooth transition for hiding cards
            }
        });
    });
</script>
