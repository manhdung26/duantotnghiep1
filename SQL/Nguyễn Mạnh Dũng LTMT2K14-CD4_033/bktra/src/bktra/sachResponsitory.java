/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package bktra;

import com.microsoft.sqlserver.jdbc.SQLServerException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

/**
 *
 * @author Admin
 */
public class sachResponsitory {

    DBContext db = new DBContext();
    Connection con;

    public ArrayList<sach> GetAllsach() throws SQLServerException {

        String sql = "select * from Sach";

        try {
            ArrayList<sach> lstsach = new ArrayList<sach>();
            java.sql.Connection con = db.getConnection();

            Statement sm = con.createStatement();

            ResultSet rs = sm.executeQuery(sql);

            while (rs.next()) {
                lstsach.add(new sach(
                        rs.getString(1),
                        rs.getString(2),
                        rs.getDouble(3),
                        rs.getString(4)
                ));
            }
            return lstsach;
        } catch (Exception e) {
            return null;
        }

    }
    
    public ArrayList<sach> loadcombobox() throws SQLServerException {

        String sql = "SELECT DISTINCT theloai FROM Sach";

        try {
            ArrayList<sach> lstsach = new ArrayList<sach>();
            java.sql.Connection con = db.getConnection();

            Statement sm = con.createStatement();

            ResultSet rs = sm.executeQuery(sql);

            while (rs.next()) {
                lstsach.add(new sach(rs.getString(1))
                );
            }
            return lstsach;
        } catch (Exception e) {
            return null;
        }

    }
    
    public int addsach(sach sp) {
        //Dựa trên vị trí của constructor trong model
        String sql = "INSERT INTO Sach (Tensach, theloai, giasach, TrangThai) VALUES (?,?,?,?)";
        try (
                java.sql.Connection cn = DBContext.getConnection(); 
                PreparedStatement pstmt = cn.prepareStatement(sql)) 
        {
            pstmt.setString(1, sp.getTensach());
            pstmt.setString(2, sp.getTheloai());
            pstmt.setDouble(3, sp.getGiasach());
            pstmt.setString(4, sp.getTrangthai());
            return pstmt.executeUpdate();
        } catch (Exception e) {
            return 0;
        }
    }
}
