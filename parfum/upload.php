<?php
include("../controllers/Parfum.php");
include("../lib/functions.php");
$obj = new ParfumController();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$rows = $obj->getParfum($id);
$theme = setTheme();
getHeader($theme);
?>

<?php
$base_url = getenv('BASE_URL'); 
?>
<script>
    const base_url = '<?php echo $base_url; ?>'; 
</script>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Parfum</strong> <small>Upload Data</small> </h2>
</div>
<hr />
<form name="uploadForm" id="uploadForm" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="submitted" value="1" />
    <dl class="row mt-1">
        <?php foreach ($rows as $row): ?>

            <dt class="col-sm-3">Id:</dt>
            <dd class="col-sm-9"><?php echo $row['id']; ?></dd>

            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>" readonly />

            <dt class="col-sm-3">Kode Parfum:</dt>
            <dd class="col-sm-9"><?php echo $row['kode_parfum']; ?></dd>

            <dt class="col-sm-3">Nama Parfum:</dt>
            <dd class="col-sm-9"><?php echo $row['nama_parfum']; ?></dd>

            <dt class="col-sm-3">Merk:</dt>
            <dd class="col-sm-9"><?php echo $row['merk']; ?></dd>

            <dt class="col-sm-3">Harga:</dt>
            <dd class="col-sm-9"><?php echo $row['harga']; ?></dd>

            <dt class="col-sm-3">Stock:</dt>
            <dd class="col-sm-9"><?php echo $row['stock']; ?></dd>

    </dl>
    <div id="uploadmessage"></div>
    <div class="form-group">
        <label>foto:</label>
        <input type="file" id="imageInput" name="foto" accept="image/*">
        <div class="preview-container">
            <img id="preview" src="" alt="Preview">
        </div>
    </div>
    <button class="save btn btn-large btn-info mt-3" type="submit">Upload</button>
    <a href="http://localhost/project/parfum/" class="btn btn-large btn-warning mt-3">Cancel</a>

<?php endforeach; ?>
</form>
<script>
    const form = document.getElementById('uploadForm');
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');
    const previewContainer = document.querySelector('.preview-container');
    const uploadmessage = document.getElementById('uploadmessage');

    // Preview image before upload
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Handle form submission

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('foto', imageInput.files[0]);
        const id = <?php echo json_encode($id); ?>; // Safely embed PHP variable
        const url = `../lib/uploadfoto.php?id=${id}`;
        fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    uploadmessage.textContent = 'Image uploaded successfully!';
                    uploadmessage.style.color = 'green';
                    setTimeout(() => {
                        window.location.href = base_url + '/project/parfum';
                    }, 1000);
                } else {
                    uploadmessage.textContent = 'Upload failed: ' + data.message;
                    uploadmessage.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                uploadmessage.textContent = 'Upload failed!';
                uploadmessage.style.color = 'red';
            });
    });
</script>

<?php
getFooter($theme, "");
?>