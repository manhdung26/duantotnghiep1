/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package bktra;

/**
 *
 * @author Acer
 */
public class sach {
    private String tensach;
    private String theloai;
    private double giasach;
    private String Trangthai;

    public String getTensach() {
        return tensach;
    }

    public void setTensach(String tensach) {
        this.tensach = tensach;
    }

    public String getTheloai() {
        return theloai;
    }

    public void setTheloai(String theloai) {
        this.theloai = theloai;
    }

    public double getGiasach() {
        return giasach;
    }

    public void setGiasach(double giasach) {
        this.giasach = giasach;
    }

    /**
     *
     * @return
     */
    public String getTrangthai() {
        return Trangthai;
    }

    public void setTrangthai(String Trangthai) {
        this.Trangthai = Trangthai;
    }
     public sach(String tensach, String theloai, double giasach, String Trangthai) {
        this.tensach = tensach;
        this.theloai = theloai;
        this.giasach = giasach;
        this.Trangthai = Trangthai;
    }

    public sach(String theloai) {
        this.theloai = this.theloai;
    }
        
    public String getStatus(double dongia){
        String danhgia;
        if(dongia >= 5000){
             danhgia = "Sản phẩm Đắt";
        }else{
            danhgia = "Bình thường";
        }
        return danhgia;
    }
}

