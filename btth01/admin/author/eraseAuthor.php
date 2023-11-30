<?php
$host = 'localhost';
$db = 'btth01_cse485';
$user = 'root';
$pass = '';
//Buoc 1: Connect DB server
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<?php
$id = $_GET['id'] ?? '';
global $conn;
try {
    // echo $id;
    $stmt = $conn->prepare("DELETE FROM tacgia WHERE ma_tgia = $id");
    $stmt->execute();

    echo '<script>alert("Xóa tác giả thành công!"); window.location.href = "author.php";</script>';
} catch (PDOException $e) {
    echo $e->getMessage();
    echo '<script>alert("Xóa tác giả không thành công!"); window.location.href = "author.php";</script>';
}
?>