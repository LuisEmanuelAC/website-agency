<?php 

include("../../bd.php");
//exportar de la BD a la tabla
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sql=$conn->prepare("SELECT * FROM tbl_services WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis=$sql->fetch(PDO::FETCH_LAZY);

    $icon=$regis['icon'];
    $title=$regis['title'];
    $descrip=$regis['description'];

}
//actualizar el servicio
if ($_POST) {
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $icon=(isset($_POST['icon']))?$_POST['icon']:"";
    $title=(isset($_POST['title']))?$_POST['title']:"";
    $descrip=(isset($_POST['descrip']))?$_POST['descrip']:"";

    $sql=$conn->prepare("UPDATE tbl_services SET icon=:icon, title=:title, description=:descrip WHERE id=:id");

    $sql->bindParam(":id",$txtID);
    $sql->bindParam(":icon",$icon);
    $sql->bindParam(":title",$title);
    $sql->bindParam(":descrip",$descrip);
    $sql->execute();
    
    $message="successfully modified";
    header("Location:index.php?message=".$message);
}

include("../../templates/header.php"); ?>

<h1>Service edit</h1>

<div class="card">
    <div class="card-header">service edit</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input readonly value="<?php echo $txtID;?>" type="text" class="form-control" name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <input value="<?php echo $icon;?>" type="text" class="form-control" name="icon" id="icon"
                    aria-describedby="helpId" placeholder="icon" />
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input value="<?php echo $title;?>" type="text" class="form-control" name="title" id="title"
                    aria-describedby="helpId" placeholder="title" />
            </div>

            <div class="mb-3">
                <label for="descrip" class="form-label">Description</label>
                <input value="<?php echo $descrip;?>" type="text" class="form-control" name="descrip" id="descrip"
                    aria-describedby="helpId" placeholder="description" />
            </div>
            <button type="submit" class="btn btn-success">update</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>