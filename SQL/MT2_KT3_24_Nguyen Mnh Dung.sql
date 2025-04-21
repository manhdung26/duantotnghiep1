create database  MT2_KT3_24_Nguyen Mnh Dung
go
use MT2_KT3_24_Nguyen Mnh Dung
go

create table NhanVien
(
MaNV char(10) PRIMARY KEY,
MaPhong char(10),
MaLuong char(20),
TenNV nvarchar(30),
Diachi nvarchar(30),
NgaySinh char(10),
NgayLam char(20)
)

create table PhongBan
(
MaPhong char(10) PRIMARY KEY,
TenPhong nvarchar(30)
)

create table Luong
(
MaLuong char(10) PRIMARY KEY,
BacLuong char(20),
MucLuong char(20),
MoTa nvarchar(30)
)


INSERT INTO NhanVien VALUES
('NV01',1,'L04',N'Trần Văn Hoàng',N'Cầu Giấy','2/3/1989','2000'),
('NV02',1,'L02',N'Trần Văn Hùng',N'Cầu Giấy','2/3/1989','2005'),
('NV03',2,'L03',N'Nguyễn Văn Hoàng',N'Cầu Giấy','2/3/1989','2001'),
('NV04',3,'L03',N'Công Văn Hoàng',N'Cầu Giấy','2/3/1989','2002'),
('NV05',4,'L04',N'Trần Phú Nghĩa',N'Hà Đông','2/3/1989','2000')


INSERT INTO PhongBan VALUES
(1,N'Phòng Ban A'),
(2,N'Phòng Ban B'),
(3,N'Phòng Ban C'),
(4,N'Phòng Ban D')

INSERT INTO Luong VALUES
('L01','2','5000000',N'Lương Bậc 2'),
('L02','3','8000000',N'Lương Bậc 3'),
('L03','4','10000000',N'Lương Bậc 4'),
('L04','5','15000000',N'Lương Bâc 5')
select * from NhanVien
select * from PhongBan
select * from Luong

-- câu 3
--1 thực hiện truy vấn nhân viên họ "trần"
select MaNV,TenNV
from NhanVien
where TenNV like N'Trần%' ;

--2 hiển thị thông tin nhân viên có lương thấp nhất
select MaNV,MaPhong,TenNV,Diachi,NgaySinh,BacLuong,MucLuong
from NhanVien inner join Luong
on NhanVien.MaLuong=Luong.MaLuong
where MucLuong=(select MIN(MucLuong) from Luong)


--3 hiển thị thông tin của sinh viên vào làm năm 2000
select MaNV,MaPhong,TenNV,Diachi,NgaySinh,MaLuong,NgayLam
from NhanVien
where NgayLam like '2000%';

-- câu 4
--viết procedure tìm kiếm thông tin nv theo biến truyền vào là tên phòng ban
create procedure nhanvienn @phongban nvarchar(30)
as
select NhanVien.manv,NhanVien.maphong,maluong,tennv,diachi,ngaysinh,ngaylam,tenphong
from NhanVien inner join PhongBan
on NhanVien.maphong= PhongBan.maphong
where tenphong = @phongban
go

select *from NhanVien
exec nhanvienn @phongban =N'Phòng Ban B'


-- viết procedure liệt kê phòng ban qua mã phòng
create procedure phongbann @maphong nvarchar(30)
as
select *from PhongBan
where maphong =@maphong 
go

select *from PhongBan
exec phongbann @maphong ='1'



