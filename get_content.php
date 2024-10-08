<?php
include 'admin/db_connect.php';

$type = $_GET['type'];
$id = $_GET['id'];

switch ($type) {
    case 'event':
        $query = $conn->query("SELECT * FROM events WHERE id = $id");
        $row = $query->fetch_assoc();
        echo "<h2>{$row['title']}</h2>";
        echo "<p>{$row['content']}</p>";
        break;
    case 'article':
        $query = $conn->query("SELECT * FROM article WHERE id = $id");
        $row = $query->fetch_assoc();
        echo "<h2>{$row['title']}</h2>";
        echo "<p>{$row['content']}</p>";
        break;
    case 'job':
        $query = $conn->query("SELECT * FROM career WHERE id = $id");
        $row = $query->fetch_assoc();
        echo "<h2>{$row['job_title']}</h2>";
        echo "<h3>{$row['company']}</h3>";
        echo "<p>{$row['description']}</p>";
        break;
    default:
        echo "Invalid content type";
}
?>