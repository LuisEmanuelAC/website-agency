<?php 
include("../../bd.php");

//Borrar
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sql=$conn->prepare("SELECT image FROM `tbl_team` WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis_image=$sql->fetch(PDO::FETCH_LAZY);


    if (isset($regis_image["image"]) && !is_dir("../../../assets/img/team/".$regis_image["image"])) {
        if (file_exists("../../../assets/img/team/".$regis_image["image"])) {
            unlink("../../../assets/img/team/".$regis_image["image"]);
        }
    }
    
    $sql=$conn->prepare("DELETE FROM tbl_team WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();

}

//Lista del equipo
$sql=$conn->prepare("SELECT * FROM `tbl_team`");
$sql->execute();
$list_team=$sql->fetchAll(PDO::FETCH_ASSOC);

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

<h1>Team members</h1>

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
                        <th scope="col">Name</th>
                        <th scope="col">image</th>
                        <th scope="col">job</th>
                        <th scope="col">networks</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list_team as $regis){ ?>
                    <tr class="">
                        <td scope="col"><?php echo $regis['id']; ?></td>
                        <td scope="col"><?php echo $regis['fullname']; ?></td>
                        <td scope="col">
                            <img width="100" src="../../../assets/img/team/<?php echo $regis['image']; ?>" />
                        </td>
                        <td scope="col"><?php echo $regis['job']; ?></td>
                        <td scope="col">
                            <?php $list_networks = explode(",", $regis['networks']);
                            for ($i=0; $i < count($list_networks); $i++) {
                                echo $list_networks[$i];?>
                            <br>
                            <?php } ?>
                        </td>
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