<?php
include("../controllers/Pembeli.php");
include("../lib/functions.php");
$obj = new PembeliController();
$msg = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $kode_pembeli = $_POST['kode_pembeli'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    // Insert the database record using your controller's method
    $dat = $obj->addpembeli($kode_pembeli, $nama_pembeli, $jk, $alamat, $telepon);
    $msg = getJSON($dat);
}
$theme = setTheme();
getHeader($theme);
?>

<?php
if ($msg === true) {
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'pembeli">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>';
} else {
}

?>
<div class="header icon-and-heading fs-1">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
    <h2><strong>Pembeli</strong> <small>Add New Data</small> </h2>
</div>
<hr />
<form name="formAdd" method="POST" action="">

    <div class="form-group">
        <label>Kode Pembeli:</label>
        <input type="text" class="form-control" name="kode_pembeli" />
    </div>

    <div class="form-group mt-3">
        <label>Nama Pembeli:</label>
        <input type="text" class="form-control" name="nama_pembeli" />
    </div>

    <div class="form-group mt-3">
        <label>Jenis kelamin:</label>
        <select id="jk" name="jk" style="width:150px" class="form-control">
            <option value="">--pilih--</option>
            <option value="L">L</option>
            <option value="P">P</option>
        </select>
    </div>

    <div class="form-group mt-3">
        <label>Alamat:</label>
        <input type="text" class="form-control" name="alamat" />
    </div>

    <div class="form-group mt-3">
        <label>Telepon:</label>
        <input type="text" class="form-control" name="telepon" />
    </div>

    <div class="form-group mt-3">
        <button class="save btn btn-large btn-info " type="submit">Save</button>
        <a href="http://localhost/project/pembeli/" class="btn btn-large btn-warning ">Cancel</a>
    </div>

</form>

<?php
getFooter($theme, '');
?>