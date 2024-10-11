<?php
session_start();
include 'db_connect.php'; // Make sure this file includes your DB connection logic

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action']; // Get the action type (edit, delete, save)
    $comment_id = $_POST['comment_id']; // Get the comment ID
    
    switch ($action) {
        case 'edit':
            $new_comment = $_POST['comment']; // The new comment text

            // Update the comment if the logged-in user is the owner
            $stmt = $conn->prepare("UPDATE forum_comments SET comment = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param('sii', $new_comment, $comment_id, $_SESSION['login_id']);
            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'error';
            }
            break;

        case 'delete':
            // Delete the comment if the logged-in user is the owner
            $stmt = $conn->prepare("DELETE FROM forum_comments WHERE id = ? AND user_id = ?");
            $stmt->bind_param('ii', $comment_id, $_SESSION['login_id']);
            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'error';
            }
            break;

        default:
            echo 'invalid action';
    }
}
?>
