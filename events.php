
<style>
    #portfolio .img-fluid {
        width: calc(100%);
        height: 30vh;
        z-index: -1;
        position: relative;
        padding: 1em;
    }
    .event-list {
        cursor: pointer;
        flex-direction: inherit;
    }

    .banner {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 26vh;
        width: calc(30%);
    }

    .banner img {
        width: calc(100%);
        height: calc(100%);
        cursor: pointer;
    }

    .event-list .banner {
        width: calc(40%)
    }

    .event-list .card-body {
        width: calc(60%)
    }

    .event-list .banner img {
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        min-height: 50vh;
    }
    .section {
        border: 2px black solid;
    }
    .container
    {
       position: relative;
       top:10rem; 
    }  
</style>
<div class="container">
    <?php
    $event = $conn->query("SELECT * FROM events where date_format(schedule,'%Y-%m%-d') >= '" . date('Y-m-d') . "' order by unix_timestamp(schedule) asc");
    if ($event): // Added error handling
        while ($row = $event->fetch_assoc()):
            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
            $desc = strtr(html_entity_decode($row['content']), $trans);
            $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
            ?>
            <div class="card event-list border border-secondary " data-id="<?php echo $row['id'] ?>">
                <div class='banner'>
                    <?php if (!empty($row['banner'])): ?>
                        <img src="admin/assets/uploads/<?php echo ($row['banner']) ?>" alt="">
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="row align-items-center justify-content-center text-center h-100">
                        <div class="">
                            <h3><b class="filter-txt"><?php echo ucwords($row['title']) ?></b></h3>
                            <div><small>
                                    <p><b><i class="fa fa-calendar"></i>
                                            <?php echo date("F d, Y h:i A", strtotime($row['schedule'])) ?></b></p>
                                </small></div>
                            <hr>
                            <span class="truncate filter-txt"><?php echo strip_tags($desc) ?></span> <!-- Changed <larger> to <span> -->
                            <br>
                            <hr class="divider" style="max-width: calc(80%)">
                            <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read
                                More</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No events found.</p> <!-- Message if no events are found -->
    <?php endif; ?>
</div>


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