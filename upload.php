<?php
$author = $title = $description = $body = $catch = $image = $img_tmp = "";
  if( $_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])){
    $author = htmlspecialchars($_POST['author']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $body = htmlspecialchars($_POST['body']);
    $image = $_FILES['image']['name'];
    $img_tmp = $_FILES['image']['tmp_name'];
    $folder = "./images/";
  if(empty($title) || empty($description) || empty($body) || empty($author) || empty($image) ){
     $catch = "Input Field is required";
  }else{
    $img_ext = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $img_set = time().'_'. rand(100, 999). '.'. $img_ext;
    move_uploaded_file($img_tmp, $folder.$img_set); 
     include("config.php");
     $sql = "INSERT INTO post (author, title, description, body,image) VALUES('$author', '$title', '$description', '$body', '$img_set')" ;
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Record inserted successfully'); window.location.href = './blog.php';</script>";
        
        }else{
        echo "<script>alert('Record can not be inserted');</script>";
     }
     mysqli_close($conn);
  }
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
    <div class="container-fluid pt-5">
        <form class="shadow rounded px-4 py-3 mx-auto" style="max-width: 35rem;" method="post" enctype="multipart/form-data" >
          <p class="fs-5 fw-bold mt-2 text-center">Input the field below to upload your content</p>
          <div class="row">
            <div class="col-6">
            <div class=" mx-1 ">
                <label for="exampleFormControlInput1" class="form-label">Author</label>
                <input type="text" name="author" value="<?= $author ?>" class="form-control" id="exampleFormControlInput1" placeholder="author...">
                 <small class="fw-semibold text-danger "><?= $catch ?></small>
            </div>
            </div>
            <div class="col-6">
            <div class="mx-1">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="title of post...">
                <small class=" fw-semibold text-danger "><?= $catch ?></small>
            </div>
            </div>
          </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="exampleFormControlInput1" placeholder="describe the post....">
                <small class="fw-semibold text-danger"><?= $catch ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="exampleFormControlInput1" placeholder="The image for post....">
                <small class="fw-semibold text-danger"><?= $catch ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                <textarea class="form-control" name="body" rows="6" id="exampleFormControlTextarea1"></textarea>
                <small class="fw-semibold text-danger "><?= $catch ?></small>
            </div>
            <input type="submit" name="submit" value="Send" class="btn bg-black text-white form-control fs-5 fw-bold">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>