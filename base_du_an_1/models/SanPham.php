<?php


class SanPham
{

    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllSanPham()
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams 
            INNER Join danh_mucs on san_phams.danh_muc_id = danh_mucs.id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT san_pham.*, danh_mucs.ten_danh_muc FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id= danh_mucs.id WHERE san_phams.id=:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getListAnhSanPham($id)
    {
        try {
            $sql = 'SELECT *FROM hinh_anh_san_pham Where san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getBinhLuanFromSanPham($id)
    {
        try {
            $sql = 'SELECT binh_luans.*, tai_khoans.ho_ten,tai_khoans.anhdaidien FROM binh_luans
            INNER JOIN tai_khoans on binh_luans.tai_khoan_id =tai_khoans.id WHERE binh_luans.san_pham_id =:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getListSanPhamDangMuc($danh_muc_id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams 
            INNER Join danh_mucs on san_phams.danh_muc_id = danh_mucs.id WHERE san_phams.danh_muc_id ='.$danh_muc_id;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}
