<?php
$action = $_GET['action'] ?? '';
$error = '';

try {
    
    $dbh = new PDO('mysql:host=localhost;dbname=databaselesson', 'root', '', 
                   array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');

    
    $stmt_cat = $dbh->query("SELECT cname FROM categories");
    $categories = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

    
    if ($action === 'delete' && isset($_GET['id'])) {
        
        $stmt = $dbh->prepare("DELETE FROM pizzas WHERE pname = :id");
        $stmt->execute([':id' => $_GET['id']]);
        header("Location: ?table"); 
        exit;
        
    } elseif ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $pname = trim($_POST['pname'] ?? '');
        $cat = trim($_POST['categoryname'] ?? '');
        $veg = isset($_POST['vegetarian']) ? 1 : 0;
        
        if (empty($pname)) {
            $error = "Pizza name is required.";
        } else {
            $stmt = $dbh->prepare("INSERT INTO pizzas (pname, categoryname, vegetarian) VALUES (:pname, :cat, :veg)");
            $stmt->execute([':pname' => $pname, ':cat' => $cat, ':veg' => $veg]);
            header("Location: ?table");
            exit;
        }
        
    } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = $_GET['id'] ?? '';
        $cat = trim($_POST['categoryname'] ?? '');
        $veg = isset($_POST['vegetarian']) ? 1 : 0;
        
        $stmt = $dbh->prepare("UPDATE pizzas SET categoryname = :cat, vegetarian = :veg WHERE pname = :id");
        $stmt->execute([':cat' => $cat, ':veg' => $veg, ':id' => $id]);
        header("Location: ?table");
        exit;
    }

    
    $current_pizza = null;
    if ($action === 'edit' && isset($_GET['id'])) {
        
        $stmt = $dbh->prepare("SELECT * FROM pizzas WHERE pname = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $current_pizza = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    $stmt_pizzas = $dbh->query("SELECT * FROM pizzas ORDER BY pname ASC");
    $pizzas = $stmt_pizzas->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    
    $error = "Database Error: " . $e->getMessage();
}
?>