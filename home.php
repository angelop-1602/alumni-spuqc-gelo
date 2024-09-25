<?php include 'admin/db_connect.php'; ?>
<style>
    body {
        background-color: #f4f4f4;
        font-family: "Poppins", sans-serif;
    }
    .container {
        max-width: 800px; /* Center the content */
        margin: auto;
        padding: 20px;
    }
    .feed-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 20px;
    }
    .filter-buttons {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    .filter-buttons button {
        margin: 0 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .filter-buttons button:hover {
        background-color: #0056b3;
    }
    .feed-card {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s;
        display: flex;
        flex-direction: column; /* Allow for column layout */
    }
    .feed-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }
    .feed-card h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #333;
    }
    .feed-card h5 {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 10px;
    }
    .date-text {
        font-size: 0.9rem;
        color: #aaa;
        margin-bottom: 10px;
    }
    .truncate {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #555;
        margin-bottom: 15px; /* Add margin below the text */
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        align-self: flex-end; /* Align button to the bottom right */
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="container">
    <div class="feed-title">Latest Updates</div>

    <!-- Filter Buttons -->
    <div class="filter-buttons">
        <button class="filter-btn" data-filter="all">All</button>
        <button class="filter-btn" data-filter="events">Events</button>
        <button class="filter-btn" data-filter="articles">Articles</button>
        <button class="filter-btn" data-filter="careers">Jobs</button>
    </div>

    <!-- Feed Content -->
    <div class="feed-content">
        <!-- Events Section -->
        <div class="events">
            <?php
            $event = $conn->query("SELECT * FROM events WHERE date_format(schedule, '%Y-%m-%d') >= '" . date('Y-m-d') . "' ORDER BY unix_timestamp(schedule) ASC");
            while ($row = $event->fetch_assoc()):
                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                $desc = strtr(html_entity_decode($row['content']), $trans);
                $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
            ?>
            <div class="feed-card event-card">
                <?php if (!empty($row['banner'])): ?>
                <img src="admin/assets/uploads/<?php echo $row['banner'] ?>" alt="Event Banner" class="img-fluid" style="border-radius: 10px; margin-bottom: 15px;">
                <?php endif; ?>
                <h3><?php echo ucwords($row['title']); ?></h3>
                <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                <div class="timestamp"><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A", strtotime($row['schedule'])); ?></div>
                <p class="truncate"><?php echo strip_tags($desc); ?></p>
                <button class="btn-primary read_more" data-id="<?php echo $row['id']; ?>">Read More</button>
            </div>
            <?php endwhile; ?>
        </div>

        <!-- Articles Section -->
        <div class="articles">
            <?php
            $article = $conn->query("SELECT * FROM article ORDER BY id DESC");
            while ($row = $article->fetch_assoc()):
                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                $desc = strtr(html_entity_decode($row['content']), $trans);
                $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
            ?>
            <div class="feed-card article-card">
                <h3><?php echo ucwords($row['title']); ?></h3>
                <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                <p class="truncate"><?php echo strip_tags($desc); ?></p>
                <button class="btn-primary read_more_article" data-id="<?php echo $row['id']; ?>">Read More</button>
            </div>
            <?php endwhile; ?>
        </div>

        <!-- Careers Section -->
        <div class="careers">
            <?php
            $career = $conn->query("SELECT * FROM career ORDER BY id DESC");
            while ($row = $career->fetch_assoc()):
                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                $desc = strtr(html_entity_decode($row['description']), $trans);
                $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
            ?>
            <div class="feed-card career-card">
                <h3><?php echo ucwords($row['job_title']); ?></h3>
                <h5><?php echo ucwords($row['company']); ?></h5>
                <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                <p class="truncate"><?php echo strip_tags($desc); ?></p>
                <button class="btn-primary read_more_jobs" data-id="<?php echo $row['id']; ?>">Read More</button>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<script>
    // Filter Functionality
    document.querySelectorAll('.filter-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var filter = this.getAttribute('data-filter');
            console.log("Filtering: " + filter); // Debugging line

            document.querySelectorAll('.feed-card').forEach(function(card) {
                if (filter === 'all') {
                    card.style.display = 'block'; // Show all
                } else {
                    // Hide all cards not matching the filter
                    card.style.display = card.classList.contains(filter + '-card') ? 'block' : 'none';
                }
            });
        });
    });

    // Read More Functionality
    document.querySelectorAll('.read_more').forEach(function(button) {
        button.addEventListener('click', function() {
            location.href = "index.php?page=view_event&id=" + this.getAttribute('data-id');
        });
    });
    
    document.querySelectorAll('.read_more_article').forEach(function(button) {
        button.addEventListener('click', function() {
            location.href = "index.php?page=view_article&id=" + this.getAttribute('data-id');
        });
    });

    document.querySelectorAll('.read_more_jobs').forEach(function(button) {
        button.addEventListener('click', function() {
            location.href = "index.php?page=view_jobs&id=" + this.getAttribute('data-id');
        });
    });
</script>
