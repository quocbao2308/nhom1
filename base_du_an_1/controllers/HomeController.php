<?php 

class HomeController
{


    public $modelSanPham;

    public function __construct()
    {
        require_once 'models/SanPham.php';
        $this->modelSanPham = new SanPham();
    }

    public function index() {
        echo "ok";
    }

    public function home (){
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function chiTietSanPham(){
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this ->modelSanPham->getBinhLuanFromSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDangMuc($sanPham['danh_muc_id']);
        if($sanPham){
            require_once "./views/chiTietSanPham.php";
        }else{
            header("location: ".BASE_URL);
        }
    }
}