<?php

include_once('../db/database.php');

class TransaksidetailModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addTransaksidetail($transaksi_id, $kode_parfum, $jumlah)
    {
        $sql = "INSERT INTO transaksidetail (transaksi_id, kode_parfum, jumlah) VALUES (:transaksi_id, :kode_parfum, :jumlah)";
        $params = array(
            ":transaksi_id" => $transaksi_id,
            ":kode_parfum" => $kode_parfum,
            ":jumlah" => $jumlah
        );

        $result = $this->db->executeQuery($sql, $params);
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Insert successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Insert failed"
            );
        }

        return json_encode($response);
    }

    public function getTransaksidetail($id)
    {
        $sql = "SELECT T.id, T.transaksi_id, T.kode_parfum, P.nama_parfum, P.merk, P.harga, P.harga, P.stock, T.jumlah 
                FROM `transaksidetail` T 
                LEFT JOIN `parfum` P ON (T.kode_parfum = P.kode_parfum) 
                WHERE T.id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countTransaksidetail($id)
    {
        $sql = "SELECT SUM(jumlah) as total FROM `transaksidetail` WHERE transaksi_id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchColumn();
    }

    public function updateTransaksidetail($id, $transaksi_id, $kode_parfum)
    {
        $sql = "UPDATE transaksidetail 
                SET transaksi_id = :transaksi_id, kode_parfum = :kode_parfum
                WHERE id = :id";
        $params = array(
            ":transaksi_id" => $transaksi_id,
            ":kode_parfum" => $kode_parfum,
            ":id" => $id
        );

        $result = $this->db->executeQuery($sql, $params);
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Update successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Update failed"
            );
        }

        return json_encode($response);
    }

    public function deleteTransaksidetail($id)
    {
        $sql = "DELETE FROM transaksidetail WHERE id = :id";
        $params = array(":id" => $id);

        $result = $this->db->executeQuery($sql, $params);
        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Delete successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Delete failed"
            );
        }

        return json_encode($response);
    }

    public function getTransaksidetailList($id)
    {
        $sql = 'SELECT T.id, T.transaksi_id, T.kode_parfum,P.harga, P.nama_parfum, P.merk, P.harga, P.stock, T.jumlah 
                FROM `transaksidetail` T 
                LEFT JOIN `parfum` P ON (T.kode_parfum = P.kode_parfum) 
                WHERE T.transaksi_id = :id';
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDataCombo()
    {
        $sql = 'SELECT * FROM transaksidetail';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function penguranganStock($kode_parfum, $transaksi_id)
    {
        // Ambil detail transaksi untuk transaksi_id tertentu
        $detailRows = $this->getTransaksidetailList($transaksi_id);

        // Cek jika ada detail transaksi untuk transaksi_id tersebut
        foreach ($detailRows as $row) {
            // Jika kode_parfum yang dipilih sama dengan kode_parfum yang ada di detail transaksi
            if ($row['kode_parfum'] === $kode_parfum) {
                $jumlah_beli = $row['jumlah'];
                $stock = $row['stock'];

                // Pastikan jumlah beli lebih besar dari 0
                if ($stock > 0) {
                    // Query untuk mengurangi stok
                    $sql = "UPDATE parfum SET stock = stock - :jumlah_beli WHERE kode_parfum = :kode_parfum";
                    $params = array(
                        ":jumlah_beli" => $jumlah_beli,
                        ":kode_parfum" => $kode_parfum
                    );

                    $result = $this->db->executeQuery($sql, $params);

                    if ($result) {
                        return array(
                            "success" => true,
                            "message" => "Stock updated successfully for parfum $kode_parfum"
                        );
                    } else {
                        return array(
                            "success" => false,
                            "message" => "Failed to update stock for parfum $kode_parfum"
                        );
                    }
                }
            }
        }
    }

    public function countTotalHarga($id)
    {
        $sql = "SELECT SUM(p.harga) as total FROM `parfum` p
                JOIN `transaksidetail` td ON p.kode_parfum = td.kode_parfum
                WHERE td.transaksi_id = :id";
        $params = array(":id" => $id);
        $result = $this->db->executeQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0; 
    }
        
}
