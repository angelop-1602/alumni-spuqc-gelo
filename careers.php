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
        top: 12rem;
    }


    .card-content{
        display: flex;
        flex-direction: row; 
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .card-content .job-list{
        margin-bottom: 2rem;
      min-width: 20rem;
    }
</style>
<div class="container">
    <div class="justify-content-center text-center">
        <div class="mb-4">
            <h3 class="text-center">Job List</h3>
            <div class="row col-md-12 mb-2 justify-content-center">
                <button class="btn btn-primary btn-block col-sm-4" type="button" id="new_career"><i
                        class="fa fa-plus"></i> Post a Job Opportunity</button>
            </div>
        </div>
        <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="filter" placeholder="Filter" aria-label="Filter"
                            aria-describedby="filter-field">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-sm" id="search">Search</button>
                </div>
            </div>

        </div>
    </div>
    </div>

    <div class="card-content">
        <?php
        $event = $conn->query("SELECT c.*,u.name from career c inner join users u on u.id = c.user_id order by id desc");
        while ($row = $event->fetch_assoc()):
            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
            $desc = strtr(html_entity_decode($row['description']), $trans);
            $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
            ?>
            <div class="card job-list" data-id="<?php echo $row['id'] ?>">
                <div class="card card-header">
                    <span class="badge badge-info float-left px-3 pt-1 pb-1">
                        <h3><b class="filter-txt"><?php echo ucwords($row['job_title']) ?></b></h3>
                        <b><i>Posted by: <?php echo $row['name'] ?></i></b>
                    </span>
                </div>
                <div class="card-body">
                    <div class="align-items-center justify-content-center text-center h-100">
                        <div>
                            <div class="filter-txt"><small><b><i class="fa fa-building"></i>
                                        <?php echo ucwords($row['company']) ?></b></small></div>
                            <div class="filter-txt"><small><b><i class="fa fa-map-marker"></i>
                                        <?php echo ucwords($row['location']) ?></b></small></div>
                        </div>
                        <hr>
                        <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                        <br>
                        <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read
                            More</button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>


<script>
    // $('.card.gallery-list').click(function(){
    //     location.href = "index.php?page=view_gallery&id="+$(this).attr('data-id')
    // })
    $('#new_career').click(function () {
        uni_modal("New Job Hiring", "manage_career.php", 'mid-large')
    })
    $('.read_more').click(function () {
        uni_modal("Career Opportunity", "view_jobs.php?id=" + $(this).attr('data-id'), 'mid-large')
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