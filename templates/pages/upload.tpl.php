<h2>Upload Photo</h2>

<?php if (!empty($upload_msg)): ?>
    <div style="padding: 10px; border: 2px solid <?= $upload_success ? 'green' : 'red' ?>; color: <?= $upload_success ? 'green' : 'red' ?>; margin-bottom: 20px;">
        <strong><?= $upload_msg ?></strong>
    </div>
<?php endif; ?>

<?php if (isset($uploaded_image_path)): ?>
    <div style="margin-bottom: 20px;">
        <img src="<?= $uploaded_image_path ?>" alt="Uploaded Image" style="max-width: 400px; border: 1px solid #000;">
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['login'])): ?>
    <form action="upload" method="post" enctype="multipart/form-data">
            <label>Select image payload:</label><br>
            <input type="file" name="fileToUpload" accept="image/png, image/jpeg, image/gif" required>
        </p>
        <p>
            <input type="submit" name="upload_submit" value="Execute Upload" style="padding: 5px 15px;">
        </p>
    </form>
<?php else: ?>
    <p>Authentication required. Access denied.</p>
<?php endif; ?>