<?php
$author = $title = $description = $body = $catch = $image = $img_tmp = "";
$id = $_GET['id'];
include("config.php");

$sql = "SELECT * FROM post WHERE id= '$id' ";
$results = mysqli_query($conn, $sql);
if (mysqli_num_rows($results) > 0){
    $row = mysqli_fetch_assoc($results);
    $title = $row['title'];
    $author = $row['author'];
    $description = $row['description'];
    $body = $row['body'];
    $image = $row['image'];

    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['update'])){
        $author = htmlspecialchars($_POST['author']);
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        $body = htmlspecialchars($_POST['body']);
        $img_tmp = $_FILES['image']['tmp_name'];
        $folder = "./images/";

        
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            move_uploaded_file($img_tmp, $folder.$image);
        }

        if(empty($title) || empty($description) || empty($body) || empty($author)){
            $catch = "Input Field is required";
        } else {
            $update_sql = "UPDATE post SET update_at = CURRENT_TIMESTAMP, title = '$title', author = '$author', description = '$description', body = '$body', image = '$image' WHERE id = $id";
            $update_query = mysqli_query($conn, $update_sql);
            if($update_query){
                echo "<script>alert('Record updated successfully'); window.location.href = './admin.php';</script>";
            } else {
                echo "<script>alert('Record can not be updated');</script>";
            }
        }
    }
    mysqli_close($conn);
} else {
    echo "<script>
    alert('Content not found');
    window.location.href= './admin.php';
    </script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid p-0">
     <?php require "./navbar.php"; ?>
     <div class="container">
        <form class="shadow rounded px-4 py-3 mx-auto" style="max-width: 35rem;" method="post" enctype="multipart/form-data" >
          <p class="fs-5 fw-bold mt-2 text-center">Update the field below to upload your content</p>
          <div class="row">
            <div class="col-6">
            <div class="mx-1">
                <label for="exampleFormControlInput1" class="form-label">Author</label>
                <input type="text" name="author" value="<?= $author ?>" class="form-control" id="exampleFormControlInput1" placeholder="author...">
                 <small class="fw-semibold text-danger "><?= $catch ?></small>
            </div>
            </div>
            <div class="col-6">
            <div class="mx-1">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" value="<?= $title ?>" class="form-control" id="exampleFormControlInput1" placeholder="title of post...">
                <small class=" fw-semibold text-danger "><?= $catch ?></small>
            </div>
            </div>
          </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <input type="text" name="description" value="<?=$description ?>" class="form-control" id="exampleFormControlInput1" placeholder="describe the post....">
                <small class="fw-semibold text-danger"><?= $catch ?></small>
            </div>
            <div class="mb-3">
              <img src="./images/<?=$image ?>" width="40px">
                <input type="file" name="image" class="form-control" id="exampleFormControlInput1" placeholder="The image for post....">
                <small class="fw-semibold text-danger"><?= $catch ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="6"><?= $body ?></textarea>
                <small class="fw-semibold text-danger "><?= $catch ?></small>
            </div>
            <input type="submit" name="update" value="Update" class="btn bg-black text-white form-control fs-5 fw-bold">
        </form>
     </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>