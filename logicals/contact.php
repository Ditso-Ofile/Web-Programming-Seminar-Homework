<?php
$errors = [];
$sent_successfully = false;


$default_name = isset($_SESSION['login']) ? $_SESSION['fn'] . ' ' . $_SESSION['ln'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    
    if ($name === '') {
        $errors[] = "Name field cannot be empty.";
    } elseif (strlen($name) < 5) {
        $errors[] = "Name must be at least 5 characters long.";
    }

    if ($email === '') {
        $errors[] = "Email field cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please provide a valid email address.";
    }

    if ($message === '') {
        $errors[] = "Message field cannot be empty.";
    }

    
    if (empty($errors)) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=databaselesson', 'root', '', 
                           array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');

            
            $db_sender_name = isset($_SESSION['login']) ? $name : 'Guest';

            $sql = "INSERT INTO messages (sender_name, email, message) VALUES (:name, :email, :message)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':name' => $db_sender_name,
                ':email' => $email,
                ':message' => $message
            ]);

            $sent_successfully = true;

        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>