<?php 
include("../../bd.php");

//Borrar
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sql=$conn->prepare("SELECT image FROM `tbl_portfolio` WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis_image=$sql->fetch(PDO::FETCH_LAZY);


    if (isset($regis_image["image"]) && !is_dir("../../../assets/img/portfolio/".$regis_image["image"])) {
        if (file_exists("../../../assets/img/portfolio/".$regis_image["image"])) {
            unlink("../../../assets/img/portfolio/".$regis_image["image"]);
        }
    }
    
    $sql=$conn->prepare("DELETE FROM tbl_portfolio WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();

}

//Lista del portafolio
$sql=$conn->prepare("SELECT * FROM `tbl_portfolio`");
$sql->execute();
$list_portfolio=$sql->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); ?>

<h1>Portfolio list</h1>

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
                        <th scope="col">title</th>
                        <th scope="col">subtitle</th>
                        <th scope="col">image</th>
                        <th scope="col">description</th>
                        <th scope="col">client</th>
                        <th scope="col">category</th>
                        <th scope="col">url</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list_portfolio as $regis){ ?>
                    <tr class="">
                        <td scope="col"><?php echo $regis['id']; ?></td>
                        <td scope="col"><?php echo $regis['title']; ?></td>
                        <td scope="col"><?php echo $regis['subtitle']; ?></td>
                        <td scope="col">
                            <img width="100" src="../../../assets/img/portfolio/<?php echo $regis['image']; ?>" />
                        </td>
                        <td scope="col"><?php echo $regis['description']; ?></td>
                        <td scope="col"><?php echo $regis['client']; ?></td>
                        <td scope="col"><?php echo $regis['category']; ?></td>
                        <td scope="col"><?php echo $regis['url']; ?></td>
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