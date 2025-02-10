<?php
include("../controllers/Transaksi.php");
include("../controllers/Transaksidetail.php");
include("../lib/functions.php");
$obj = new TransaksiController();
$detail = new TransaksidetailController();
$rows = $obj->gettransaksiList();
$theme = setTheme();
getHeader($theme);

?>

<?php
if (isset($_GET['tanggal_transaksis']) && !empty($_GET['tanggal_transaksis'])) {
    $criteria = [
        'tanggal_transaksis' => $_GET['tanggal_transaksis']
    ];
    $rows = $obj->filter($criteria);
}
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Transaksi</strong> <small>List All Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;" />
<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Create New Data</a>

<div style="display: flex; flex-wrap: wrap; align-items: center;  ">
    <form method="GET" action="index.php" class="form-inline">
        <input type="date" name="tanggal_transaksis" class="form-control mb-2" value="<?php echo isset($_GET['tanggal_transaksis']) ? $_GET['tanggal_transaksis'] : ''; ?>">
        <button type="submit" class="btn btn-dark mb-2">Filter</button>
        <a href="laporan.php" class="btn btn-danger mb-2" style="margin-left: 10px;">
            <i class="fa fa-print"></i> Lihat Laporan
        </a>
</div>

<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th width="30">id</th>
            <th width="120">Kode Beli</th>
            <th width="120">Kode Pembeli</th>
            <th width="530">Nama Pembeli</th>
            <th width="150">Tanggal transaksi</th>
            <th width="140">Total Barang</th>
            <th width="140">Total Harga</th>
            <th width="240">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($rows as $row) {
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
                <td class="text-center" width="300">
                    <?php if ($row['dibeli'] == 0) { ?>
                        <a class="btn btn-warning btn-sm" href="edit.php?id=<?php echo $row['id']; ?>&iddetail=<?php echo $row['id']; ?>">
                            <i class="fa fa-pencil-alt"></i> Edit
                        </a>
                        <a class="btn btn-success btn-sm" href="detail.php?id=<?php echo $row['id']; ?>&iddetail=<?php echo $row['id']; ?>">
                            <i class="fa fa-briefcase"></i> Detail
                        </a>
                        <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>&iddetail=<?php echo $row['id']; ?>">
                            <i class="fa fa-trash"></i> Hapus
                        </a>

                    <?php } else { ?>
                        <a class="btn btn-info btn-sm" href="detail.php?id=<?php echo $row['id']; ?>&iddetail=<?php echo $row['id']; ?>">
                            <i class="fa fa-eye"></i> Lihat
                        </a>
                        <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>&iddetail=<?php echo $row['id']; ?>">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                <?php }
                } ?>
                </td>
            </tr>
            <?php  ?>
    </tbody>
</table>


<?php
getFooter($theme, '');
?>