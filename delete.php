<?php
$id = $_GET['id'];
include("config.php");

$sql = "SELECT * FROM post WHERE id= '$id' ";
$results = mysqli_query($conn, $sql);
if (mysqli_num_rows($results) > 0){
 $del = "DELETE FROM post WHERE id = '$id'";
 $del_query = mysqli_query($conn, $del);
 if($del_query){
    echo "<script>
    alert('Row delete successfully!');
    window.location.href= './admin.php';
    </script>";
 }else{
    echo "<script>
    alert('row can not be found');
    window.location.href= './admin.php';
    </script>";
 }    
    mysqli_close($conn);
}else{
    echo "<script>
    alert('content can not be found');
    window.location.href= './blog.php';
    </script>";
}   