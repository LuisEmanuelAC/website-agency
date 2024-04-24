<?php 
include("../../bd.php");

//insertar lo de la tabla a la BD
if ($_POST) {
    $fullname=(isset($_POST['fullname']))?$_POST['fullname']:"";
    $image=(isset($_FILES['image']['name']))?$_FILES['image']['name']:"";
    $job=(isset($_POST['job']))?$_POST['job']:"";
    $list_networks=(isset($_POST['networks']))?$_POST['networks']:"";

    $image_date=new Datetime();
    $n_rand = rand(1, 100);
    $name_file_image=($image!="")?$image_date->getTimestamp().$n_rand."_".$image:"";
    
    $tmp_image=$_FILES["image"]["tmp_name"];
    if ($tmp_image!="") {
        move_uploaded_file($tmp_image,"../../../assets/img/team/".$name_file_image);
        print_r('se creo la imagen');
    }
    $networks="";
    foreach ($list_networks as $index => $network) {
        if ($index == 0) {
            $networks=$network;
        }
        if (count($list_networks) > 1 && $index >= 1) {
            $networks=$networks.",".$network;
        }
    }

    $sql=$conn->prepare("INSERT INTO `tbl_team` (`id`, `fullname`, `image`, `job`, `networks`) 
    VALUES (NULL, :fullname, :image, :job, :networks)");

    $sql->bindParam(":fullname",$fullname, PDO::PARAM_STR);
    $sql->bindParam(":image",$name_file_image);
    $sql->bindParam(":job",$job, PDO::PARAM_STR);
    $sql->bindParam(":networks",$networks, PDO::PARAM_STR);
    $sql->execute();

    $message="successfully added";
    header("Location:index.php?message=".$message);
}

include("../../templates/header.php"); ?>

<h1>Create member</h1>

<div class="card">
    <div class="card-header">team member</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="fullname" class="form-label">fullname</label>
                <input type="text" class="form-control" name="fullname" id="fullname" aria-describedby="helpId"
                    placeholder="fullname" />
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="image"
                    aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3">
                <label for="job" class="form-label">job</label>
                <input type="text" class="form-control" name="job" id="job" aria-describedby="helpId"
                    placeholder="job" />
            </div>

            <div class="mb-3" id="networksContainer">
                <label for="networks" class="form-label">networks</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="networks[]" id="networks" placeholder="networks" />
                </div>
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