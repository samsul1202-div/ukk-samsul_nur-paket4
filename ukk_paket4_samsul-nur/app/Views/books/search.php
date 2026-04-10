<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="fas fa-search"></i> Hasil Pencarian: "<?php echo htmlspecialchars($keyword); ?>"</h4>
    <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($books)): ?>
        <div class="text-center py-5">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Tidak ada buku ditemukan</h5>
            <p class="text-muted">Coba kata kunci yang berbeda</p>
            <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-primary">
                <i class="fas fa-home"></i> Kembali ke Dashboard
            </a>
        </div>
        <?php else: ?>
        <div class="row">
            <?php foreach ($books as $book): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($book['judul']); ?></h5>
                        <p class="card-text">
                            <strong>Pengarang:</strong> <?php echo htmlspecialchars($book['pengarang']); ?><br>
                            <strong>Penerbit:</strong> <?php echo htmlspecialchars($book['penerbit']); ?><br>
                            <strong>Kategori:</strong> <?php echo htmlspecialchars($book['kategori']); ?><br>
                            <strong>Stok:</strong>
                            <span class="badge bg-<?php echo $book['stok'] > 0 ? 'success' : 'danger'; ?>">
                                <?php echo $book['stok']; ?> tersedia
                            </span>
                        </p>
                        <?php if ($book['stok'] > 0 && isset($_SESSION['user_id'])): ?>
                        <a href="<?php echo BASE_URL; ?>/borrow/create?book_id=<?php echo $book['id']; ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-hand-holding"></i> Pinjam
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>