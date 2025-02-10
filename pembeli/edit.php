<?php
include("../controllers/Pembeli.php");
include("../lib/functions.php");
$obj = new PembeliController();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$msg = null;
if (isset($_POST["submitted"]) == 1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $kode_pembeli = $_POST['kode_pembeli'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    // Update the database record using your controller's method
    $dat = $obj->updatepembeli($id, $kode_pembeli, $nama_pembeli, $jk, $alamat, $telepon);
    $msg = getJSON($dat);
}
$rows = $obj->getPembeli($id);
$theme = setTheme();
getHeader($theme);
?>

<?php
if ($msg === true) {
    echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'pembeli/">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>';
} else {
}

?>
<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>pembeli</strong> <small>Edit Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;" />
<form name="formEdit" method="POST" action="">
    <input type="hidden" class="form-control" name="submitted" value="1" />
    <?php foreach ($rows as $row): ?>

        <div class="form-group">
            <label>Id:</label>
            <input type="text" class="form-control" id="id" name="id"
                value="<?php echo $row['id']; ?>" readonly />
        </div>

        <div class="form-group mt-3">
            <label>Kode Pembeli:</label>
            <input type="text" class="form-control" id="kode_pembeli" name="kode_pembeli"
                value="<?php echo $row['kode_pembeli']; ?>" />
        </div>

        <div class="form-group mt-3">
            <label>Nama Pembeli:</label>
            <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli"
                value="<?php echo $row['nama_pembeli']; ?>" />
        </div>

        <div class="form-group mt-3">
            <label>Jenis kelamin:</label>
            <select id="jk" name="jk" style="width:150px"
                class="form-control show-tick" required>
                <option value="<?php echo $row['jk']; ?>">
                    <?php echo $row['jk']; ?></option>
                <option value="L">L</option>
                <option value="P">P</option>
            </select>
        </div>

        <div class="form-group mt-3">
            <label>Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat"
                value="<?php echo $row['alamat']; ?>" />
        </div>

        <div class="form-group mt-3">
            <label>Telepon:</label>
            <input type="text" class="form-control" id="telepon" name="telepon"
                value="<?php echo $row['telepon']; ?>" />
        </div>

    <?php endforeach; ?>
    <div class="form-group mt-3">
        <button class="save btn btn-large btn-info" type="submit">Save</button>
        <a href="http://localhost/project/pembeli/" class="btn btn-large btn-warning">Cancel</a>
    </div>
</form>


<?php
getFooter($theme, '');
?>