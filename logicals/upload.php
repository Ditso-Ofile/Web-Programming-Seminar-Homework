<?php
$upload_msg = "";
$upload_success = false;

if (!isset($_SESSION['login'])) {
    $upload_msg = "Error: Authentication required.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_submit'])) {
    $target_dir = "./images/";
    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
    if ($check === false) {
        $upload_msg = "Error: File is not a valid image.";
    } elseif (file_exists($target_file)) {
        $upload_msg = "Error: File already exists.";
    } elseif ($_FILES["fileToUpload"]["size"] > 5000000) {
        $upload_msg = "Error: File exceeds 5MB limit.";
    } elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $upload_msg = "Error: Permitted formats are JPG, JPEG, PNG, GIF.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $upload_success = true;
            $upload_msg = "Upload successful: " . htmlspecialchars($file_name);
            $uploaded_image_path = $target_file;
        } else {
            $upload_msg = "System Error: Failed to write file to directory.";
        }
    }
}
?>