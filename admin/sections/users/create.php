<?php
include("../../bd.php");

//insertar lo de la tabla a la BD
if ($_POST) {
    $username=(isset($_POST['username']))?$_POST['username']:"";
    $email=(isset($_POST['email']))?$_POST['email']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";   

    $sql=$conn->prepare("INSERT INTO `tbl_users` (`id`, `username`, `email`, `password`) 
    VALUES (NULL, :username, :email, :password)");

    $sql->bindParam(":username",$username, PDO::PARAM_STR);
    $sql->bindParam(":email",$email, PDO::PARAM_STR);
    $sql->bindParam(":password",$password, PDO::PARAM_STR);
    $sql->execute();
}

include("../../templates/header.php"); ?>

<h1>Create user</h1>

<div class="card">
    <div class="card-header">user</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId"
                    placeholder="username" />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId"
                    placeholder="email" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <div class="mb-3 d-flex align-items-center">
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" />
                    <button type="button" class="btn btn-warning ms-2" id="togglePassword">Mostrar/Ocultar</button>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Add</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>

        </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>

<script>
// JavaScript code snippet
document.addEventListener('DOMContentLoaded', function() {
    var passwordInput = document.getElementById('password');
    var toggleButton = document.getElementById('togglePassword');
    toggleButton.textContent = 'Mostrar';
    toggleButton.onclick = function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = 'Ocultar';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = 'Mostrar';
        }
    };
});
</script>