<?php include 'admin/db_connect.php'; ?>
<style>
    body {
        background-color: #e9eff1;
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
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
        margin-bottom: 30px;
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
        border-radius: 20px;
        background-color: #268e2a;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .filter-buttons button:hover {
        background-color: #1e6f22;
        transform: scale(1.05);
    }

    .feed-card {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s;
        display: flex;
        flex-direction: column;
    }
    
    .feed-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .feed-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
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
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #268e2a;
        border: none;
        color: white;
        padding: 10px 15px;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
        align-self: flex-end;
    }

    .btn-primary:hover {
        background-color: #1e6f22;
        transform: scale(1.05);
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 90%;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* New styles for user info */
    .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .user-info img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .comment-section {
        margin-top: 10px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }

    .comment-section input {
        width: calc(100% - 100px);
        padding: 8px;
        margin-right: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .comment-section button {
        padding: 8px 10px;
        border: none;
        border-radius: 5px;
        background-color: #268e2a;
        color: white;
        cursor: pointer;
    }

    .comment-section button:hover {
        background-color: #1e6f22;
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
        .feed-title {
            font-size: 2rem;
        }

        .feed-card h3 {
            font-size: 1.3rem;
        }

        .feed-card h5 {
            font-size: 1rem;
        }
    }
    .forum-topic-form {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.forum-topic-form input, .forum-topic-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.forum-topic-form button {
    width: 100%;
}
</style>

<div class="container">
    <div class="feed-title">Latest Updates</div>
    
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="filter-buttons">
        <button class="filter-btn" data-filter="all">All</button>
        <button class="filter-btn" data-filter="events">Events</button>
        <button class="filter-btn" data-filter="articles">Articles</button>
        <button class="filter-btn" data-filter="careers">Jobs</button>
    </div>
    <div class="forum-topic-form">
        <h2>Create a New Topic</h2>
        <input type="text" id="topic-title" placeholder="Topic Title" required>
        <textarea id="topic-description" placeholder="Enter your description..." rows="4" required></textarea>
        <button id="submit-topic" class="btn-primary">Post Topic</button>
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
                <div class="user-info">
                    <img src="assets/img/logo-qc.png" alt="User Avatar"> <!-- Placeholder for user avatar -->
                    <div>
                        <strong>Admin</strong> <!-- Assume there's a user_name field -->
                        <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                    </div>
                </div>
                <?php if (!empty($row['banner'])): ?>
                <img src="admin/assets/uploads/<?php echo $row['banner'] ?>" alt="Event Banner" class="img-fluid">
                <?php endif; ?>
                <h3><?php echo ucwords($row['title']); ?></h3>
                <div class="timestamp"><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A", strtotime($row['schedule'])); ?></div>
                <p class="truncate"><?php echo strip_tags($desc); ?></p>
                <button class="btn-primary read_more" data-id="<?php echo $row['id']; ?>">Read More</button>

                <div class="comment-section">
                    <input type="text" placeholder="Write a comment..." id="comment-input-<?php echo $row['id']; ?>">
                    <button onclick="addComment(<?php echo $row['id']; ?>)">Post</button>
                </div>
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
                <div class="user-info">
                    <img src="assets/img/logo-qc.png" alt="User Avatar">
                    <div>
                        <strong>Admin</strong>
                        <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                    </div>
                </div>
                <h3><?php echo ucwords($row['title']); ?></h3>
                <p class="truncate"><?php echo strip_tags($desc); ?></p>
                <button class="btn-primary read_more" data-id="<?php echo $row['id']; ?>">Read More</button>

                <div class="comment-section">
                    <input type="text" placeholder="Write a comment..." id="comment-input-<?php echo $row['id']; ?>">
                    <button onclick="addComment(<?php echo $row['id']; ?>)">Post</button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <!-- Jobs Section -->
        <div class="jobs">
    <?php
    $jobs = $conn->query("SELECT c.*, u.name, u.img FROM career c JOIN users u ON c.user_id = u.id ORDER BY c.id DESC"); // Added avatar field
    while ($row = $jobs->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);

        // Convert the binary data to a Base64 encoded string
        $avatar = !empty($row['img']) ? 'data:image/jpeg;base64,' . base64_encode($row['img']) : 'assets/img/default_avatar.jpg'; // Fallback to a default image
    ?>
    <div class="feed-card job-card">
        <div class="user-info">
            <img src="<?php echo $avatar; ?>" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;"> <!-- Display avatar -->
            <div>
                <strong><?php echo ucwords($row['name']); ?></strong>
                <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
            </div>
        </div>
        <h3><?php echo ucwords($row['job_title']); ?></h3>
        <h5><?php echo ucwords($row['company']); ?></h5>
        <div class="date-text">Location: <?php echo ucwords($row['location']); ?></div>
        <p class="truncate"><?php echo strip_tags($desc); ?></p>
        <button class="btn-primary read_more" data-id="<?php echo $row['id']; ?>">Read More</button>

        <div class="comment-section">
            <input type="text" placeholder="Write a comment..." id="comment-input-<?php echo $row['id']; ?>">
            <button onclick="addComment(<?php echo $row['id']; ?>)">Post</button>
        </div>
    </div>
    <?php endwhile; ?>
</div>
<!-- Forum Topics Section -->
<div class="forum-topics">
        <?php
        $forumTopics = $conn->query("SELECT ft.*, u.name, u.img FROM forum_topics ft JOIN users u ON ft.user_id = u.id ORDER BY ft.date_created DESC"); // Assuming you have an avatar field in users
        while ($row = $forumTopics->fetch_assoc()):
            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
            $desc = strtr(html_entity_decode($row['description']), $trans);
            $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
        ?>
        <div class="feed-card forum-topic-card">
            <div class="user-info">
                <?php if (!empty($row['img'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;"> <!-- Load user avatar from DB -->
                <?php else: ?>
                    <img src="assets/img/default_avatar.jpg" alt="Default Avatar" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;"> <!-- Placeholder for user avatar -->
                <?php endif; ?>
                <div>
                    <strong><?php echo ucwords($row['name']); ?></strong>
                    <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                </div>
            </div>
            <h3><?php echo ucwords($row['title']); ?></h3>
            <p class="truncate"><?php echo strip_tags($desc); ?></p>
            <button class="btn-primary read_more_forum" data-id="<?php echo $row['id']; ?>">Read More</button>
        </div>
        <?php endwhile; ?>
    </div>
</div>
        </div>
    </div>
</div>

<script>
    // Handle modal display
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];

    document.querySelectorAll('.read_more').forEach(button => {
        button.onclick = function () {
            const id = this.getAttribute('data-id');
            // Load content dynamically based on the ID
            fetch(`fetch_content.php?id=${id}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("modalContent").innerHTML = data;
                    modal.style.display = "block";
                });
        };
    });

    span.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    function addComment(id) {
        const commentInput = document.getElementById(`comment-input-${id}`);
        const comment = commentInput.value;

        if (comment) {
            // Send the comment to the server
            fetch('add_comment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, comment }),
            })
            .then(response => response.json())
            .then(data => {
                // Optionally handle the response (e.g., show the new comment)
                commentInput.value = ''; // Clear input field
                alert(data.message); // Show a message
            })
            .catch((error) => console.error('Error:', error));
        }
    }
    document.getElementById('submit-topic').addEventListener('click', function() {
    const title = document.getElementById('topic-title').value;
    const description = document.getElementById('topic-description').value;

    if (title && description) {
        // AJAX request to save the forum topic using existing save_forum action
        fetch('admin/ajax.php?action=save_forum', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                title: title,
                description: description
            })
        })
        .then(response => response.text())
        .then(data => {
            if (data === '1') {
                alert("Topic posted successfully!");
                location.reload(); // Reload to see the new topic
            } else {
                alert("Failed to post topic: " + data);
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert("Please fill in both fields.");
    }
});

</script>
