<?php 
session_start();
$url_base="http://localhost/website-agency/admin/"; 
if (!isset($_SESSION['user'])) {
    header("Location:".$url_base."login.php");    
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Manager web site</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="#" aria-current="page">Manager <span
                        class="visually-hidden">(current)</span></a>
                <a class="nav-item nav-link" href=" <?php echo $url_base;?>sections/services/index.php">Services</a>
                <a class="nav-item nav-link" href=" <?php echo $url_base;?>sections/portfolio/index.php">Portfolio</a>
                <a class="nav-item nav-link" href=" <?php echo $url_base;?>sections/aboutline/index.php">about</a>
                <a class="nav-item nav-link" href=" <?php echo $url_base;?>sections/team/index.php">Team</a>
                <a class="nav-item nav-link" href=" <?php echo $url_base;?>sections/config/index.php">Config</a>
                <a class="nav-item nav-link" href=" <?php echo $url_base;?>sections/users/index.php">Users</a>
                <a class="nav-item nav-link" href=" <?php echo $url_base;?>close.php">sing out</a>
            </div>
        </nav>

    </header>
    <main class="container">
        <br />