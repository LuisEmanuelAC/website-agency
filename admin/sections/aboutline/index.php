<?php
include("../../bd.php");

//Borrar
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sql=$conn->prepare("SELECT image FROM `tbl_aboutline` WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis_image=$sql->fetch(PDO::FETCH_LAZY);

    if (isset($regis_image["image"]) && !is_dir("../../../assets/img/about/".$regis_image["image"])) {
        if (file_exists("../../../assets/img/about/".$regis_image["image"])) {
            unlink("../../../assets/img/about/".$regis_image["image"]);
        }
    }
    
    $sql=$conn->prepare("DELETE FROM tbl_aboutline WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();

}

//Lista del acerca de la agencia
$sql=$conn->prepare("SELECT * FROM `tbl_aboutline`");
$sql->execute();
$list_aboutline=$sql->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); ?>

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
                        <th scope="col">Date</th>
                        <th scope="col">Tile</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list_aboutline as $regis){ ?>
                    <tr class="">
                        <td scope="col"><?php echo $regis['id']; ?></td>
                        <td scope="col">
                            <?php $datas = explode(",", $regis['date']);
                            echo $datas[0];?>
                            <br>
                            <?php
                            if (isset($datas[1])) { echo $datas[1]; } ?>
                        </td>
                        <td scope="col"><?php echo $regis['title']; ?></td>
                        <td scope="col"><?php echo $regis['description']; ?></td>
                        <td scope="col">
                            <img width="100" src="../../../assets/img/about/<?php echo $regis['image']; ?>" />
                        </td>
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