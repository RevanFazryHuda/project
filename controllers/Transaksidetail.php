<?php
include_once('../models/TransaksidetailModel.php');

class TransaksidetailController
{
    private $model;

    public function __construct()
    {
        $this->model = new TransaksidetailModel();
    }

    public function addTransaksidetail($transaksi_id, $kode_parfum, $jumlah)
    {
        return $this->model->addTransaksidetail($transaksi_id, $kode_parfum, $jumlah);
    }

    public function getTransaksidetail($id)
    {
        return $this->model->getTransaksidetail($id);
    }

    public function countTransaksidetail($id)
    {
        return $this->model->countTransaksidetail($id);
    }

    public function countTotalHarga($id)
    {
        return $this->model->countTotalHarga($id);
    }   

    public function Show($id)
    {
        $rows = $this->model->getTransaksidetail($id);
        foreach ($rows as $row) {
            $val = $row['kode_parfum'];
        }
        return $val;
    }

    public function updateTransaksidetail($id, $transaksi_id, $kode_parfum)
    {
        return $this->model->updateTransaksidetail($id, $transaksi_id, $kode_parfum);
    }

    public function deleteTransaksidetail($id)
    {
        return $this->model->deleteTransaksidetail($id);
    }

    public function getTransaksidetailList($id)
    {
        return $this->model->getTransaksidetailList($id);
    }

    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }

    public function penguranganStock($kode_buku, $transaksi_id)
    {
        return $this -> model -> penguranganStock($kode_buku, $transaksi_id);
    }
}
