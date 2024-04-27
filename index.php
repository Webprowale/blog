<?php
 include("./config.php");
  $sql = " SELECT * FROM post ";
  $result = mysqli_query($con, $sql);
    
  mysqli_close($con)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
    .img-container {
    min-width: 200px;
    max-width: 300px;
    min-height: 200px;
    max-height: 300px;
    overflow: hidden; 
}
.img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}
    </style>
</head>

<body>
   <div class="container-fluid p-0 bg-light">
    <?php require "./navbar.php"; ?>
    <div class="row align-items-center justify-content-center mx-2">
    <?php while($row = mysqli_fetch_array($result)){ ?>
      <div class="col-md-6">
        <div class=" card bg-white border-0 shadow mt-3">
        <?php   $_SESSION['post_id'] = $row['id'] ?>
        <div class="card-body">
          <div class="img-container">
          <img src="./images/<?= $row['image'] ?>" class="img-fluid">
          </div>
            <h3 class="fs-6 fw-bold text-info">
            <?php echo $row['author']; ?>
            </h3>
          <h5 class="card-title fw-bold fs-5">
          <?php echo $row['title']; ?>
          </h5>
          <p class="card-text lead fs-6">
          <?php echo $row['description']; ?>
          </p>
          <a href="./content.php?id=<?=$row['id'] ?>" class="card-link btn btn-primary"
            >Read More<i class="fas fa-arrow-right ms-1"></i
          ></a>
        </div>
      </div>
      </div>
     <?php } ?>   
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>