<?php
include("../controllers/Parfum.php");
include("../lib/functions.php");
$obj = new ParfumController();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$msg = null;
if (isset($_POST["submitted"]) == 1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $kode_parfum = $_POST['kode_parfum'];
    $nama_parfum = $_POST['nama_parfum'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    
    // Update the database record using your controller's method
    $dat = $obj->updateparfum($id, $kode_parfum, $nama_parfum, $merk, $harga, $stock);
    $msg = getJSON($dat);
}
$rows = $obj->getParfum($id);
$theme = setTheme();
getHeader($theme);
?>

<?php
if ($msg === true) {
    echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'parfum/">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>';
} else {
}

?>
<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Parfum</strong> <small>Edit Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;" />
<form name="formEdit" method="POST" action="">
    <input type="hidden" class="form-control" name="submitted" value="1" />
    <?php foreach ($rows as $row): ?>

        <div class="form-group mt-3">
            <label>ID:</label>
            <input type="text" class="form-control" id="id" name="id"
                value="<?php echo $row['id']; ?>" readonly />
        </div>

        <div class="form-group mt-3">
            <label>Kode Parfum:</label>
            <input type="text" class="form-control" id="kode_parfum" name="kode_parfum"
                value="<?php echo $row['kode_parfum']; ?>" />
        </div>

        <div class="form-group mt-3">
            <label>Nama Parfum:</label>
            <input type="text" class="form-control" id="nama_parfum" name="nama_parfum"
                value="<?php echo $row['nama_parfum']; ?>" />
        </div>

        <div class="form-group mt-3">
            <label>Merk:</label>
            <input type="text" class="form-control" id="merk" name="merk"
                value="<?php echo $row['merk']; ?>" />
        </div>

        <div class="form-group mt-3">
            <label>Harga:</label>
            <input type="text" class="form-control" id="harga" name="harga"
                value="<?php echo $row['harga']; ?>" />
        </div>

        <div class="form-group mt-3">
            <label>Stock:</label>
            <input type="text" class="form-control" id="stock" name="stock"
                value="<?php echo $row['stock']; ?>" />
        </div>

    <?php endforeach ?>
    <div class="form-group mt-3">
        <button class="save btn btn-large btn-info" type="submit">Save</button>
        <a href="http://localhost/project/parfum/" class="btn btn-large btn-warning">Cancel</a>
    </div>
</form>

<?php
getFooter($theme, '');
?>