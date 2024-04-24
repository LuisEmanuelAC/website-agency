<?php 

include("../../bd.php");
//exportar de la BD a la tabla
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sql=$conn->prepare("SELECT * FROM tbl_portfolio WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis=$sql->fetch(PDO::FETCH_LAZY);

    $title=$regis['title'];
    $subtitle=$regis['subtitle'];
    $image=$regis['image'];
    $descrip=$regis['description'];
    $client=$regis['client'];
    $category=$regis['category'];
    $url=$regis['url'];


}
//actualizar el portafolio
if ($_POST) {
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $title=(isset($_POST['title']))?$_POST['title']:"";
    $subtitle=(isset($_POST['subtitle']))?$_POST['subtitle']:"";
    $descrip=(isset($_POST['descrip']))?$_POST['descrip']:"";
    $client=(isset($_POST['client']))?$_POST['client']:"";
    $category=(isset($_POST['category']))?$_POST['category']:"";
    $url=(isset($_POST['url']))?$_POST['url']:"";

    $sql=$conn->prepare("UPDATE tbl_portfolio SET title=:title, subtitle=:subtitle, 
    description=:descrip, client=:client, category=:category, url=:url WHERE id=:id");

    $sql->bindParam(":id",$txtID);
    $sql->bindParam(":title",$title);
    $sql->bindParam(":subtitle",$subtitle);
    $sql->bindParam(":descrip",$descrip);
    $sql->bindParam(":client",$client);
    $sql->bindParam(":category",$category);
    $sql->bindParam(":url",$url);
    $sql->execute();

    if ($_FILES["image"]["tmp_name"]!="") {
        $db_image=$image;
        $image=(isset($_FILES['image']['name']))?$_FILES['image']['name']:"";

        $image_date=new Datetime();
        $n_rand = rand(1, 100);
        $name_file_image=($image!="")?$image_date->getTimestamp().$n_rand."_".$image:"";
    
        $tmp_image=$_FILES["image"]["tmp_name"];
        if ($tmp_image!="") {
            move_uploaded_file($tmp_image,"../../../assets/img/portfolio/".$name_file_image);
        }

        if (file_exists("../../../assets/img/portfolio/".$db_image)) {
            unlink("../../../assets/img/portfolio/".$db_image);
        }

        $sql=$conn->prepare("UPDATE tbl_portfolio SET image=:image WHERE id=:id");
        $sql->bindParam(":id",$txtID);
        $sql->bindParam(":image",$name_file_image);
        $sql->execute();
    }


    $message="successfully modified";
    header("Location:index.php?message=".$message);
}

include("../../templates/header.php"); ?>

<h1>Portfolio edit</h1>

<div class="card">
    <div class="card-header">portfolio edit</div>
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
                    aria-describedby="helpId" placeholder="title" />
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input value="<?php echo $subtitle;?>" type="text" class="form-control" name="subtitle" id="subtitle"
                    aria-describedby="helpId" placeholder="subtitle" />
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <img width="100" src="../../../assets/img/portfolio/<?php echo $image; ?>" />
                <input type="file" class="form-control" name="image" id="image" placeholder="image"
                    aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3">
                <label for="descrip" class="form-label">Description</label>
                <input value="<?php echo $descrip;?>" type="text" class="form-control" name="descrip" id="descrip"
                    aria-describedby="helpId" placeholder="description" />
            </div>

            <div class="mb-3">
                <label for="client" class="form-label">Client</label>
                <input value="<?php echo $client;?>" type="text" class="form-control" name="client" id="client"
                    aria-describedby="helpId" placeholder="client" />
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input value="<?php echo $category;?>" type="text" class="form-control" name="category" id="category"
                    aria-describedby="helpId" placeholder="category" />
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input value="<?php echo $url;?>" type="text" class="form-control" name="url" id="url"
                    aria-describedby="helpId" placeholder="url" />
            </div>
            <button type="submit" class="btn btn-success">update</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>