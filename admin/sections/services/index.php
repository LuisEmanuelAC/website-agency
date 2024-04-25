<?php 
include("../../bd.php");

//Borrar
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sql=$conn->prepare("DELETE FROM tbl_services WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
}

//Lista de servicios
$sql=$conn->prepare("SELECT * FROM `tbl_services`");
$sql->execute();
$list_services=$sql->fetchAll(PDO::FETCH_ASSOC);

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

<h1>Services list</h1>

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
                        <th scope="col">Icon</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list_services as $regis){ ?>
                    <tr class="">
                        <td><?php echo $regis['id']; ?></td>
                        <td><?php echo $regis['icon']; ?></td>
                        <td><?php echo $regis['title']; ?></td>
                        <td><?php echo $regis['description']; ?></td>
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