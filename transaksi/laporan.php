<?php
include("../controllers/Transaksi.php");
include("../controllers/Transaksidetail.php");
include("../lib/functions.php");
$obj = new TransaksiController();
$detail = new TransaksidetailController();
$rows = $obj->gettransaksiList();
$theme = setTheme();
getHeader($theme);

if (isset($_GET['tanggal_transaksis']) && !empty($_GET['tanggal_transaksis'])) {
    $criteria = [
        'tanggal_transaksis' => $_GET['tanggal_transaksis']
    ];
    $rows = $obj->filter($criteria);
}

?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-print zmdi-hc-4x custom-icon"></i>
    <h2><strong>Laporan Penjualan Parfum</strong></h2>
</div>
<hr style="margin-bottom:-2px;"/>

<!-- Tombol untuk mengunduh PDF -->
<button id="downloadPDF" class="btn btn-success fa fa-print mt-3 mb-2"> Cetak Laporan</button>
<div style="display: flex; flex-wrap: wrap; align-items: center;  ">
    <form method="GET" action="laporan.php" class="form-inline">
        <input type="date" name="tanggal_transaksis" class="form-control mb-2" value="<?php echo isset($_GET['tanggal_transaksis']) ? $_GET['tanggal_transaksis'] : ''; ?>">
        <button type="submit" class="btn btn-info mb-3">Filter</button>
</div>


<!-- Tampilkan Laporan -->
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Beli</th>
            <th width="180">Kode Pembeli</th>
            <th width="330">Nama Pembeli</th>            
            <th width="180">Tanggal Transaksi</th>
            <th width="180">Total Barang</th>
            <th width="240">Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): 
                $total = $detail->countTransaksidetail($row['id']); 
                $totalHarga = $detail->countTotalHarga($row['id']); 
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["kode_beli"]); ?></td>
                    <td><?php echo htmlspecialchars($row["kode_pembeli"]); ?></td>
                    <td><?php echo htmlspecialchars($row["nama_pembeli"]); ?></td>
                    <td><?php echo htmlspecialchars($row["tanggal_transaksi"]); ?></td>
                    <td><?php echo htmlspecialchars($total); ?></td>
                    <td><?php echo number_format($totalHarga, 2); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No data found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="http://localhost/project/transaksi/" class="btn btn-large btn-warning">Back</a>

<!-- Memuat jsPDF dari CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

<script>
    document.getElementById('downloadPDF').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Tambahkan logo di sebelah kiri atas
        const logoUrl = '../themes/minia/assets/images/logo.png'; // Ganti dengan path logo Anda
        const logoWidth = 30; // Lebar logo
        const logoHeight = 15; // Tinggi logo
        doc.addImage(logoUrl, 'PNG', 15, 10, logoWidth, logoHeight);

        // Tambahkan tanggal cetak di sebelah kanan atas
        const currentDate = new Date().toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
        doc.setFontSize(10);
        doc.text(`Dicetak pada: ${currentDate}`, 195, 28, { align: 'right' });

        // Menambahkan judul laporan di bawah logo
        doc.setFontSize(16);
        doc.text("Laporan Penjualan Parfum", 70, 22);

        // Mendapatkan data tabel
        const table = document.querySelector("table");
        const rows = table.querySelectorAll("tr");
        let y = 30; // Posisi vertikal awal untuk menulis tabel

        // Menulis header tabel
        const headers = rows[0].querySelectorAll("th");
        let headerArray = [];
        headers.forEach(header => headerArray.push(header.textContent.trim()));

        // Menentukan lebar kolom berdasarkan lebar tabel HTML
        const columnStyles = {};
        headers.forEach((header, index) => {
            const width = header.offsetWidth; // Ambil lebar kolom dari tabel HTML
            columnStyles[index] = { cellWidth: width * 0.113 }; // Sesuaikan faktor skala sesuai kebutuhan
        });

        // Menulis header dan data tabel
        const body = [];
        rows.forEach((row, index) => {
            if (index > 0) { // Lewati baris pertama (header)
                const cols = row.querySelectorAll("td");
                let rowData = [];
                cols.forEach(col => rowData.push(col.textContent.trim()));
                body.push(rowData);
            }
        });

        // Tambahkan data tabel ke PDF
        doc.autoTable({
            head: [headerArray],
            body: body,
            startY: y,
            theme: 'grid',
            styles: { fontSize: 10, cellPadding: 2 },
            headStyles: { fillColor: [22, 160, 133] }, // Warna header tabel
            columnStyles: columnStyles, // Menggunakan lebar kolom yang konsisten
            alternateRowStyles: { fillColor: [245, 245, 245] } // Warna alternatif untuk baris
        });

        // Menyimpan PDF
        doc.save('laporan_Penjualan.pdf');
    });
</script>

<?php
getFooter($theme, "");
?>