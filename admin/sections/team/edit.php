<?php 
include("../../bd.php");

//exportar de la BD a la tabla
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sql=$conn->prepare("SELECT * FROM tbl_team WHERE id=:id");
    $sql->bindParam(":id",$txtID);
    $sql->execute();
    $regis=$sql->fetch(PDO::FETCH_LAZY);

    $fullname=$regis['fullname'];  
    $image=$regis['image'];
    $job=$regis['job'];
    $networks=$regis['networks'];
    $list_networks=array();

    if ($networks) {
        $list_networks=explode(",", $networks);
    }

}
//actualizar el portafolio
if ($_POST) {
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $fullname=(isset($_POST['fullname']))?$_POST['fullname']:"";
    $image=(isset($_FILES['image']['name']))?$_FILES['image']['name']:"";
    $job=(isset($_POST['job']))?$_POST['job']:"";
    $list_networks=(isset($_POST['networks']))?$_POST['networks']:"";

    $networks="";
    foreach ($list_networks as $index => $network) {
        if ($index == 0) {
            $networks=$network;
        }
        if (count($list_networks) > 1 && $index >= 1) {
            $networks=$networks.",".$network;
        }
    }

    $sql=$conn->prepare("UPDATE tbl_team SET fullname=:fullname, job=:job, 
    networks=:networks WHERE id=:id");

    $sql->bindParam(":id",$txtID);
    $sql->bindParam(":fullname",$fullname, PDO::PARAM_STR);
    $sql->bindParam(":job",$job, PDO::PARAM_STR);
    $sql->bindParam(":networks",$networks, PDO::PARAM_STR);
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


    $message="successfully modified";
    header("Location:index.php?message=".$message);
}

include("../../templates/header.php"); ?>

<h1>Member edit</h1>

<div class="card">
    <div class="card-header">team member</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input readonly value="<?php echo $txtID;?>" type="text" class="form-control" name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="fullname" class="form-label">fullname</label>
                <input value="<?php echo $fullname;?>" type="text" class="form-control" name="fullname" id="fullname"
                    aria-describedby="helpId" placeholder="fullname" />
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <img width="100" src="../../../assets/img/team/<?php echo $image; ?>" />
                <input type="file" class="form-control" name="image" id="image" placeholder="image"
                    aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3">
                <label for="job" class="form-label">job</label>
                <input value="<?php echo $job;?>" type="text" class="form-control" name="job" id="job"
                    aria-describedby="helpId" placeholder="job" />
            </div>

            <div class="mb-3" id="networksContainer">
                <label for="networks" class="form-label">Networks</label>
                <?php foreach($list_networks as $index => $network){ ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="networks[]" placeholder="networks"
                        value="<?php echo $network; ?>" />
                    <?php if($index >= 1){ ?>
                    <button type="button" class="btn btn-warning" onclick="removeNetworkField(this)"> - </button>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>

            <div class="mb-3">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button type="button" class="btn btn-success" onclick="addNetworkField()"> + </button>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Add</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancel</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>


<script>
// Función para añadir un nuevo campo de texto para networks
function addNetworkField() {
    var container = document.getElementById('networksContainer');
    var inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-3');

    inputGroup.innerHTML = `
        <input type="text" class="form-control" name="networks[]" placeholder="networks" />    
        <button type="button" class="btn btn-warning" onclick="removeNetworkField(this)"> - </button>
    `;

    container.appendChild(inputGroup);
}

// Función para eliminar el campo de texto actual
function removeNetworkField(button) {
    var inputGroup = button.closest('.input-group');
    if (inputGroup) {
        inputGroup.remove();
    }
}
</script>