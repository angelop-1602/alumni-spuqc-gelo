<?php
session_start();
include 'admin/db_connect.php'; // Make sure to include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['topic_id']) && isset($_POST['comment'])) {
    // Extracting variables
    $topic_id = intval($_POST['topic_id']);
    $comment = htmlentities(str_replace("'", "&#x2019;", $_POST['comment'])); // Clean the comment
    $user_id = $_SESSION['login_id']; // Assuming the user's login ID is stored in session

    // Insert the comment into the database
    $stmt = $conn->prepare("INSERT INTO forum_comments (topic_id, comment, user_id, date_created) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("ssi", $topic_id, $comment, $user_id);

    if ($stmt->execute()) {
        echo 1; // Success
    } else {
        echo 0; // Failure
    }

    $stmt->close();
}
?>
