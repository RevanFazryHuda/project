<?php
include_once('../models/TransaksiModel.php');

class TransaksiController
{
    private $model;

    public function __construct()
    {
        $this->model = new TransaksiModel();
    }

    public function addTransaksi($kode_beli, $kode_pembeli, $tanggal_transaksi)
    {
        return $this->model->addTransaksi($kode_beli, $kode_pembeli, $tanggal_transaksi);
    }

    public function getTransaksi($id)
    {
        return $this->model->getTransaksi($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getTransaksi($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateTransaksi($id, $kode_beli, $kode_pembeli, $tanggal_transaksi)
    {
        return $this->model->updateTransaksi($id, $kode_beli, $kode_pembeli, $tanggal_transaksi);
    }

    public function updateStatus($id, $status)
    {
        return $this->model->updateStatus($id, $status);
    }
 
    public function deleteTransaksi($id)
    {
        return $this->model->deleteTransaksi($id);
    }

    public function getTransaksiList()
    {
        return $this->model->getTransaksiList();
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }

    public function filter($criteria)
    {
        return $this->model->filter($criteria);
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
