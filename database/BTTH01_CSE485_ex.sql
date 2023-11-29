/*a Liệt kê các bài viết về các bài hát thuộc thể loại nhạc trữ tình*/
SELECT tieude FROM baiviet INNER JOIN ON baiviet.ma_tloai = theloai.ma_tloai where ma_tloai = 2;

/*b Liệt kê các bài viết của tác giả "Nhacvietplus" */
SELECT tieude FROM tacgia INNER JOIN baiviet ON tacgia.ma_tgia=baiviet.ma_tgia WHERE ten_tgia = N'Nhacvietplus';

/*c. Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào. (2 đ)*/
select * from theloai where ma_tloai not in (select ma_tloai from baiviet);

/*d. Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết. (2 đ)*/
select ma_bviet, tieude, ten_bhat, ten_tgia, ten_tloai, ngayviet 
		from baiviet join tacgia  on baiviet.ma_tgia = tacgia.ma_tgia join theloai on theloai.ma_tloai = baiviet.ma_tloai;
        
/*e. Tìm thể loại có số bài viết nhiều nhất (2 đ)*/
select DISTINCT ten_tloai from baiviet join theloai on baiviet.ma_tloai = theloai.ma_tloai where baiviet.ma_tloai = (
  SELECT baiviet.ma_tloai FROM baiviet GROUP BY baiviet.ma_tloai ORDER BY COUNT(*) DESC limit 1
);

/*f. Liệt kê 2 tác giả có số bài viết nhiều nhất (2 đ)*/
select  b.ma_tgia, t.ten_tgia  from baiviet b  join tacgia t on b.ma_tgia = t.ma_tgia 
	group by b.ma_tgia, t.ten_tgia ORDER BY count(b.ma_bviet) DESC limit 2;

/*g. Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, 
“em” (2 đ)*/
SELECT * FROM baiviet 
WHERE ten_bhat like N'%Yêu%' OR ten_bhat LIKE N'%thương%' OR ten_bhat LIKE N'%anh%' OR ten_bhat LIKE N'%em%';

/*h. Liệt kê các bài viết về các bài hát có tiêu đề bài viết hoặc tựa bài hát chứa 1 trong các từ 
“yêu”, “thương”, “anh”, “em” (2 đ)*/
SELECT * FROM baiviet 
WHERE ten_bhat like N'%Yêu%' OR ten_bhat LIKE N'%thương%' OR ten_bhat LIKE N'%anh%' OR ten_bhat LIKE N'%em%' OR tieude like N'%Yêu%' OR tieude LIKE N'%thương%' OR tieude LIKE N'%anh%' OR tieude LIKE N'%em%';
/*l. Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng
Đăng nhập/Quản trị trang web. (5 đ)*/
create table users(UserName varchar(100), Password varchar(100))
