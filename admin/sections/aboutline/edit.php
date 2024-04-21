<?php 

include("../../bd.php");
//exportar de la BD a la tabla
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sql=$conn->prepare("SELECT * FROM tbl_aboutline WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis=$sql->fetch(PDO::FETCH_LAZY);

    $title=$regis['title'];
    $dates=explode(",", $regis['date']);   
    $descrip=$regis['description'];
    $image=$regis['image'];

}
//actualizar el portafolio
if ($_POST) {
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $title=(isset($_POST['title']))?$_POST['title']:"";
    $date=(isset($_POST['date-start']))?($_POST['date-end'] != "")?
    $_POST['date-start'].",".$_POST['date-end']:$_POST['date-start']:"";
    $descrip=(isset($_POST['descrip']))?$_POST['descrip']:"";

    $sql=$conn->prepare("UPDATE tbl_aboutline SET title=:title, date=:date, 
    description=:descrip WHERE id=:id");

    $sql->bindParam(":id",$txtID);
    $sql->bindParam(":title",$title, PDO::PARAM_STR);
    $sql->bindParam(":date",$date);
    $sql->bindParam(":descrip",$descrip, PDO::PARAM_STR);
    $sql->execute();

    if ($_FILES["image"]["tmp_name"]!="") {
        $db_image=$image;
        $image=(isset($_FILES['image']['name']))?$_FILES['image']['name']:"";

        $image_date=new Datetime();
        $n_rand = rand(1, 100);
        $name_file_image=($image!="")?$image_date->getTimestamp().$n_rand."_".$image:"";
    
        $tmp_image=$_FILES["image"]["tmp_name"];
        if ($tmp_image!="") {
            move_uploaded_file($tmp_image,"../../../assets/img/about/".$name_file_image);
        }

        if (file_exists("../../../assets/img/about/".$db_image)) {
            unlink("../../../assets/img/about/".$db_image);
        }

        $sql=$conn->prepare("UPDATE tbl_aboutline SET image=:image WHERE id=:id");
        $sql->bindParam(":id",$txtID);
        $sql->bindParam(":image",$name_file_image, PDO::PARAM_STR);
        $sql->execute();
    }


    $message="Registration successfully modified";
    header("Location:index.php?message=".$message);
}

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">About edit</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input readonly value="<?php echo $txtID;?>" type="text" class="form-control" name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input value="<?php echo $title;?>" type="text" class="form-control" name="title" id="title"
                    aria-describedby="helpId" placeholder="title" required />
            </div>

            <div class="mb-12" style="display: flex; justify-content: space-around; max-width: 800px; margin: auto;">
                <div>
                    <label for="date-start" class="form-label">Date (start)</label>
                    <input value="<?php echo $dates[0];?>" type="date" class="form-control" name="date-start"
                        aria-describedby="helpId" placeholder="date" style="width: 300px;" required />
                </div>
                <div>
                    <label for="date-end" class="form-label">Date (end)</label>
                    <input value="<?php echo $dates[1];?>" type="date" class="form-control" name="date-end"
                        aria-describedby="helpId" placeholder="date" style="width: 300px;" />
                </div>
            </div>

            <div class="mb-3">
                <label for="descrip" class="form-label">Description</label>
                <input value="<?php echo $descrip;?>" type="text" class="form-control" name="descrip" id="descrip"
                    aria-describedby="helpId" placeholder="description" required />
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <img width="100" src="../../../assets/img/about/<?php echo $image; ?>" />
                <input type="file" class="form-control" name="image" id="image" placeholder="image"
                    aria-describedby="fileHelpId" />
            </div>

            <button type="submit" class="btn btn-success">update</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>