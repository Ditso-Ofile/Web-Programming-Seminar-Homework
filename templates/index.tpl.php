<?php session_start(); ?>
<?php if(file_exists('./logicals/'.$find['file'].'.php')) { include("./logicals/{$find['file']}.php"); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pagetitle['title'] . ( (isset($pagetitle['motto'])) ? (' | ' . $pagetitle['motto']) : '' ) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css" type="text/css">
    <?php if(file_exists('./styles/'.$find['file'].'.css')) { ?><link rel="stylesheet" href="./styles/<?= $find['file']?>.css" type="text/css"><?php } ?>
</head>
<body>
    <div class="container my-4">
        
        <header class="d-flex align-items-center justify-content-between flex-wrap custom-header mb-3">
            <div class="d-flex align-items-center mx-auto mx-md-0 mb-3 mb-md-0">
                <img src="./images/<?=$header['imagesource']?>" alt="<?=$header['imagealt']?>" class="me-4 logo-img">
                <div class="text-center text-md-start">
                    <h1><?= $header['title'] ?></h1>
                    <?php if (isset($header['motto'])) { ?><h2><?= $header['motto'] ?></h2><?php } ?>
                </div>
            </div>
            <?php if(isset($_SESSION['login'])) { ?>
                <div class="user-info mx-auto mx-md-0">
                    Logged in: <strong><?= $_SESSION['fn']." ".$_SESSION['ln']." (".$_SESSION['login'].")" ?></strong>
                </div>
            <?php } ?>
        </header>

        <nav class="navbar navbar-expand-lg custom-nav mb-4" id="mainNav">
            <div class="container-fluid">
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php foreach ($pages as $url => $page) { ?>
                            <?php if(! isset($_SESSION['login']) && $page['menun'][0] || isset($_SESSION['login']) && $page['menun'][1]) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= (($page == $find) ? 'active' : '') ?>" href="<?= ($url == '/') ? '.' : $url ?>">
                                        <?= $page['text'] ?>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main id="content" class="p-4 mb-4 custom-main">
            <?php include("./templates/pages/{$find['file']}.tpl.php"); ?>
        </main>

        <footer class="p-3 text-center custom-footer">
            <?php if(isset($footer['copyright'])) { ?>© <?= $footer['copyright'] ?> <?php } ?>
            &nbsp;
            <?php if(isset($footer['firm'])) { ?><strong><?= $footer['firm']; ?></strong><?php } ?>
        </footer>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>