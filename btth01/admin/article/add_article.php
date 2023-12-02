<!-- add_article.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Mới Bài Viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <!-- Navbar details -->
            </div>
        </nav>
    </header>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">THÊM MỚI BÀI VIẾT</h3>

                <?php
                    try {
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Kết nối đến cơ sở dữ liệu
                            $conn = new PDO("mysql:host=localhost;dbname=btth01_cse485", "root", "");

                            // Lấy dữ liệu từ form
                            $mabviet = $_POST['txtMaBaiViet'];
                            $tieude = $_POST['txtTieuDe'];
                            $ten_bhat = $_POST['txtTenBHat'];
                            $ma_tloai = $_POST['txtMaTLoai'];
                            $tomtat = $_POST['txtTomTat'];
                            $noidung = $_POST['txtNoiDung'];
                            $ma_tgia = $_POST['txtMaTGia'];
                            $ngayviet = $_POST['txtNgayViet'];
                            $hinhanh = $_POST['txtHinhAnh'];

                            // Thực hiện truy vấn thêm mới
                            $query = "INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh) 
                                    VALUES (:ma_bviet, :tieude, :ten_bhat, :ma_tloai, :tomtat, :noidung, :ma_tgia, :ngayviet, :hinhanh)";
                            $statement = $conn->prepare($query);

                            // Bind giá trị cho các tham số
                            $statement->bindParam(':ma_bviet', $mabviet);
                            $statement->bindParam(':tieude', $tieude);
                            $statement->bindParam(':ten_bhat', $ten_bhat);
                            $statement->bindParam(':ma_tloai', $ma_tloai);
                            $statement->bindParam(':tomtat', $tomtat);
                            $statement->bindParam(':noidung', $noidung);
                            $statement->bindParam(':ma_tgia', $ma_tgia);
                            $statement->bindParam(':ngayviet', $ngayviet);
                            
                            // Kiểm tra nếu có hình ảnh thì mới bind giá trị cho hinhanh
                            if (!empty($hinhanh)) {
                                $statement->bindParam(':hinhanh', $hinhanh);
                            } else {
                                // Nếu không có hình ảnh, chèn giá trị null vào cột hinhanh
                                $statement->bindValue(':hinhanh', null, PDO::PARAM_NULL);
                            }

                            $statement->execute();

                            // Hiển thị thông báo thành công và chuyển hướng về trang quản lý bài viết
                            echo "<div class='alert alert-success mt-3' role='alert'>
                                    Thêm mới bài viết thành công!
                                </div>";
                        }
                    } catch (PDOException $e) {
                        echo "<div class='alert alert-danger mt-3' role='alert'>
                                Lỗi: " . $e->getMessage() . "
                            </div>";
                    }
                    ?>


                <form action="add_article.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblTieuDe">Mã bài viết</span>
                        <input type="text" class="form-control" name="txtMaBaiViet" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblTieuDe">Tiêu đề</span>
                        <input type="text" class="form-control" name="txtTieuDe" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblTenBHat">Tên bài hát</span>
                        <input type="text" class="form-control" name="txtTenBHat" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblMaTLoai">Mã thể loại</span>
                        <input type="text" class="form-control" name="txtMaTLoai" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblTomTat">Tóm tắt</span>
                        <textarea class="form-control" name="txtTomTat" rows="5" required></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblNoiDung">Nội dung</span>
                        <textarea class="form-control" name="txtNoiDung" rows="10" required></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblMaTGia">Mã tác giả</span>
                        <input type="text" class="form-control" name="txtMaTGia" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblNgayViet">Ngày viết</span>
                        <input type="datetime-local" class="form-control" name="txtNgayViet" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblHinhAnh">Hình ảnh</span>
                        <input type="text" class="form-control" name="txtHinhAnh">
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
