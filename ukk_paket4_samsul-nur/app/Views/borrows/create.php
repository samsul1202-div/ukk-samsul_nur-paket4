<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="fas fa-plus"></i> Pinjam Buku</h4>
    <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-secondary">
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
                        <label for="user_id" class="form-label">Peminjam *</label>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="">Pilih Anggota</option>
                            <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php else: ?>
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <div class="form-control" style="background-color: #e9ecef;">
                            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="book_id" class="form-label">Buku *</label>
                        <select class="form-control" id="book_id" name="book_id" required>
                            <option value="">Pilih Buku</option>
                            <?php foreach ($books as $book): ?>
                            <option value="<?php echo $book['id']; ?>">
                                <?php echo htmlspecialchars($book['judul']); ?> (Stok: <?php echo $book['stok']; ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_kembali_target" class="form-label">Tanggal Kembali Target *</label>
                        <input type="date" class="form-control" id="tanggal_kembali_target" name="tanggal_kembali_target"
                               min="<?php echo date('Y-m-d'); ?>" required>
                        <div class="form-text">Maksimal 30 hari dari hari ini</div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Pinjam Buku
                </button>
                <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Set max date to 30 days from today
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 30);

    const dateInput = document.getElementById('tanggal_kembali_target');
    dateInput.max = maxDate.toISOString().split('T')[0];
});
</script>