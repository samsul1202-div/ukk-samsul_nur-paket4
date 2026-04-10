<style>
/* Dashboard User Styling */
.dashboard-user {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.borrow-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    margin-bottom: 20px;
    overflow: hidden;
}

.borrow-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}

.borrow-card .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border-radius: 15px 15px 0 0 !important;
    border: none;
    padding: 25px 30px;
    color: white;
}

.borrow-card .card-header h5 {
    margin: 0;
    font-weight: 600;
    font-size: 1.2rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.borrow-card .card-body {
    padding: 30px;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-state .fa-book-open {
    color: #ddd;
    margin-bottom: 20px;
    animation: float 3s ease-in-out infinite;
}

.empty-state p {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 25px;
}

.btn-borrow {
    background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
    border: none;
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
}

.btn-borrow:hover {
    background: linear-gradient(135deg, #00cec9 0%, #55a3ff 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 184, 148, 0.4);
}

.table-responsive {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.table {
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 15px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 15px;
    border-bottom: 1px solid #f8f9fa;
    vertical-align: middle;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.badge {
    font-size: 0.8rem;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 500;
}

.btn-return {
    background: linear-gradient(135deg, #e17055 0%, #d63031 100%);
    border: none;
    border-radius: 20px;
    padding: 6px 15px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-return:hover {
    background: linear-gradient(135deg, #d63031 0%, #b71540 100%);
    transform: translateY(-1px);
}

.quick-action-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.quick-action-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

.quick-action-card .card-header {
    border-radius: 15px 15px 0 0 !important;
    border: none;
    padding: 20px 25px;
    font-weight: 600;
}

.quick-action-card.search-card .card-header {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
    color: white;
}

.quick-action-card.history-card .card-header {
    background: linear-gradient(135deg, #636e72 0%, #2d3436 100%);
    color: white;
}

.quick-action-card .card-body {
    padding: 25px;
}

.quick-action-card .input-group .form-control {
    border-radius: 25px 0 0 25px;
    border: 2px solid #e9ecef;
    padding: 12px 20px;
    font-size: 1rem;
}

.quick-action-card .input-group .btn {
    border-radius: 0 25px 25px 0;
    padding: 12px 25px;
    font-weight: 600;
}

.btn-history {
    background: linear-gradient(135deg, #636e72 0%, #2d3436 100%);
    border: none;
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    color: white;
}

.btn-history:hover {
    background: linear-gradient(135deg, #2d3436 0%, #1e272e 100%);
    transform: translateY(-2px);
}

/* Animations */
@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.borrow-card, .quick-action-card {
    animation: fadeInUp 0.6s ease-out;
}

.borrow-card { animation-delay: 0.1s; }
.quick-action-card:nth-child(1) { animation-delay: 0.2s; }
.quick-action-card:nth-child(2) { animation-delay: 0.3s; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .dashboard-user {
        padding: 10px 0;
    }

    .borrow-card .card-body {
        padding: 20px 15px;
    }

    .quick-action-card .card-body {
        padding: 20px 15px;
    }

    .table-responsive {
        font-size: 0.9rem;
    }

    .table thead th,
    .table tbody td {
        padding: 10px;
    }
}
</style>

<div class="dashboard-user">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card borrow-card">
                    <div class="card-header bg-primary text-white">
                        <h5><i class="fas fa-book"></i> Buku yang Sedang Dipinjam</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($user_borrows)): ?>
                        <div class="empty-state">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Anda belum meminjam buku apapun.</p>
                            <a href="<?php echo BASE_URL; ?>/borrow/create" class="btn btn-borrow">
                                <i class="fas fa-plus"></i> Pinjam Buku
                            </a>
                        </div>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user_borrows as $borrow): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($borrow['book_judul']); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($borrow['tanggal_peminjaman'])); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($borrow['tanggal_kembali_target'])); ?></td>
                                        <td>
                                            <?php
                                            $today = date('Y-m-d');
                                            if ($borrow['tanggal_kembali_target'] < $today) {
                                                echo '<span class="badge bg-danger">Terlambat</span>';
                                            } else {
                                                echo '<span class="badge bg-warning">Aktif</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo BASE_URL; ?>/borrow/return/<?php echo $borrow['id']; ?>" class="btn btn-return btn-sm">
                                                <i class="fas fa-undo"></i> Kembalikan
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card quick-action-card search-card">
                    <div class="card-header">
                        <h5><i class="fas fa-search"></i> Pencarian Buku</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo BASE_URL; ?>/book/search" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Cari buku..." required>
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card quick-action-card history-card">
                    <div class="card-header">
                        <h5><i class="fas fa-history"></i> Riwayat Peminjaman</h5>
                    </div>
                    <div class="card-body">
                        <a href="<?php echo BASE_URL; ?>/borrow/history" class="btn btn-history">
                            <i class="fas fa-history"></i> Lihat Riwayat Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>