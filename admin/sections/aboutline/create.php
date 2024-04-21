<?php 
include("../../bd.php");

//insertar lo de la tabla a la BD
if ($_POST) {
    $title=(isset($_POST['title']))?$_POST['title']:"";
    $date=(isset($_POST['date-start']))?($_POST['date-end'] != "")?
    $_POST['date-start'].",".$_POST['date-end']:$_POST['date-start']:"";
    $descrip=(isset($_POST['descrip']))?$_POST['descrip']:"";
    $image=(isset($_FILES['image']['name']))?$_FILES['image']['name']:"";    

    $image_date=new Datetime();
    $n_rand = rand(1, 100);    
    $name_file_image=($image!="")?$image_date->getTimestamp().$n_rand."_".$image:"";
    
    $tmp_image=$_FILES["image"]["tmp_name"];
    if ($tmp_image!="") {
        move_uploaded_file($tmp_image,"../../../assets/img/about/".$name_file_image);
    }

    $sql=$conn->prepare("INSERT INTO `tbl_aboutline` (`id`, `title`, `date`, `description`, `image`) 
    VALUES (NULL, :title, :date, :descrip, :image);");

    $sql->bindParam(":title",$title, PDO::PARAM_STR);
    $sql->bindParam(":date",$date);
    $sql->bindParam(":descrip",$descrip, PDO::PARAM_STR);
    $sql->bindParam(":image",$name_file_image);
    $sql->execute();
}

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">portfolio product</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                    placeholder="title" required />
            </div>

            <div class="mb-12" style="display: flex; justify-content: space-around; max-width: 800px; margin: auto;">
                <div>
                    <label for="date-start" class="form-label">Date (start)</label>
                    <input type="date" class="form-control" name="date-start" aria-describedby="helpId"
                        placeholder="date" style="width: 300px;" required />
                </div>
                <div>
                    <label for="date-end" class="form-label">Date (end)</label>
                    <input type="date" class="form-control" name="date-end" aria-describedby="helpId" placeholder="date"
                        style="width: 300px;" />
                </div>
            </div>

            <div class="mb-3">
                <label for="descrip" class="form-label">Description</label>
                <input type="text" class="form-control" name="descrip" id="descrip" aria-describedby="helpId"
                    placeholder="description" required />
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="image"
                    aria-describedby="fileHelpId" />
            </div>

            <button type="submit" class="btn btn-success">Add</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>