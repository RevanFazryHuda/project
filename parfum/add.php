<?php
include("../controllers/Parfum.php");
include("../lib/functions.php");
$obj = new ParfumController();
$msg = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $kode_parfum = $_POST['kode_parfum'];
    $nama_parfum = $_POST['nama_parfum'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    // Insert the database record using your controller's method
    $dat = $obj->addparfum($kode_parfum, $nama_parfum, $merk, $harga, $stock);
    $msg = getJSON($dat);
}
$theme = setTheme();
getHeader($theme);
?>

<?php
if ($msg === true) {
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'parfum/">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>';
} else {
}

?>
<div class="header icon-and-heading fs-1">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
    <h2><strong>Parfum</strong> <small>Add New Data</small> </h2>
</div>
<hr />
<form name="formAdd" method="POST" action="">

    <div class="form-group mt-3">
        <label>Kode Parfum:</label>
        <input type="text" class="form-control" name="kode_parfum" />
    </div>

    <div class="form-group mt-3">
        <label>Nama Parfum:</label>
        <input type="text" class="form-control" name="nama_parfum" />
    </div>

    <div class="form-group mt-3">
        <label>Merk:</label>
        <input type="text" class="form-control" name="merk" />
    </div>

    <div class="form-group mt-3">
        <label>Harga:</label>
        <input type="text" class="form-control" name="harga" />
    </div>

    <div class="form-group mt-3">
        <label>Stock:</label>
        <input type="text" class="form-control" name="stock" />
    </div>

    <div class="form-group mt-3">
        <button class="save btn btn-large btn-info " type="submit">Save</button>
        <a href="http://localhost/project/parfum/" class="btn btn-large btn-warning ">Cancel</a>
    </div>

</form>

<?php
getFooter($theme, '');
?>