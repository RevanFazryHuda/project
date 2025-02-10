<?php
include_once('../models/PembeliModel.php');

class PembeliController
{
    private $model;

    public function __construct()
    {
        $this->model = new PembeliModel();
    }

    public function addPembeli($kode_pembeli, $nama_pembeli, $jk, $alamat, $telepon)
    {
        return $this->model->addPembeli($kode_pembeli, $nama_pembeli, $jk, $alamat, $telepon);
    }

    public function getPembeli($id)
    {
        return $this->model->getPembeli($id);
    }

    public function showPembeli($id)
    {
        $rows = $this->model->getPembeli($id);
        foreach ($rows as $row) {
            $val = $row['nama_pembeli'];
        }
        return $val;
    }

    public function updatePembeli($id, $kode_pembeli, $nama_pembeli, $jk, $alamat, $telepon)
    {
        return $this->model->updatePembeli($id, $kode_pembeli, $nama_pembeli, $jk, $alamat, $telepon);
    }

    public function deletePembeli($id)
    {
        return $this->model->deletePembeli($id);
    }

    public function getPembeliList()
    {
        return $this->model->getPembeliList();
    }

    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }

    public function search($searchTerm)
    {
        return $this->model->search($searchTerm);
    }
}

