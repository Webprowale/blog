<?php
include("./config.php");
$sql = "SELECT * FROM post";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="bg-black d-flex justify-content-between p-2">
         <h3 class="text-white fs-3 fw-bold">Admin</h3>
         <button class="btn px-3 bg-white shadow ">Upload</button>
        </nav>
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Description</th>
                    <th scope="col">Body</th>
                    <th scope="col">Image</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Del</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($result)) : ?>
                    <tr>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['author'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['body'] ?></td>
                        <td><img src="./images/<?= $row['image'] ?>" class="img-fluid" width="100"></td>
                        <td><i class="fas fa-edit text-success fs-3 mt-3 edit-icon" onclick="getfuc(<?= $row['id'] ?>)"></i></td>
                        <td><i class="fas fa-trash text-danger fs-3 mt-3" onclick="delfuc(<?= $row['id'] ?>)"></i></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function getfuc(id) {
            if (confirm('Are you sure you want to update this information?')) {
                window.location.href = './update.php?id=' + id;
            }
        }
        function delfuc(id){
            if (confirm('Are you sure you want to delete this information?')) {
                window.location.href = './delete.php?id=' + id;
            }else{
                window.location.href = './admin.php';
            }
        }
    </script>
</body>

</html>
