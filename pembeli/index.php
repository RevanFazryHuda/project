<?php
include("../controllers/Pembeli.php");
include("../lib/functions.php");
$obj = new PembeliController();
$rows = $obj->getPembeliList();
$theme = setTheme();
getHeader($theme);
?>
<?php
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $rows = $obj->search($_GET['search']);
}
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Pembeli</strong> <small>List All Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;" />
<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Create New Data</a>

<div style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 20px; ">
    <form method="GET" action="index.php" class="form-inline" style=" margin-right: 930px;">
        <input type="text" name="search" placeholder="Search Pembeli..." class="form-control mb-2" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="btn btn-primary mb-2">Search</button>
    </form>
</div>

<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th>id</th>
            <th>Kode Pembeli</th>
            <th>Nama Pembeli</th>
            <th width="50">jenis Kelamin</th>
            <th width="330">alamat</th>
            <th width="180">telepon</th>
            <th width="240">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["kode_pembeli"]; ?></td>
                <td><?php echo $row["nama_pembeli"]; ?></td>
                <td><?php echo $row["jk"]; ?></td>
                <td><?php echo $row["alamat"]; ?></td>
                <td><?php echo $row["telepon"]; ?></td>
                <td class="text-center" width="200">
                    <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-pencil-alt"></i> Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-trash"></i> Hapus
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
getFooter($theme, '');
?>