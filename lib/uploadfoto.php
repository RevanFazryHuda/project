<?php
header('Content-Type: application/json');
include("../controllers/Parfum.php");
include("../lib/functions.php");
$obj = new ParfumController();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$response = array();
$upload_dir = '../images/'; // Make sure this directory exists and is writable
$thumb_dir = '../images/thumbs/';

// Check if directory exists, if not create it
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}
if (!file_exists($thumb_dir)) {
    mkdir($thumb_dir, 0777, true);
}
if ($_FILES['foto']) {
    $file = $_FILES['foto'];
    
    // Validate file type
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($file['type'], $allowed_types)) {
        $response['success'] = false;
        $response['message'] = 'Invalid file type. Only JPG, PNG and GIF allowed.';
        echo json_encode($response);
        exit;
    }
    
    // Generate unique filename
    $filename = uniqid() . '_' . basename($file['name']);
    $target_path = $upload_dir . $filename;
    $thumb_path = $thumb_dir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        createThumbnail($target_path, $thumb_path);
        $response['success'] = true;
        $response['message'] = 'Image uploaded successfully';
        $response['file_path'] = $target_path;
        $obj->updatefoto($id, $filename);
    } else {
        $response['success'] = false;
        $response['message'] = 'Error uploading file';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No file uploaded';
}

echo json_encode($response);
?>