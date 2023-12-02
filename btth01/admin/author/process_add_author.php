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
function addAuthor($nameAut, $linkImg)
{
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (:name, :imgLink)");
        $stmt->bindParam(':name', $nameAut);
        $stmt->bindParam(':imgLink', $linkImg);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

// Kiểm tra xem form đã được gửi đi hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['txtAutName'])) {
    $id = 5;
    $nameOfAut = $_POST['txtAutName'];
    $imgLink = "../../images/authors_img/author_" . $id . ".png";
    echo $nameOfAut;
    echo $imgLink;
    try {
        $updateNew = addAuthor($nameOfAut, $imgLink);
        if ($updateNew) {
            echo '<script>alert("Thêm tác giả thành công!"); window.location.href = "author.php";</script>';
        } else {
            echo '<script>alert("Thêm tác giả không thành công!"); window.location.href = "author.php";</script>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo '<script>alert("Thêm tác giả không thành công!"); window.location.href = "author.php";</script>';
    }
}
?>