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
<script>
function confirDelate(params) {
    Swal.fire({
        title: "Are you sure?",
        text: "the content will be removed from the entire table!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {

        if (result.isConfirmed) {
            window.location.href = "index.php?txtID=" + params;
            Swal.fire({
                title: "Deleted!",
                text: "content has been deleted.",
                icon: "success"
            });
        }
    });
}
</script>

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
                            <a name="" id="" class="btn btn-danger" role="button"
                                onclick="confirDelate(<?php echo $regis['id']; ?>)">delate</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





<?php include("../../templates/footer.php"); ?>