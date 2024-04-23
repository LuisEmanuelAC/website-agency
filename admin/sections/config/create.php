<?php
include("../../bd.php");

//insertar lo de la tabla a la BD
if ($_POST) {
    $name=(isset($_POST['name']))?$_POST['name']:"";
    $value=(isset($_POST['value']))?$_POST['value']:"";

    $sql=$conn->prepare("INSERT INTO `tbl_config` (`id`, `name`, `value`) 
    VALUES (NULL, :name, :value )");

    $sql->bindParam(":name",$name, PDO::PARAM_STR);
    $sql->bindParam(":value",$value, PDO::PARAM_STR);
    $sql->execute();
}

include("../../templates/header.php"); ?>

<h1>Create configuration</h1>

<div class="card">
    <div class="card-header">confinguration</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                    placeholder="name" />
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Value</label>
                <input type="text" class="form-control" name="value" id="value" aria-describedby="helpId"
                    placeholder="value" />
            </div>

            <button type="submit" class="btn btn-success">Add</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>

        </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>