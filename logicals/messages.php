<?php
$messages = [];
$error_msg = null;

if (isset($_SESSION['login'])) {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=databaselesson', 'root', '',
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');

        $stmt = $dbh->query("SELECT sender_name, sender_email, message_text, sent_at FROM messages ORDER BY sent_at DESC");
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        $error_msg = "Error fetching messages: " . $e->getMessage();
    }
} else {
    $error_msg = "You must be logged in to view messages.";
}
?>