<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="fas fa-users"></i> Daftar Anggota</h4>
    <a href="<?php echo BASE_URL; ?>/member/create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Anggota
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($members)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="fas fa-users fa-2x mb-2"></i><br>
                            Belum ada anggota yang terdaftar
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($members as $member): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($member['nama']); ?></td>
                            <td><?php echo htmlspecialchars($member['email']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $member['role'] === 'admin' ? 'primary' : 'secondary'; ?>">
                                    <?php echo ucfirst($member['role']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>/member/edit/<?php echo $member['id']; ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo BASE_URL; ?>/member/delete/<?php echo $member['id']; ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus anggota ini?')">
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