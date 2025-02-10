<?php

include_once('../db/database.php');

class ParfumModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addParfum($kode_parfum, $nama_parfum, $merk, $harga, $stock)
    {
        $sql = "INSERT INTO parfum (kode_parfum, nama_parfum, merk, harga, stock) VALUES (:kode_parfum, :nama_parfum, :merk, :harga, :stock)";
        $params = array(
          ":kode_parfum" => $kode_parfum,
          ":nama_parfum" => $nama_parfum,
          ":merk" => $merk,
          ":harga" => $harga,
          ":stock" => $stock
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

    public function getParfum($id)
    {
        $sql = "SELECT * FROM parfum WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateParfum($id, $kode_parfum, $nama_parfum, $merk, $harga, $stock)
    {
        $sql = "UPDATE parfum SET kode_parfum = :kode_parfum, nama_parfum = :nama_parfum, merk = :merk, harga = :harga, stock = :stock  WHERE id = :id";
        $params = array(
          ":kode_parfum" => $kode_parfum,
          ":nama_parfum" => $nama_parfum,
          ":merk" => $merk,
          ":harga" => $harga,
          ":stock" => $stock,
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
    
        // Return the reQsponse as JSON
        return json_encode($response);
    }
    

    public function deleteParfum($id)
    {
        $sql = "DELETE FROM parfum WHERE id = :id";
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

    public function getParfumList()
    {
        $sql = 'SELECT * FROM parfum limit 100';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM parfum';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function search($searchTerm)
    {
        $sql = "SELECT * FROM parfum WHERE nama_parfum LIKE :searchTerm";
        $params = array(":searchTerm" => "%" . $searchTerm . "%");


        $result = $this->db->executeQuery($sql, $params);
        return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function filter($criteria)
    {
        $conditions = [];
        $params = [];

        if (!empty($criteria['merk'])) {
            $conditions[] = "merk = :merk";
            $params[':merk'] = $criteria['merk'];
        }

        if (!empty($criteria['harga_min'])) {
            $conditions[] = "harga >= :harga_min";
            $params[':harga_min'] = $criteria['harga_min'];
        }

        if (!empty($criteria['harga_max'])) {
            $conditions[] = "harga <= :harga_max";
            $params[':harga_max'] = $criteria['harga_max'];
        }

        $sql = "SELECT * FROM parfum";
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $result = $this->db->executeQuery($sql, $params);
        return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function updatefoto($id, $foto)
    {
        $sql = "UPDATE parfum SET foto = :foto WHERE id = :id";
        $params = array(
          ":foto" => $foto,
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
}
