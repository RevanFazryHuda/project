<?php

include_once('../db/database.php');

class TransaksiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addTransaksi($kode_beli, $kode_pembeli, $tanggal_transaksi )
    {
        $sql = "INSERT INTO transaksi (kode_beli, kode_pembeli, tanggal_transaksi ) VALUES (:kode_beli, :kode_pembeli, :tanggal_transaksi)";
        $params = array(
          ":kode_beli" => $kode_beli,
          ":kode_pembeli" => $kode_pembeli,
          ":tanggal_transaksi" => $tanggal_transaksi,

        );

        $result= $this->db->executeQuery($sql, $params);
        // Check if the insert was successful
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
    
        // Return the response as JSON
        return json_encode($response);
    }

    public function getTransaksi($id)
    {
        $sql = "SELECT * FROM transaksi WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTransaksi($id, $kode_beli, $kode_pembeli, $tanggal_transaksi )
    {
        $sql = "UPDATE transaksi SET kode_beli = :kode_beli, kode_pembeli = :kode_pembeli, tanggal_transaksi = :tanggal_transaksi    WHERE id = :id";
        $params = array(
          ":kode_beli" => $kode_beli,
          ":kode_pembeli" => $kode_pembeli,
          ":tanggal_transaksi" => $tanggal_transaksi,
          ":id" => $id
        );
    
        // Execute the query
        $result = $this->db->executeQuery($sql, $params);
    
        // Check if the update was successful
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
    
        // Return the response as JSON
        return json_encode($response);
    }
    
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE transaksi SET dibeli = :dibeli WHERE id = :id";
        $params = array(
          ":dibeli" => $status,
          ":id" => $id
        );
    
        // Execute the query
        $result = $this->db->executeQuery($sql, $params);
    
        // Check if the update was successful
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
    
        // Return the response as JSON
        return json_encode($response);
    }

    
    public function deleteTransaksi($id)
    {
        $sql = "DELETE FROM transaksi WHERE id = :id";
        $params = array(":id" => $id);

        $result = $this->db->executeQuery($sql, $params);
        // Check if the delete was successful
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
    
        // Return the response as JSON
        return json_encode($response);
    }

    public function getTransaksiList()
    {
        $sql = 'SELECT t.id, t.kode_beli, t.kode_pembeli, P.nama_pembeli, t.tanggal_transaksi, t.dibeli 
        FROM transaksi t  left Join pembeli P on (P.kode_pembeli = t.kode_pembeli) limit 100';  
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM transaksi';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function filter($criteria)
    {
        $conditions = [];
        $params = [];

        if (!empty($criteria['tanggal_transaksis'])) {
            $conditions[] = "tanggal_transaksi >= :tanggal_transaksis";
            $params[':tanggal_transaksis'] = $criteria['tanggal_transaksis'];
        }

        $sql = "SELECT t.*, p.nama_pembeli FROM transaksi t 
                JOIN pembeli p ON t.kode_pembeli = p.kode_pembeli";
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $result = $this->db->executeQuery($sql, $params);
        return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
