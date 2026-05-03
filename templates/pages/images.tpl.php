<article class="pizza-card">
    <header class="mb-4 text-center border-bottom pb-3">
        <h2 class="section-title fs-2">Pizza Gallery</h2>
        <p class="text-muted">A collection of our delicious pizzas and happy moments.</p>
    </header>

    
    <?php if (!empty($upload_messages)): ?>
        <div class="alert alert-info shadow-sm">
            <ul class="mb-0">
                <?php foreach($upload_messages as $msg) echo "<li>" . htmlspecialchars($msg) . "</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <?php if (isset($_SESSION['login'])): ?>
        <div class="card shadow-sm mb-5 border-warning bg-light">
            <div class="card-body">
                <h4 class="h5 text-danger mb-3">📸 Upload a New Photo</h4>
                
                <form action="gallery" method="post" enctype="multipart/form-data" class="d-flex align-items-center flex-wrap gap-3">
                    <input type="file" name="new_image" class="form-control w-auto flex-grow-1" required accept="image/jpeg, image/png, image/gif">
                    <button type="submit" name="upload_submit" class="btn btn-success fw-bold px-4">Upload</button>
                </form>
                <small class="text-muted mt-2 d-block">Max size: 500KB. Formats allowed: JPG, PNG, GIF.</small>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="row g-4">
        <?php if (empty($gallery_images)): ?>
            <div class="col-12 text-center text-muted py-5">
                <p class="fs-5">No images in the gallery yet.</p>
            </div>
        <?php else: ?>
            <?php foreach ($gallery_images as $img): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden bg-white">
                        
                        <a href="<?= htmlspecialchars($img) ?>" target="_blank">
                            <img src="<?= htmlspecialchars($img) ?>" class="card-img-top" alt="Pizza Gallery Image" style="object-fit: cover; height: 200px; width: 100%; transition: transform 0.3s ease;">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</article>


<style>
    .card-img-top:hover {
        transform: scale(1.05); 
    }
</style>