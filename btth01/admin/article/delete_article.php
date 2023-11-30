<?php 
// buoc 1: ket noi DB Server

try{
    $host = "localhost";
    $dbname = "btth01_cse485";
    $user = "root";
    $pass = "";
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    try{
        $sqlDelete = "delete from baiviet where ma_bviet = :ma_bviet";
        $pstDelete = $conn->prepare($sqlDelete);
        $idArticle = $_GET['id'];
        $pstDelete->bindParam(':ma_bviet', $idArticle);
        $pstDelete->execute();  

        echo '<script>alert("Xóa tác giả thành công!"); window.location.href = "article.php";</script>';
    }catch(Exception $e){
        echo "Lỗi xóa: {$e->getMessage()}";
    }

 
   
}catch(PDOException $e){
    echo 'Error: '. $e->getMessage();
}
?>