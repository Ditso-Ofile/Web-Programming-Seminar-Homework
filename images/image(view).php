<h2>Image Gallery</h2>

<?php if (isset($_SESSION['login'])): ?>
    <form action="index.php?page=images" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="upload_button">
    </form>
<?php endif; ?>

<hr>

<div class="gallery">
    <?php
    $folder = "images/";
    $images = glob($folder . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    
    foreach($images as $image) {
        echo '<img src="'.$image.'" style="width:200px; margin:10px;">';
    }
    ?>
</div>