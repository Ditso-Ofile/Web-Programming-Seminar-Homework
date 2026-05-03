<article class="pizza-card">
    <header class="mb-4 text-center border-bottom pb-3">
        <h2 class="section-title fs-2">Pizza Menu Management (CRUD)</h2>
        <p class="text-muted">Create, Read, Update, and Delete pizzas from our database.</p>
    </header>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger shadow-sm border-danger">
            <strong>Error:</strong> <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if ($action === 'add' || $action === 'edit'): ?>
        
        
        <div class="card shadow-sm border-warning bg-light mx-auto" style="max-width: 600px;">
            <div class="card-body p-4">
                <h4 class="h5 text-danger mb-4 text-center">
                    <?= $action === 'add' ? '🍕 Add New Pizza' : '✏️ Edit Pizza: ' . htmlspecialchars($current_pizza['pname'] ?? '') ?>
                </h4>
                
                <form action="?table&action=<?= $action ?><?= $action === 'edit' ? '&id='.urlencode($_GET['id']) : '' ?>" method="post">
                    
                    <div class="mb-3">
                        <label for="pname" class="form-label fw-bold">Pizza Name (ID):</label>
                        <?php if ($action === 'add'): ?>
                            <input type="text" id="pname" name="pname" class="form-control" placeholder="e.g. Margherita" required>
                        <?php else: ?>
                            
                            <input type="text" id="pname" name="pname" class="form-control" value="<?= htmlspecialchars($current_pizza['pname'] ?? '') ?>" disabled>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="categoryname" class="form-label fw-bold">Category:</label>
                        <select id="categoryname" name="categoryname" class="form-select" required>
                            <option value="">Select a category...</option>
                            <?php foreach($categories as $cat): ?>
                                <?php $selected = ($action === 'edit' && $current_pizza['categoryname'] === $cat['cname']) ? 'selected' : ''; ?>
                                <option value="<?= htmlspecialchars($cat['cname']) ?>" <?= $selected ?>>
                                    <?= htmlspecialchars($cat['cname']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-4 form-check form-switch fs-5">
                        <?php $checked = ($action === 'edit' && $current_pizza['vegetarian']) ? 'checked' : ''; ?>
                        <input class="form-check-input" type="checkbox" id="vegetarian" name="vegetarian" value="1" <?= $checked ?>>
                        <label class="form-check-label fw-bold text-success" for="vegetarian">Vegetarian 🥬</label>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="?table" class="btn btn-secondary fw-bold px-4">Cancel</a>
                        <button type="submit" class="btn btn-success fw-bold px-4">Save Pizza</button>
                    </div>
                </form>
            </div>
        </div>

    <?php else: ?>
        
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="h5 text-success mb-0">Current Menu</h3>
            
            <a href="?table&action=add" class="btn btn-primary fw-bold shadow-sm">➕ Add New Pizza</a>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover mb-0 border bg-white">
                <thead style="background-color: #264653; color: #f1faee;">
                    <tr>
                        <th scope="col">Pizza Name (ID)</th>
                        <th scope="col">Category</th>
                        <th scope="col" class="text-center">Vegetarian</th>
                        <th scope="col" class="text-center" style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pizzas)): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">No pizzas found in the database.</td></tr>
                    <?php else: ?>
                        <?php foreach($pizzas as $p): ?>
                            <tr>
                                <td class="align-middle fw-bold text-danger"><?= htmlspecialchars($p['pname']) ?></td>
                                <td class="align-middle"><?= htmlspecialchars($p['categoryname']) ?></td>
                                <td class="align-middle text-center">
                                    <?= $p['vegetarian'] ? '<span class="badge bg-success fs-6">Yes 🥬</span>' : '<span class="badge bg-secondary fs-6">No 🥩</span>' ?>
                                </td>
                                <td class="align-middle text-center">
                                    
                                    <a href="?table&action=edit&id=<?= urlencode($p['pname']) ?>" class="btn btn-sm btn-warning fw-bold text-dark me-1 shadow-sm">Edit</a>
                                    
                                    <a href="?table&action=delete&id=<?= urlencode($p['pname']) ?>" class="btn btn-sm btn-danger fw-bold shadow-sm" onclick="return confirm('Are you sure you want to delete the pizza: <?= htmlspecialchars($p['pname']) ?>?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
    <?php endif; ?>
</article>