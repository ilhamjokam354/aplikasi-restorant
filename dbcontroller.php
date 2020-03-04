<?php
    class DB{
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "db_restoran";
        private $koneksi;


        public function __construct(){
            $this->koneksi = $this->koneksiDatabase();
        }
        public function koneksiDatabase(){
            $koneksi = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            return $koneksi;
        }
        public function getAll($sql){
            $result = mysqli_query($this->koneksi, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $data[]=$row;
            }
            if (!empty($data)) {
                return $data;
            }
            
        }
        public function getItem($sql){
            $result = mysqli_query($this->koneksi, $sql);
            $row = mysqli_fetch_assoc($result);
            //$isidata[]=$row;
            return $row;
        }
        public function rowCount($sql){
            $result = mysqli_query($this->koneksi, $sql);
            $count = mysqli_num_rows($result);
            return $count;
        }
        public function runSql($sql){ // untuk funtion yang tanpa echo atau return bisa langsung dipanggil tanpa mendklarasikan echo 
            $result = mysqli_query($this->koneksi, $sql);
            
        }
        public function pesan($text=""){
            echo $text;
        }
    }
    //$db = new DB;
    
    //$row = $db->getAll("SELECT * FROM tbl_kategori");


    // foreach ($row as $key ) {
    //     echo $key['kategori'];
    //     echo '<br>';
    // }
    //memanggil function getItem
    //$row =$db->getItem("SELECT * FROM tbl_kategori WHERE id_kategori= 2");
    //$count = $db->rowCount("SELECT * FROM tbl_kategori ");
    //echo $db->runSql('DELETE FROM tbl_kategori WHERE  id_kategori=28');
    //$db->pesan("BERHASIL");

    
?>