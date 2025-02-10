<?php

include_once('../db/database.php');

class PembeliModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addPembeli($kode_pembeli, $nama_pembeli, $jk, $alamat, $telepon)
    {
        $sql = "INSERT INTO Pembeli (kode_pembeli, nama_pembeli, jk, alamat, telepon) VALUES (:kode_pembeli, :nama_pembeli, :jk, :alamat, :telepon)";
        $params = array(
            ":kode_pembeli" => $kode_pembeli,
            ":nama_pembeli" => $nama_pembeli,
            ":jk" => $jk,
            ":alamat" => $alamat,
            ":telepon" => $telepon
        );

        $result = $this->db->executeQuery($sql, $params);

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

    public function getPembeli($id)
    {
        $sql = "SELECT * FROM Pembeli WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePembeli($id, $kode_pembeli, $nama_pembeli, $jk, $alamat, $telepon)
    {
        $sql = "UPDATE Pembeli SET kode_pembeli = :kode_pembeli, nama_pembeli = :nama_pembeli, jk = :jk, alamat = :alamat, telepon = :telepon WHERE id = :id";
        $params = array(
            ":kode_pembeli" => $kode_pembeli,
            ":nama_pembeli" => $nama_pembeli,
            ":jk" => $jk,
            ":alamat" => $alamat,
            ":telepon" => $telepon,
            ":id" => $id
        );

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

    public function deletePembeli($id)
    {
        $sql = "DELETE FROM Pembeli WHERE id = :id";
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

    public function getPembeliList()
    {
        $sql = 'SELECT * FROM Pembeli LIMIT 100';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM Pembeli';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function search($searchTerm)
    {
        $sql = "SELECT * FROM pembeli WHERE nama_pembeli LIKE :searchTerm";
        $params = array(":searchTerm" => "%" . $searchTerm . "%");


        $result = $this->db->executeQuery($sql, $params);
        return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
