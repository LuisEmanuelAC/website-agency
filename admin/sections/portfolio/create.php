<?php 
include("../../bd.php");

//insertar lo de la tabla a la BD
if ($_POST) {
    $title=(isset($_POST['title']))?$_POST['title']:"";
    $subtitle=(isset($_POST['subtitle']))?$_POST['subtitle']:"";
    $image=(isset($_FILES['image']['name']))?$_FILES['image']['name']:"";
    $descrip=(isset($_POST['descrip']))?$_POST['descrip']:"";
    $client=(isset($_POST['client']))?$_POST['client']:"";
    $category=(isset($_POST['category']))?$_POST['category']:"";
    $url=(isset($_POST['url']))?$_POST['url']:"";

    $image_date=new Datetime();
    $n_rand = rand(1, 100);
    $name_file_image=($image!="")?$image_date->getTimestamp().$n_rand."_".$image:"";
    
    $tmp_image=$_FILES["image"]["tmp_name"];
    if ($tmp_image!="") {
        move_uploaded_file($tmp_image,"../../../assets/img/portfolio/".$name_file_image);
        print_r('se creo la imagen');
    }

    $sql=$conn->prepare("INSERT INTO `tbl_portfolio` (`id`, `title`, `subtitle`, `image`, `description`, `client`, `category`, `url`) 
    VALUES (NULL, :title, :subtitle, :image, :descrip, :client, :category, :url)");

    $sql->bindParam(":title",$title);
    $sql->bindParam(":subtitle",$subtitle);
    $sql->bindParam(":image",$name_file_image);
    $sql->bindParam(":descrip",$descrip);
    $sql->bindParam(":client",$client);
    $sql->bindParam(":category",$category);
    $sql->bindParam(":url",$url);
    $sql->execute();

    $message="successfully added";
    header("Location:index.php?message=".$message);
}

include("../../templates/header.php"); ?>

<h1>Create portfolio</h1>

<div class="card">
    <div class="card-header">portfolio product</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                    placeholder="title" />
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" class="form-control" name="subtitle" id="subtitle" aria-describedby="helpId"
                    placeholder="subtitle" />
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="image"
                    aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3">
                <label for="descrip" class="form-label">Description</label>
                <input type="text" class="form-control" name="descrip" id="descrip" aria-describedby="helpId"
                    placeholder="description" />
            </div>

            <div class="mb-3">
                <label for="client" class="form-label">Client</label>
                <input type="text" class="form-control" name="customer" id="client" aria-describedby="helpId"
                    placeholder="client" />
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" name="category" id="category" aria-describedby="helpId"
                    placeholder="category" />
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" name="url" id="url" aria-describedby="helpId"
                    placeholder="url" />
            </div>

            <button type="submit" class="btn btn-success">Add</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>