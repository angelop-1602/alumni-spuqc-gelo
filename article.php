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

    .gallery-list {
        cursor: pointer;
        border: unset;
        flex-direction: inherit;
    }

    .container-fluid {
        z-index: -1;
    }

    .gallery-img,
    .gallery-list .card-body {
        width: calc(50%)
    }

    .gallery-img img {
        border-radius: 5px;
        min-height: 50vh;
        max-width: calc(100%);
    }

    span.hightlight {
        background: yellow;
    }

    .carousel,
    .carousel-inner,
    .carousel-item {
        min-height: calc(100%)
    }

    .container {
        position: relative;
        top: 8rem;
    }
</style>
<div class="container">
    <div class="container-fluid">
        <div class="row lign-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class=" ">Article List</h3>
            </div>

        </div>
    </div>

    <?php
    $event = $conn->query("SELECT * from article order by id desc");
    while ($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['content']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
        ?>
        <div class="card job-list" data-id="<?php echo $row['id'] ?>">
            <div class="card-body">
                <div class="row  align-items-center justify-content-center text-center h-100">
                    <div class="">
                        <h3><b class="filter-txt"><?php echo ucwords($row['title']) ?></b></h3>
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
</div>

<script>
    $('.read_more').click(function () {
        uni_modal("Career Opportunity", "view_article.php?id=" + $(this).attr('data-id'), 'mid-large')
    })
    $('.gallery-img img').click(function () {
        viewer_modal($(this).attr('src'))
    })

    $('#filter').keypress(function (e) {
        if (e.which == 13)
            $('#search').trigger('click')
    })
    $('#search').click(function () {
        var txt = $('#filter').val()
        start_load()
        if (txt == '') {
            $('.job-list').show()
            end_load()
            return false;
        }
        $('.job-list').each(function () {
            var content = "";
            $(this).find(".filter-txt").each(function () {
                content += ' ' + $(this).text()
            })
            if ((content.toLowerCase()).includes(txt.toLowerCase()) == true) {
                $(this).toggle(true)
            } else {
                $(this).toggle(false)
            }
        })
        end_load()
    })

</script>