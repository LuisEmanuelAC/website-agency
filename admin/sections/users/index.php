<?php 
include("../../bd.php");

//Borrar
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";  
    
    $sql=$conn->prepare("DELETE FROM tbl_users WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();

}

//Lista del equipo
$sql=$conn->prepare("SELECT * FROM `tbl_users`");
$sql->execute();
$list_users=$sql->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); ?>

<h1>User list</h1>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="create.php" role="button">new</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_users as $regis) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $regis['id']; ?></td>
                        <td scope="row"><?php echo $regis['username']; ?></td>
                        <td scope="row"><?php echo $regis['email']; ?></td>
                        <td scope="row"><?php echo $regis['password']; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="edit.php?txtID=<?php echo $regis['id']; ?>"
                                role="button">edit</a>
                            |
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $regis['id']; ?>"
                                role="button">delate</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





<?php include("../../templates/footer.php"); ?>