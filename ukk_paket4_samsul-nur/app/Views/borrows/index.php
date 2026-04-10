<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="fas fa-exchange-alt"></i> Kelola Peminjaman</h4>
    <a href="<?php echo BASE_URL; ?>/borrow/create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Peminjaman
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($borrows)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-exchange-alt fa-2x mb-2"></i><br>
                            Belum ada data peminjaman
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($borrows as $borrow): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($borrow['user_nama']); ?></td>
                            <td><?php echo htmlspecialchars($borrow['book_judul']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($borrow['tanggal_peminjaman'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($borrow['tanggal_kembali_target'])); ?></td>
                            <td>
                                <?php if ($borrow['status'] === 'returned'): ?>
                                    <span class="badge bg-success">Dikembalikan</span>
                                <?php else: ?>
                                    <?php
                                    $today = date('Y-m-d');
                                    if ($borrow['tanggal_kembali_target'] < $today) {
                                        echo '<span class="badge bg-danger">Terlambat</span>';
                                    } else {
                                        echo '<span class="badge bg-warning">Aktif</span>';
                                    }
                                    ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($borrow['status'] === 'active'): ?>
                                <a href="<?php echo BASE_URL; ?>/borrow/return/<?php echo $borrow['id']; ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-undo"></i> Kembalikan
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>