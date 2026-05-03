<?php

if (!isset($_SESSION['login'])) {
    header("Location: ?login");
    exit;
}

try {
    
    $dbh = new PDO('mysql:host=localhost;dbname=databaselesson', 'root', '',
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');

    
    $sql = "SELECT sender_name, email, message, created_at FROM messages ORDER BY created_at DESC";
    $sth = $dbh->query($sql);
    $messages_data = $sth->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $db_error = "Database Error: " . $e->getMessage();
}
?>