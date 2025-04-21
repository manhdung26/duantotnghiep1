CREATE DATABASE MT2_KT2_24_NguyenManhDung1 
GO
USE  MT2_KT2_24_NguyenManhDung1
GO

CREATE TABLE Sinhvien
(
MaSV char(10) PRIMARY KEY,
HoTen nvarchar(50),
Tuoi int,
Gioitinh nvarchar(10)
)

CREATE TABLE Hoc
(
MaSV char(10),
MaMH char(10),
Diem int
)

CREATE TABLE MonHoc
(
MaMH char(10) PRIMARY KEY,
TenMH nvarchar(50)
)



INSERT INTO Sinhvien VALUES
('SV01',N'Kiều Phong',30,N'Nam'),
('SV02',N'Hư Trúc',28,N'Nam'),
('SV03',N'Đoàn Dự',25,N'Nam'),
('SV04',N'Mộ Dung Phục',25,N'Nam'),
('SV05',N'Tiểu Long Nữ',18,N'Nữ')

INSERT INTO Hoc VALUES
('SV01','MH01',8),
('SV01','MH04',9),
('SV02','MH01',5),
('SV02','MH02',7),
('SV02','MH03',8),
('SV03','MH05',9),
('SV03','MH06',10),
('SV05','MH01',4),
('SV05','MH05',9)

INSERT INTO MonHoc VALUES
('MH01',N'Túy Quyền'),
('MH02',N'Túy Kiếm'),
('MH03',N'Túy Côn'),
('MH04',N'Hàng Long Thập Bát Chưởng'),
('MH05',N'Lang Tam Di Bộ'),
('MH06',N'Lục Mạch Thần Kiếm')

select * from Sinhvien
select * from Hoc
select * from MonHoc

--1: Hiểm Thị THông Tin Của Toàn Bộ Sinh viên
select MaSV,HoTen,Tuoi,Gioitinh
from SinhVien

--2: Hiển thị thông tin của các môn học
select MaMH,TenMH
from MonHoc

--3: hiển thị thông tin của sinh viên có giới tính nữ
select MaSV,HoTen,Tuoi,Gioitinh
from SinhVien
where Gioitinh= N'Nữ'
--4: hiển thị thông tin của môn học có nhiều sinh viên theo
select top 1 MaMH,TenMH
from MonHoc
group by MaMH,TenMH
--5: hiển thị thông tin của sinh viên chưa học bất kỳ môn nào
select Sinhvien.MaSV,HoTen,Tuoi,Gioitinh
from Sinhvien left join Hoc
on Sinhvien.MaSV=Hoc.MaSV
where Hoc.MaMH is null
