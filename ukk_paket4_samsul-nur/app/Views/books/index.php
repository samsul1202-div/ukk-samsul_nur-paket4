<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="fas fa-book"></i> Daftar Buku</h4>
    <a href="<?php echo BASE_URL; ?>/book/create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Buku
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($books)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-book-open fa-2x mb-2"></i><br>
                            Belum ada buku yang terdaftar
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($book['judul']); ?></td>
                            <td><?php echo htmlspecialchars($book['pengarang']); ?></td>
                            <td><?php echo htmlspecialchars($book['penerbit']); ?></td>
                            <td><?php echo htmlspecialchars($book['kategori']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $book['stok'] > 0 ? 'success' : 'danger'; ?>">
                                    <?php echo $book['stok']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>/book/edit/<?php echo $book['id']; ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo BASE_URL; ?>/book/delete/<?php echo $book['id']; ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>