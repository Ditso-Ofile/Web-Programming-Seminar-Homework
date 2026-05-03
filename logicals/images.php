<?php
$target_dir = "./uploads/";
$upload_messages = [];


if (!file_exists($target_dir)) {
    @mkdir($target_dir, 0777, true);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_submit'])) {
    
    
    if (!isset($_SESSION['login'])) {
        $upload_messages[] = "Security Error: You must be logged in to upload images.";
    } else {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 500 * 1024;

        if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
            $file = $_FILES['new_image'];
            
            if (!in_array($file['type'], $allowed_types)) {
                $upload_messages[] = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
            } elseif ($file['size'] > $max_size) {
                $upload_messages[] = "File is too large. Maximum size is 500KB.";
            } else {
                
                $filename = time() . "_" . basename($file['name']);
                $target_file = $target_dir . $filename;
                
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    $upload_messages[] = "Image uploaded successfully!";
                } else {
                    $upload_messages[] = "Error saving the uploaded image.";
                }
            }
        } else {
            $upload_messages[] = "Please select a valid image to upload.";
        }
    }
}


$gallery_images = [];
if (file_exists($target_dir)) {
    $files = scandir($target_dir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $gallery_images[] = $target_dir . $file;
            }
        }
    }
}

rsort($gallery_images);
?>