<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="fas fa-edit"></i> Edit Buku</h4>
    <a href="<?php echo BASE_URL; ?>/book" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku *</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                               value="<?php echo htmlspecialchars($book['judul']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang *</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang"
                               value="<?php echo htmlspecialchars($book['pengarang']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit *</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit"
                               value="<?php echo htmlspecialchars($book['penerbit']); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn"
                               value="<?php echo htmlspecialchars($book['isbn']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                               value="<?php echo $book['tahun_terbit']; ?>" min="1900" max="<?php echo date('Y'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori *</label>
                        <select class="form-control" id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Fiksi" <?php echo $book['kategori'] === 'Fiksi' ? 'selected' : ''; ?>>Fiksi</option>
                            <option value="Non-Fiksi" <?php echo $book['kategori'] === 'Non-Fiksi' ? 'selected' : ''; ?>>Non-Fiksi</option>
                            <option value="Pendidikan" <?php echo $book['kategori'] === 'Pendidikan' ? 'selected' : ''; ?>>Pendidikan</option>
                            <option value="Teknologi" <?php echo $book['kategori'] === 'Teknologi' ? 'selected' : ''; ?>>Teknologi</option>
                            <option value="Sejarah" <?php echo $book['kategori'] === 'Sejarah' ? 'selected' : ''; ?>>Sejarah</option>
                            <option value="Biografi" <?php echo $book['kategori'] === 'Biografi' ? 'selected' : ''; ?>>Biografi</option>
                            <option value="Lainnya" <?php echo $book['kategori'] === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok *</label>
                        <input type="number" class="form-control" id="stok" name="stok"
                               value="<?php echo $book['stok']; ?>" min="0" required>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="<?php echo BASE_URL; ?>/book" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>