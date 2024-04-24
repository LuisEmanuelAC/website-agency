<?php
include("../../bd.php");
//exportar de la BD a la tabla
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sql=$conn->prepare("SELECT * FROM tbl_users WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis=$sql->fetch(PDO::FETCH_LAZY);

    $username=$regis['username'];
    $email=$regis['email'];
    $password=$regis['password'];

}
//actualizar el servicio
if ($_POST) {
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $username=(isset($_POST['username']))?$_POST['username']:"";
    $email=(isset($_POST['email']))?$_POST['email']:"";
    $password=(isset($_POST['password']))?md5($_POST['password']):"";    

    $sql=$conn->prepare("UPDATE tbl_users SET username=:username, email=:email, password=:password WHERE id=:id");

    $sql->bindParam(":id",$txtID);
    $sql->bindParam(":username",$username, PDO::PARAM_STR);
    $sql->bindParam(":email",$email, PDO::PARAM_STR);
    $sql->bindParam(":password",$password, PDO::PARAM_STR);
    $sql->execute();
    
    $message="successfully modified";
    header("Location:index.php?message=".$message);
}

include("../../templates/header.php"); ?>

<h1>User edit</h1>

<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input readonly value="<?php echo $txtID;?>" type="text" class="form-control" name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input value="<?php echo $username;?>" type="text" class="form-control" name="username" id="username"
                    aria-describedby="helpId" placeholder="username" />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input value="<?php echo $email;?>" type="text" class="form-control" name="email" id="email"
                    aria-describedby="helpId" placeholder="email" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <div class="mb-3 d-flex align-items-center">
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" />
                    <button type="button" class="btn btn-warning ms-2" id="togglePassword">Mostrar/Ocultar</button>
                </div>
            </div>

            <button type="submit" class="btn btn-success">update</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
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