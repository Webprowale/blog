<?php
$id = $_GET['id'];

include("config.php");
$sql = "SELECT * FROM post WHERE id = '$id'";
$results = mysqli_query($conn, $sql);
if (mysqli_num_rows($results) > 0) {
    $row = mysqli_fetch_assoc($results);
} else {
    echo "<script>
    alert('Content not found');
    window.location.href= './blog.php';
    </script>";
}
mysqli_close($conn);
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
        <nav aria-label="breadcrumb  p-5 mb-5">
            <ol class="breadcrumb text-center">
                <li class="breadcrumb-item fs-4 fw-semibold"><a href="./">Home</a></li>
                <li class="breadcrumb-item active fs-4 fw-semibold" aria-current="page"><?= $row['title'] ?></li>
            </ol>
        </nav>
        <div class="card bg-white mx-5 border-0">
            <div class="card-body">
                <img src="./images/<?= $row['image'] ?>" class="img-fluid" width="500">
                <h3 class="fs-6 fw-bold text-info mb-2">
                    <?= $row['author']; ?>
                </h3>
                <h5 class="card-title fw-bold fs-5 mb-3">
                    <?= $row['title']; ?>
                </h5>
                <p class="card-text fs-6 fw-semibold mb-2">
                    <?= $row['description']; ?>
                </p>
                <p class="lead"> <?= $row['body']; ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
