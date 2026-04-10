<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="fas fa-history"></i> Riwayat Peminjaman</h4>
    <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali Target</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Status</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($borrows)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-history fa-2x mb-2"></i><br>
                            Belum ada riwayat peminjaman
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($borrows as $borrow): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($borrow['book_judul']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($borrow['tanggal_peminjaman'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($borrow['tanggal_kembali_target'])); ?></td>
                            <td>
                                <?php echo $borrow['tanggal_dikembalikan'] ? date('d/m/Y', strtotime($borrow['tanggal_dikembalikan'])) : '-'; ?>
                            </td>
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
                                <?php if ($borrow['kondisi']): ?>
                                    <span class="badge bg-<?php
                                        echo $borrow['kondisi'] === 'baik' ? 'success' :
                                             ($borrow['kondisi'] === 'rusak_ringan' ? 'warning' :
                                             ($borrow['kondisi'] === 'rusak_berat' ? 'danger' : 'dark'));
                                    ?>">
                                        <?php echo ucfirst(str_replace('_', ' ', $borrow['kondisi'])); ?>
                                    </span>
                                <?php else: ?>
                                    -
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