<?php 
// buoc 1: ket noi DB Server

try{
    $host = "localhost";
    $dbname = "btth01_cse485";
    $user = "root";
    $pass = "";
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    try{
        $sqlDelete = "delete from theloai where ma_tloai = :ma_tloai";
        $pstDelete = $conn->prepare($sqlDelete);
        $idCategory = $_GET['id'];
        $pstDelete->bindParam(':ma_tloai', $idCategory);
        $pstDelete->execute();  

        echo '<script>alert("Xóa thể loại thành công!"); window.location.href = "category.php";</script>';
    }catch(Exception $e){
        echo "Lỗi xóa: tác giả này đã được tham chiếu, không thể xóa";
    }

 
   
}catch(PDOException $e){
    echo 'Error: '. $e->getMessage();
}
?>