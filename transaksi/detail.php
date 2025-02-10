<?php
include("../controllers/Transaksidetail.php");
include("../controllers/Transaksi.php");
include("../lib/functions.php");
$transaksi = new TransaksiController();
$detail = new TransaksidetailController();
$theme = setTheme();
getHeader($theme);

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$msg = null;
if (isset($_POST["submitted"]) == 1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = true;
    // Ambil detail transaksi
    $detailRows = $detail->getTransaksidetailList($id);

    // Loop melalui detail transaksi untuk mengurangi stok
    foreach ($detailRows as $row) {
        $kode_parfum = $row['kode_parfum'];
        $detail->penguranganStock($kode_parfum, $id);
    }

    $dat = $transaksi->updateStatus($id, $status);
    $msg = getJSON($dat);
}

$transaksiData = $transaksi->getTransaksi($id);
$detailRows = $detail->getTransaksidetailList($id);
$totalDetail = $detail->countTransaksidetail($id);
$totalHarga = $detail->countTotalHarga($id);
?>

<?php
if ($msg === true) {
    echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'transaksi/detail.php?id=' . $id . '">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>';
}
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Transaksi Detail</strong> <small>List Semua Data</small> </h2>
</div>

<dl class="row mt-3">
    <?php foreach ($transaksiData as $data): ?>
        <dt class="col-sm-3" style="margin-left:50px">ID Transaksi:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $data['id']; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Kode Beli:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $data['kode_beli']; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Kode Pembeli:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $data['kode_pembeli']; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Tanggal Transaksi:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $data['tanggal_transaksi']; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Total Item:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $totalDetail; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Total Harga:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo number_format($totalHarga, 2); ?></dd>
    <?php endforeach; ?>
</dl>

<?php
if (!empty($transaksiData) && is_array($transaksiData)) {
    foreach ($transaksiData as $data) {
        // Konten asli looping
    }
} else {
    echo "<p>Data transaksi tidak ditemukan.</p>";
}
?>

<hr style="margin-bottom:-2px;" />
<?php
if ($data['dibeli'] == 0) {
    echo '<a style="margin:10px 0px;" class="btn btn-large btn-info" href="detailadd.php?id=' . $id . '"><i class="fa fa-plus"></i> Tambah Data</a>';
}
?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="30">No</th>
            <th width="110">Kode Parfum</th>
            <th width="250">Nama Parfum</th>
            <th width="250">Merk</th>
            <th width="300">Harga Satuan</th>
            <th width="30">Total</th>
            <?php if ($data['dibeli'] == 0): ?>
                <th width="140">Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($detailRows as $row): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row["kode_parfum"]; ?></td>
                <td><?php echo $row["nama_parfum"]; ?></td>
                <td><?php echo $row["merk"]; ?></td>
                <td><?php echo number_format($row["harga"] ?? 0, 2); ?></td>
                <td><?php echo $row["jumlah"]; ?></td>
                <?php if ($data['dibeli'] == 0): ?>
                    <td class="text-center" width="200">
                        <a class="btn btn-danger btn-sm" href="detaildelete.php?id=<?php echo $id; ?>&iddetail=<?php echo $row['id']; ?>">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php
            $i++;
        endforeach; ?>
    </tbody>
</table>

<form name="formStatus" method="POST" action="">
    <input type="hidden" class="form-control" name="submitted" value="1" />
    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" />
    <div class="d-flex justify-content-end">
        <?php
        // Tampilkan tombol hanya jika barang belum dibeli
        if (isset($data['dibeli']) && $data['dibeli'] == 0) {
            echo '<button class="save btn btn-large btn-success" type="submit"><i class="fa fa-handshake"></i> Submit</button>';
        }
        ?>
    </div>
    <a href="http://localhost/project/transaksi" class="btn btn-large btn-warning">Back</a>
</form>


<?php
getFooter($theme, '');
?>