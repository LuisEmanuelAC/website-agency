<?php
include("../../bd.php");
//exportar de la BD a la tabla
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sql=$conn->prepare("SELECT * FROM tbl_config WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis=$sql->fetch(PDO::FETCH_LAZY);

    $name=$regis['name'];
    $value=$regis['value'];

}
//actualizar el servicio
if ($_POST) {
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $name=(isset($_POST['name']))?$_POST['name']:"";
    $value=(isset($_POST['value']))?$_POST['value']:""; 

    $sql=$conn->prepare("UPDATE tbl_config SET name=:name, value=:value WHERE id=:id");

    $sql->bindParam(":id",$txtID);
    $sql->bindParam(":name",$name, PDO::PARAM_STR);
    $sql->bindParam(":value",$value, PDO::PARAM_STR);
    $sql->execute();
    
    $message="Registration successfully modified";
    header("Location:index.php?message=".$message);
}

include("../../templates/header.php"); ?>

<h1>Edit configuration</h1>

<div class="card">
    <div class="card-header">configuration</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input readonly value="<?php echo $txtID;?>" type="text" class="form-control" name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="<?php echo $name;?>" type="text" class="form-control" name="name" id="name"
                    aria-describedby="helpId" placeholder="name" />
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Value</label>
                <input value="<?php echo $value;?>" type="text" class="form-control" name="value" id="value"
                    aria-describedby="helpId" placeholder="value" />
            </div>

            <button type="submit" class="btn btn-success">update</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>