<?php
include("../controllers/Transaksi.php");
include("../controllers/Pembeli.php");
include("../lib/functions.php");
$obj = new TransaksiController();
$pembeli = new PembeliController();
$list = $pembeli->getPembeliList();
$theme = setTheme();
getHeader($theme);

$msg = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $kode_beli = $_POST['kode_beli'];
    $kode_pembeli = $_POST['kode_pembeli'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];

    // Insert the database record using your controller's method
    $dat = $obj->addtransaksi($kode_beli, $kode_pembeli, $tanggal_transaksi);
    $msg = getJSON($dat);
}
$nomorbeli = generateRandomString();
?>

<?php
if ($msg === true) {
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'transaksi/">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>';
} else {
}

?>
<div class="header icon-and-heading fs-1">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
    <h2><strong>Transaksi</strong> <small>Add New Data</small> </h2>
</div>
<hr />
<form name="formAdd" method="POST" action="">

    <div class="form-group">
        <label>Kode_beli:</label>
        <div class="input-group">
            <input type="text" class="form-control" name="kode_beli" value="<?php echo $nomorbeli; ?>" readonly="readonly" />

        </div>
    </div>


    <div class="form-group mt-3">
        <label>kode_pembeli:</label>

        <select class="form-control" name="kode_pembeli" id="kode_pembeli">
            <option value="">Pilih Pembeli...</option>
            <?php foreach ($list as $ang): ?>
                <option value="<?php echo htmlspecialchars($ang['kode_pembeli']); ?>">
                    <?php echo htmlspecialchars($ang['kode_pembeli']) . ' - ' . htmlspecialchars($ang['nama_pembeli']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group mt-3 mb-3">
        <label>Tanggal_transaksi:</label>
        <input type="date" class="form-control" name="tanggal_transaksi" />
    </div>


    <button class="save btn btn-large btn-info" type="submit">Save</button>
    <a href="http://localhost/project/transaksi/" class="btn btn-large btn-warning">Cancel</a>
</form>

<?php
getFooter($theme, '');
?>