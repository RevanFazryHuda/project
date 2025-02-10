<?php
include("../controllers/Transaksidetail.php");
include("../controllers/Transaksi.php");
include("../controllers/Parfum.php");
include("../lib/functions.php");
$obj = new TransaksidetailController();
$myparfum = new ParfumController();
$parfums = $myparfum->getParfumList();
$theme = setTheme();
getHeader($theme);

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$msg = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaksi_id = $id;
    $kode_parfum = $_POST['kode_parfum'];
    $jumlah = $_POST['jumlah'];

    // Insert the record
    $dat = $obj->addTransaksidetail($transaksi_id, $kode_parfum, $jumlah);
    $msg = getJSON($dat);
}

?>

<?php
if ($msg === true) {
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'transaksi/detail.php?id=' . $id . '">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>';
}

?>

<div class="header icon-and-heading fs-1">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
    <h2><strong>Transaksi Detail</strong> <small>Add New Data</small> </h2>
</div>
<hr />

<form name="formAdd" method="POST" action="">
    <div class="form-group">
        <label>Jumlah Beli:</label>
        <input
            type="number"
            class="form-control mb-3"
            name="jumlah"
            min="1"
            required
            oninput="checkStockValidity(this)"
            disabled />
    </div>

    <div class="form-group">
        <label for="parfum">Select a Parfum:</label>
        <select class="form-control mb-3" name="kode_parfum" id="kode_parfum" required onchange="updateParfumDetails()">
            <option value="">Select a parfum...</option>
            <?php foreach ($parfums as $parfum): ?>
                <option value="<?php echo htmlspecialchars($parfum['kode_parfum']); ?>"
                    data-harga="<?php echo ($parfum['harga']); ?>"
                    data-stock="<?php echo ($parfum['stock']); ?>"
                    data-foto="<?php echo $parfum["foto"] != "" ? '../images/' . $parfum["foto"] : ''; ?>">
                    <?php echo htmlspecialchars($parfum['nama_parfum']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <div style="display: flex;" id="parfum-details" class="mt-3">
        <p id="harga" style="margin-right: 10px;"></p>
        <p id="stock"></p>
        <img id="foto" src="" alt="Selected Parfum"
            style="max-width: 250px; max-height: 250px;
             margin-left: 10px; display: none;" />
    </div>

    <script>
        function updateParfumDetails() {
            var select = document.getElementById("kode_parfum");
            var selectedOption = select.options[select.selectedIndex];

            var harga = selectedOption.getAttribute("data-harga");
            var stock = selectedOption.getAttribute("data-stock");
            var foto = selectedOption.getAttribute("data-foto");

            document.getElementById("harga").innerText = harga ? "Harga: " + harga : "";
            document.getElementById("stock").innerText = stock ? "Stock: " + stock : "";


            // Update the image source and display it
            var fotoElement = document.getElementById("foto");
            if (foto) {
                fotoElement.src = foto; // Set the src attribute to the image path
                fotoElement.style.display = "block"; // Show the image
            } else {
                fotoElement.src = ""; // Clear the src if no image
                fotoElement.style.display = "none"; // Hide the image
            }

            // Set stok maksimum untuk jumlah beli
            var jumlahInput = document.querySelector('input[name="jumlah"]');
            if (stock) {
                jumlahInput.setAttribute("max", stock);
                jumlahInput.removeAttribute("disabled");
            } else {
                jumlahInput.removeAttribute("max");
                jumlahInput.setAttribute("disabled", "disabled");
            }
        }

        document.querySelector('form[name="formAdd"]').addEventListener('submit', function(e) {
            var select = document.getElementById("kode_parfum");
            var selectedOption = select.options[select.selectedIndex];

            var stock = selectedOption.getAttribute("data-stock");
            var jumlah = document.querySelector('input[name="jumlah"]').value;

            if (stock == 0) {
                e.preventDefault();
                alert("Stok parfum habis. Tidak dapat menambahkan data.");
                return;
            }

            if (parseInt(jumlah) > parseInt(stock)) {
                e.preventDefault();
                alert("Jumlah beli melebihi stok yang tersedia.");
                return;
            }
        });

        function checkStockValidity(input) {
            var stock = document.getElementById("kode_parfum").selectedOptions[0].getAttribute("data-stock");
            if (stock && parseInt(input.value) > parseInt(stock)) {
                alert("Jumlah beli melebihi stok yang tersedia.");
                input.value = '0'; // Set nilai ke stok maksimal
            }
        }
    </script>

    <button class="save btn btn-large btn-info" type="submit" name="submit">Save</button>
    <a href="<?php echo base_url() . 'Transaksi/detail.php?id=' . $id; ?>" class="btn btn-large btn-warning">Cancel</a>
</form>

</body>

</html>

<?php
getFooter($theme, '');
?>