<?php

include_once('db/database.php');

class LoginModel
{
    private $db;
                         
    public function __construct()
    {
        $this->db = new Database();
    }

    public function login_validation($username, $password) {

        $sql = "SELECT id, username, nama, password, role FROM users WHERE username = :username";
        $params = array(":username" => $username);
        $stmt = $this->db->executeQuery($sql, $params);
        
        if ($stmt !== false && !empty($stmt))  {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];
            $nama = $row['nama'];
            $role = $row['role'];
    
            if (password_verify($password, $hashed_password)) { // verify passwords
                $_SESSION['nama'] = $nama;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                $response = array(
                    "success" => true,
                    "message" => "Login successful"
                );
            } else {
                $response = array(
                    "success" => false,
                    "message" => "Invalid password",
                    "query" => $stmt
                );
            }
        } else {
            $response = array(
                "success" => false,
                "message" => "User not found"
            );
        }
        
        return json_encode($response);
    }
    public function addUsers($username,$nama,$password)
    {
        $sql = "INSERT INTO users (username, nama, password) VALUES (:username,:nama,:password)";
        $pwd = password_hash($password, PASSWORD_BCRYPT);
        $params = array(
          ":username" => $username,
          ":nama" => $nama,
          ":password" => $pwd,
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
}
