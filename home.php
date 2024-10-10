<?php include 'admin/db_connect.php'; ?>
<style>
    body {
        background-color: #e9eff1;
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 100; /* Center the content */
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
        height: 300px;
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
    
    .btn-secondary {
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
        background-color: #268e2a;
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
    
    .comment {
    display: flex; /* Use flexbox for layout */
    justify-content: space-between; /* Space between items */
    align-items: center; /* Center align items vertically */
    background-color: #f9f9f9; /* Light background for the comment */
    border-radius: 5px; /* Rounded corners */
    padding: 10px; /* Padding inside the comment */
    margin-bottom: 10px; /* Space between comments */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.comment-content {
    flex: 1; /* Allow the comment content to take available space */
    color: #333; /* Darker text color for better readability */
}

.date-text {
    color: #888; /* Light color for the date */
    font-size: 0.9em; /* Slightly smaller font for the date */
    white-space: nowrap; /* Prevent the date from wrapping */

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
        <button class="filter-btn" data-filter="event">Events</button>
        <button class="filter-btn" data-filter="article">Articles</button>
        <button class="filter-btn" data-filter="job">Jobs</button>
        <button class="filter-btn" data-filter="forum-topic">Forums</button>
    </div>
    <div class="forum-topic-form">
        <h2>Create a New Forum</h2>
        <input type="text" id="topic-title" placeholder="Topic Title" required>
        <textarea id="topic-description" placeholder="Enter your description..." rows="4" required></textarea>
        <button id="submit-topic" class="btn-primary">Post Forum</button>
    </div>

    <!-- Feed Content -->
    <div class="feed-content">
    <!-- Events Section -->
    <div class="events">
        <?php
        $user_id = $_SESSION['login_id']; // Get the logged-in user ID
        
        $event = $conn->query("SELECT e.*, ec.id as commit_id 
                               FROM events e
                               LEFT JOIN event_commits ec 
                               ON e.id = ec.event_id 
                               AND ec.user_id = '$user_id'
                               WHERE date_format(e.schedule, '%Y-%m-%d') >= '" . date('Y-m-d') . "' 
                               ORDER BY unix_timestamp(e.schedule) ASC");
        
        while ($row = $event->fetch_assoc()):
            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
            $desc = strtr(html_entity_decode($row['content']), $trans);
            $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);

            // Check if the user has participated in this event
            $has_participated = !empty($row['commit_id']);  // True if commit_id exists
        ?>
        <div class="feed-card event-card">
            <div class="user-info">
                <img src="assets/img/logo-qc.png" alt="User Avatar"> <!-- Placeholder for user avatar -->
                <div>
                    <strong>Admin</strong>  <!-- Assume there's a user_name field -->
                    <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                </div>
            </div>
            <?php if (!empty($row['banner'])): ?>
            <img src="admin/assets/uploads/<?php echo $row['banner'] ?>" alt="Event Banner" class="img-fluid">
            <?php endif; ?>
            <h3><?php echo ucwords($row['title']); ?></h3>
            <div class="timestamp"><i class="fa fa-calendar"></i> <strong>Scheduled on:</strong> <?php echo date("F d, Y h:i A", strtotime($row['schedule'])); ?></div>
            <p class="truncate"><strong>Description:</strong> <?php echo strip_tags($desc); ?></p>

            <!-- Button container to hold both buttons side by side -->
    <div class="button-container">
        <!-- Check if the user has already participated -->
        <?php if ($has_participated): ?>
            <button class="btn-secondary" disabled>Participated</button> <!-- Disabled button -->
        <?php else: ?>
            <button class="btn-primary participate" data-id="<?php echo $row['id']; ?>">Participate</button> <!-- Active button -->
        <?php endif; ?>

        <!-- Read More Button -->
        <!-- <button class="btn-primary read_more" data-id="<?php echo $row['id']; ?>">Read More</button> -->
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

            // Fetch image blob and encode it as base64
            $image_data = base64_encode($row['img']); 
            $img_src = 'data:image/jpeg;base64,' . $image_data;
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

            <!-- Display article image -->
            <?php if (!empty($row['img'])): ?>
            <div class="article-image">
                <img src="<?php echo $img_src; ?>" alt="<?php echo $row['title']; ?>" class="article-thumbnail">
            </div>
            <?php endif; ?>

            <p class="truncate"><strong>Description:</strong> <?php echo strip_tags($desc); ?></p>
            <!-- <button class="btn-primary read_more" data-id="<?php echo $row['id']; ?>">Read More</button> -->
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
                    <strong></strong> <?php echo ucwords($row['name']); ?>
                    <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                </div>
            </div>
            <h3><?php echo ucwords($row['job_title']); ?></h3>
            <h5><strong>Company:</strong> <?php echo ucwords($row['company']); ?></h5>
            <div class="date-text"><strong>Location:</strong> <?php echo ucwords($row['location']); ?></div>
            <p class="truncate"><strong>Description:</strong> <?php echo strip_tags($desc); ?></p>
            <!-- <button class="btn-primary read_more" data-id="<?php echo $row['id']; ?>">Read More</button> -->

        </div>
        <?php endwhile; ?>
    </div>

    <!-- Forum Topics Section -->
    <div class="forum-topics">
        <?php
        $forumTopics = $conn->query("SELECT ft.*, u.name, u.img FROM forum_topics ft JOIN users u ON ft.user_id = u.id ORDER BY ft.date_created DESC");
        while ($row = $forumTopics->fetch_assoc()):
            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
            $desc = strtr(html_entity_decode($row['description']), $trans);
            $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
        ?>
        <div class="feed-card forum-topic-card">
            <div class="user-info">
                <?php if (!empty($row['img'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
                <?php else: ?>
                    <img src="assets/img/default_avatar.jpg" alt="Default Avatar" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
                <?php endif; ?>
                <div>
                    <strong></strong> <?php echo ucwords($row['name']); ?>
                    <div class="date-text">Posted on: <?php echo date("F d, Y", strtotime($row['date_created'])); ?></div>
                </div>
            </div>
            <h3><?php echo ucwords($row['title']); ?></h3>
            <p class="truncate"><strong>Description:</strong> <?php echo strip_tags($desc); ?></p>
            <strong>Comments</strong>
            <div class="comment-section">
                <input type="text" placeholder="Write a comment..." id="comment-input-<?php echo $row['id']; ?>"/>
                <button onclick="addComment(<?php echo $row['id']; ?>)">Post</button>
            </div>
            
            <!-- Display Comments -->
            <div class="comments-container" id="comments-container-<?php echo $row['id']; ?>">
                <?php
                // Fetch comments for the current topic
                $comments = $conn->query("SELECT fc.*, u.name FROM forum_comments fc JOIN users u ON fc.user_id = u.id WHERE fc.topic_id = ".$row['id']." ORDER BY fc.date_created DESC");
                while ($comment = $comments->fetch_assoc()):
                ?>
                    <div class="comment">
                        <div class="comment-content">
                            <strong><?php echo ucwords($comment['name']); ?></strong>: <?php echo htmlspecialchars($comment['comment']); ?>
                        </div>
                        <div class="date-text"><?php echo date("F d, Y", strtotime($comment['date_created'])); ?></div>
                    </div>
                <?php endwhile; ?>
            </div>

        </div>
        <?php endwhile; ?>
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
    
    $(document).ready(function() {
        $('.participate').on('click', function() {
            var eventId = $(this).data('id');
            var userId = <?php echo $_SESSION['login_id']; ?>;  // Assuming user is logged in and user_id is in session

            // Send data to server via AJAX
            $.ajax({
                url: 'participate.php',
                method: 'POST',
                data: {
                    event_id: eventId,
                    user_id: userId
                },
                success: function(response) {
                    if (response == 'success') {
                        alert('You have successfully participated in the event!');
                        // Update the button to show "Participated" and disable it
                        $('.participate[data-id="' + eventId + '"]').text('Participated').prop('disabled', true).removeClass('btn-success').addClass('btn-secondary');
                    } else {
                        alert('Error: ' + response);
                    }
                },
                error: function() {
                    alert('There was an error processing your request.');
                }
            });
        });       
    });

    function addComment(topicId) {
    const commentInput = document.getElementById(`comment-input-${topicId}`);
    const comment = commentInput.value.trim(); // Get the comment text

    if (comment) {
        fetch('add_comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `topic_id=${topicId}&comment=${encodeURIComponent(comment)}`,
        })
        .then(response => response.text())
        .then(data => {
            if (data == 1) {
                alert('Comment posted successfully!');
                commentInput.value = ''; // Clear the input field
                // Optionally, reload comments or update the UI to show the new comment
            } else {
                alert('Failed to post comment. Please try again.');
                console.log(data);
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert('Please enter a comment before posting.');
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
