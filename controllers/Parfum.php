<?php
include_once('../models/ParfumModel.php');

class ParfumController
{
    private $model;

    public function __construct()
    {
        $this->model = new ParfumModel();
    }

    public function addParfum($kode_parfum, $nama_parfum, $merk, $harga, $stock)
    {
        return $this->model->addParfum($kode_parfum, $nama_parfum, $merk, $harga, $stock);
    }

    public function getParfum($id)
    {
        return $this->model->getParfum($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getParfum($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateParfum($id, $kode_parfum, $nama_parfum, $merk, $harga, $stock)
    {
        return $this->model->updateParfum($id, $kode_parfum, $nama_parfum, $merk, $harga, $stock);
    }

    public function deleteParfum($id)
    {
        return $this->model->deleteParfum($id);        
    }

    public function getParfumList()
    {
        return $this->model->getParfumList();
    }    
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }

    public function search($searchTerm)
    {
        return $this->model->search($searchTerm);
    }

    public function filter($criteria)
    {
        return $this ->model->filter($criteria);
    }

    public function updatefoto($id, $foto)
    {
        return $this->model->updatefoto($id, $foto);
    }
}
?>
