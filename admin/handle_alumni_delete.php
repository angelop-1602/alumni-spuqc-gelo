<?php
include 'db_connect.php';
include 'admin_class.php';  // Make sure this points to the file containing your Action class

$action = new Action($conn);

if(isset($_POST['action']) && $_POST['action'] == 'delete_alumni') {
    if(isset($_POST['id'])) {
        $result = $action->delete_alumni();
        if($result == 1) {
            echo json_encode(['status' => 'success', 'message' => 'Alumni deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete alumni']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No ID provided']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
}
?>