<?php
include("../controllers/Transaksi.php");
include("../lib/functions.php");
$obj = new TransaksiController();
$theme = setTheme();
getHeader($theme);

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$msg = null;
if (isset($_POST["submitted"]) == 1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $kode_beli = $_POST['kode_beli'];
    $kode_pembeli = $_POST['kode_pembeli'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    // Update the database record using your controller's method
    $dat = $obj->updatetransaksi($id, $kode_beli, $kode_pembeli, $tanggal_transaksi);
    $msg = getJSON($dat);
}
$rows = $obj->getTransaksi($id);

?>

<?php
if ($msg === true) {
    echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'transaksi/">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>';
} else {
}

?>
<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Transaksi</strong> <small>Edit Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;" />
<form name="formEdit" method="POST" action="">
    <input type="hidden" class="form-control" name="submitted" value="1" />
    <?php foreach ($rows as $row): ?>

        <div class="form-group">
            <label>id:</label>
            <input type="text" class="form-control" id="id" name="id"
                value="<?php echo $row['id']; ?>" readonly />
        </div>

        <div class="form-group">
            <label>kode_beli:</label>
            <input type="text" class="form-control" id="kode_beli" name="kode_beli"
                value="<?php echo $row['kode_beli']; ?>" />
        </div>

        <div class="form-group">
            <label>kode_pembeli:</label>
            <input type="text" class="form-control" id="kode_pembeli" name="kode_pembeli"
                value="<?php echo $row['kode_pembeli']; ?>" />
        </div>

        <div class="form-group">
            <label>tanggal_transaksi:</label>
            <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi"
                value="<?php echo $row['tanggal_transaksi']; ?>" />
        </div>


    <?php endforeach; ?>
    <div class="form-group mt-3">
        <button class="save btn btn-large btn-info" type="submit">Save</button>
        <a href="http://localhost/project/transaksi/" class="btn btn-large btn-warning">Cancel</a>
    </div>
</form>


<?php
getFooter($theme, '');
?>