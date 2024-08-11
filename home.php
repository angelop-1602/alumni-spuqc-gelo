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
    .events-card{
        width: 40rem;
        position: relative;
        left: 17rem;
        top: 12rem;
    }
    @media only screen and (max-width: 768px) {

    }

    @media only screen and (max-width: 768px) {
        .events-card {
            width: 100%; /* Adjust width for smaller screens */
            left: 0; /* Reset left position */
            top: 10rem; /* Reset top position */
        }
    }
    @media only screen and (max-width: 425px) {
        .events-card {
            top: 7rem;
        }
    }
</style>
<?php
$event = $conn->query("SELECT * FROM events where date_format(schedule,'%Y-%m%-d') >= '" . date('Y-m-d') . "' order by unix_timestamp(schedule) asc");
while ($row = $event->fetch_assoc()):
    $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
    $desc = strtr(html_entity_decode($row['content']), $trans);
    $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
    ?>
    <div class="container">
    <div class="events-card">
    <div class="card" data-id="<?php echo $row['id'] ?>">
        <div class='card-img-top'>
            <?php if (!empty($row['banner'])): ?>
                <img src="admin/assets/uploads/<?php echo ($row['banner']) ?>" alt="">
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
                    <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read
                        More</button>

        </div>
    </div>
    </div>
    </div>
    <br>
<?php endwhile; ?>




<script>
    $('.read_more').click(function () {
        location.href = "index.php?page=view_event&id=" + $(this).attr('data-id')
    })
    $('.banner img').click(function () {
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keyup(function (e) {
        var filter = $(this).val()

        $('.card.event-list .filter-txt').each(function () {
            var txto = $(this).html();
            txt = txto
            if ((txt.toLowerCase()).includes((filter.toLowerCase())) == true) {
                $(this).closest('.card').toggle(true)
            } else {
                $(this).closest('.card').toggle(false)

            }
        })
    })
</script>