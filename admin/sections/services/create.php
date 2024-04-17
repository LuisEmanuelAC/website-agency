<?php 
include("../../bd.php");

//insertar lo de la tabla a la BD
if ($_POST) {
    $icon=(isset($_POST['icon']))?$_POST['icon']:"";
    $title=(isset($_POST['title']))?$_POST['title']:"";
    $descrip=(isset($_POST['descrip']))?$_POST['descrip']:"";

    $sql=$conn->prepare("INSERT INTO `tbl_services` (`id`, `icon`, `title`, `description`) VALUES (NULL, :icon, :title, :descrip);");

    $sql->bindParam(":icon",$icon);
    $sql->bindParam(":title",$title);
    $sql->bindParam(":descrip",$descrip);

    $sql->execute();
}

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">Header</div>
    crear servicios
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <input type="text" class="form-control" name="icon" id="icon" aria-describedby="helpId"
                    placeholder="icon" />
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                    placeholder="title" />
            </div>

            <div class="mb-3">
                <label for="descrip" class="form-label">Description</label>
                <input type="text" class="form-control" name="descrip" id="descrip" aria-describedby="helpId"
                    placeholder="description" />
            </div>
            <button type="submit" class="btn btn-success">Add</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>