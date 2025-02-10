<?php
include("../controllers/Parfum.php");
include("../lib/functions.php");
$obj = new ParfumController();
$rows = $obj->getParfumList();
$theme = setTheme();
getHeader($theme);
?>
<?php
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $rows = $obj->search($_GET['search']);
} elseif (isset($_GET['merk']) || isset($_GET['harga_min']) || isset($_GET['harga_max'])) {
    $criteria = [
        'merk' => $_GET['merk'] ?? '',
        'harga_min' => $_GET['harga_min'] ?? '',
        'harga_max' => $_GET['harga_max'] ?? ''
    ];
    $rows = $obj->filter($criteria);
}
?>


<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Parfum</strong> <small>List All Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;" />
<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Create New Data</a>

<div style="display: flex; flex-wrap: wrap; align-items: center; margin-bottom: 20px; ">
    <form method="GET" action="index.php" class="form-inline" style=" margin-right: 930px;">
        <input type="text" name="search" placeholder="Search Parfum..." class="form-control mb-2" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="btn btn-primary mb-2">Search</button>
    </form>

    <form method="GET" action="index.php" class="form-inline">
        <input type="text" name="merk" placeholder="Filter by Merk" class="form-control mb-2" value="<?php echo isset($_GET['merk']) ? $_GET['merk'] : ''; ?>">
        <div style="display: flex; align-items: center; ">
            <input type="number" name="harga_min" placeholder="Min Price" class="form-control mb-2" style="margin-right: 10px;" value="<?php echo isset($_GET['harga_min']) ? $_GET['harga_min'] : ''; ?>">
            <input type="number" name="harga_max" placeholder="Max Price" class="form-control mb-2" value="<?php echo isset($_GET['harga_max']) ? $_GET['harga_max'] : ''; ?>">
        </div>
        <button type="submit" class="btn btn-success mb-2">Filter</button>
    </form>
</div>

<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th>id</th>
            <th>Kode Parfum</th>
            <th>Nama Parfum</th>
            <th width="330">Merk</th>
            <th width="180">Harga</th>
            <th>Stock</th>
            <th>foto</th>
            <th width="260">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["kode_parfum"]; ?></td>
                <td><?php echo $row["nama_parfum"]; ?></td>
                <td><?php echo $row["merk"]; ?></td>
                <td><?php echo $row["harga"]; ?></td>
                <td><?php echo $row["stock"]; ?></td>
                <td><?php
                    if ($row["foto"] != "") {
                        echo '<img src="../images/' . $row["foto"] . '" alt="Uploaded Image" style="max-width: 100px; max-height: 100px; object-fit: cover;">';
                    } else {
                        echo '&nbsp;';
                    }
                    ?></td>
                <td class="text-center" width="200">
                    <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-pencil-alt"></i> Edit
                    </a>
                    <a class="btn btn-success btn-sm" href="upload.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-camera"></i>
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