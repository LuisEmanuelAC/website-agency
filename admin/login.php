<?php
session_start();
//buscar ususrio en la tabla a la BD
if ($_POST) { 
    include("./bd.php");

    $username=(isset($_POST['username']))?$_POST['username']:"";
    $password=(isset($_POST['password']))?md5($_POST['password']):"";
 

    $sql=$conn->prepare("SELECT *, count(*) as n_user FROM `tbl_users` WHERE username=:username AND password=:password");
    
    $sql->bindParam(":username",$username, PDO::PARAM_STR); 
    $sql->bindParam(":password",$password, PDO::PARAM_STR);
    $sql->execute();

    $list_users=$sql->fetch(PDO::FETCH_LAZY);
    
   if ($list_users['n_user']>0) {
        print_r("si exixte");

        $_SESSION['user']=$list_users['username'];
        $_SESSION['loggedin']=true;
        header("Location:index.php");
    }else {
        $message_userDExist="User or password does not exist";
    }    
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4">
                    <br><br>
                    <?php if (isset($message_userDExist)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Error: </strong><?php echo $message_userDExist; ?>
                    </div>
                    <?php } ?>

                    <script>
                    var alertList = document.querySelectorAll(".alert");
                    alertList.forEach(function(alert) {
                        new bootstrap.Alert(alert);
                    });
                    </script>

                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">

                            <form action="" method="post">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="username" id="floatingInput"
                                        placeholder="username">
                                    <label for="floatingInput">Username</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" id="floatingPassword"
                                        placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <br>
                                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign
                                    in</button>

                            </form>

                        </div>
                        <div class="card-footer text-muted"></div>
                    </div>

                </div>

            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>