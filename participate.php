<?php
session_start();
include 'admin/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];

    // Check if the user has already committed to this event
    $check = $conn->query("SELECT * FROM event_commits WHERE event_id = '$event_id' AND user_id = '$user_id'");
    
    if ($check->num_rows > 0) {
        echo "You have already participated in this event.";
        exit();
    }

    // Insert data into event_commits table
    $stmt = $conn->prepare("INSERT INTO event_commits (event_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $event_id, $user_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Failed to participate. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>
