<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="fas fa-undo"></i> Kembalikan Buku</h4>
    <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5>Detail Peminjaman</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Buku:</strong> <?php echo htmlspecialchars($borrow['book_judul']); ?></p>
                <p><strong>Tanggal Pinjam:</strong> <?php echo date('d/m/Y', strtotime($borrow['tanggal_peminjaman'])); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Tanggal Kembali Target:</strong> <?php echo date('d/m/Y', strtotime($borrow['tanggal_kembali_target'])); ?></p>
                <p><strong>Status:</strong>
                    <?php
                    $today = date('Y-m-d');
                    if ($borrow['tanggal_kembali_target'] < $today) {
                        echo '<span class="badge bg-danger">Terlambat</span>';
                    } else {
                        echo '<span class="badge bg-warning">Aktif</span>';
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="kondisi" class="form-label">Kondisi Buku Saat Dikembalikan *</label>
                <select class="form-control" id="kondisi" name="kondisi" required>
                    <option value="">Pilih Kondisi</option>
                    <option value="baik">Baik</option>
                    <option value="rusak_ringan">Rusak Ringan</option>
                    <option value="rusak_berat">Rusak Berat</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i> Kembalikan Buku
                </button>
                <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>