<?php
include("../controllers/Transaksi.php");
include("../controllers/Transaksidetail.php");
include("../lib/functions.php");

$obj = new TransaksiController();
$detail = new TransaksidetailController();
$rows = $obj->gettransaksiList();

if (isset($_GET['tanggal_transaksis']) && !empty($_GET['tanggal_transaksis'])) {
    $criteria = [
        'tanggal_transaksis' => $_GET['tanggal_transaksis']
    ];
    $rows = $obj->filter($criteria);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Parfum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
        }
        .btn-print {
            display: block;
            margin: 20px 0;
            text-align: center;
        }
        .btn-print button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Laporan Transaksi Parfum</h1>
        <p>List semua transaksi parfum</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Beli</th>
                <th>Kode Pembeli</th>
                <th>Nama Pembeli</th>
                <th>Tanggal Transaksi</th>
                <th>Total Barang</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { 
                $total = $detail->countTransaksidetail($row['id']);
                $totalHarga = $detail->countTotalHarga($row['id']);
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["kode_beli"]; ?></td>
                <td><?php echo $row["kode_pembeli"]; ?></td>
                <td><?php echo $row["nama_pembeli"]; ?></td>
                <td><?php echo $row["tanggal_transaksi"]; ?></td>
                <td><?php echo $total; ?></td>
                <td><?php echo number_format($totalHarga, 2); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="btn-print">
        <button onclick="window.print()">Cetak Laporan</button>
    </div>
</div>

</body>
</html>
