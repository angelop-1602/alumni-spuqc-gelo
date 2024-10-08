<?php
include 'admin/db_connect.php';

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Function to fetch events
function fetchEvents($conn) {
    $output = '';
    $event = $conn->query("SELECT * FROM events WHERE date_format(schedule, '%Y-%m-%d') >= '" . date('Y-m-d') . "' ORDER BY unix_timestamp(schedule) ASC");
    while ($row = $event->fetch_assoc()) {
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['content']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
        $output .= '<div class="feed-card event-card">
            <img src="admin/assets/uploads/' . $row['banner'] . '" alt="Event Banner" class="img-fluid" style="border-radius: 10px; margin-bottom: 15px;">
            <h3>' . ucwords($row['title']) . '</h3>
            <div class="date-text">Posted on: ' . date("F d, Y", strtotime($row['date_created'])) . '</div>
            <div class="timestamp"><i class="fa fa-calendar"></i> ' . date("F d, Y h:i A", strtotime($row['schedule'])) . '</div>
            <p class="truncate">' . strip_tags($desc) . '</p>
            <button class="btn-primary read_more" data-id="' . $row['id'] . '">Read More</button>
        </div>';
    }
    return $output;
}

// Function to fetch articles
function fetchArticles($conn) {
    $output = '';
    $article = $conn->query("SELECT * FROM article ORDER BY id DESC");
    while ($row = $article->fetch_assoc()) {
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['content']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
        $output .= '<div class="feed-card article-card">
            <h3>' . ucwords($row['title']) . '</h3>
            <div class="date-text">Posted on: ' . date("F d, Y", strtotime($row['date_created'])) . '</div>
            <p class="truncate">' . strip_tags($desc) . '</p>
            <button class="btn-primary read_more_article" data-id="' . $row['id'] . '">Read More</button>
        </div>';
    }
    return $output;
}

// Function to fetch careers
function fetchCareers($conn) {
    $output = '';
    $career = $conn->query("SELECT * FROM career ORDER BY id DESC");
    while ($row = $career->fetch_assoc()) {
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
        $output .= '<div class="feed-card career-card">
            <h3>' . ucwords($row['job_title']) . '</h3>
            <h5>' . ucwords($row['company']) . '</h5>
            <div class="date-text">Posted on: ' . date("F d, Y", strtotime($row['date_created'])) . '</div>
            <p class="truncate">' . strip_tags($desc) . '</p>
            <button class="btn-primary read_more_jobs" data-id="' . $row['id'] . '">Read More</button>
        </div>';
    }
    return $output;
}

// Serve filtered content based on the selected filter
switch ($filter) {
    case 'events':
        echo fetchEvents($conn);
        break;
    case 'articles':
        echo fetchArticles($conn);
        break;
    case 'careers':
        echo fetchCareers($conn);
        break;
    default:
        // If no filter is selected, return all content
        echo fetchEvents($conn) . fetchArticles($conn) . fetchCareers($conn);
}
?>
