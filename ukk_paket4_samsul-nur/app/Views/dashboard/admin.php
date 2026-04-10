<style>
/* Dashboard Admin Styling */
.dashboard-admin {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.stats-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, rgba(255,255,255,0.8), rgba(255,255,255,0.4));
}

.stats-card.bg-info {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%) !important;
}

.stats-card.bg-primary {
    background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%) !important;
}

.stats-card .card-body {
    padding: 30px 25px;
}

.stats-card .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 15px;
    opacity: 0.9;
}

.stats-card h2 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.action-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.action-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

.action-card .card-header {
    background: linear-gradient(135deg, #636e72 0%, #2d3436 100%) !important;
    border-radius: 15px 15px 0 0 !important;
    border: none;
    padding: 20px 25px;
}

.action-card .card-header h5 {
    margin: 0;
    font-weight: 600;
    font-size: 1.1rem;
}

.action-card .card-body {
    padding: 25px;
}

.search-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.search-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

.search-card .card-header {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    border-radius: 15px 15px 0 0 !important;
    border: none;
    padding: 20px 25px;
    color: white;
}

.search-card .card-header h5 {
    margin: 0;
    font-weight: 600;
    font-size: 1.1rem;
}

.search-card .card-body {
    padding: 25px;
}

.search-card .input-group .form-control {
    border-radius: 25px 0 0 25px;
    border: 2px solid #e9ecef;
    padding: 12px 20px;
    font-size: 1rem;
}

.search-card .input-group .btn {
    border-radius: 0 25px 25px 0;
    border: 2px solid #3498db;
    padding: 12px 25px;
    font-weight: 600;
}

.search-card .input-group .btn:hover {
    border-color: #2980b9;
}

/* Animation for cards */
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

.stats-card, .action-card, .search-card {
    animation: fadeInUp 0.6s ease-out;
}

.stats-card:nth-child(1) { animation-delay: 0.1s; }
.stats-card:nth-child(2) { animation-delay: 0.2s; }
.action-card { animation-delay: 0.3s; }
.search-card { animation-delay: 0.4s; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .dashboard-admin {
        padding: 10px 0;
    }

    .stats-card .card-body {
        padding: 20px 15px;
    }

    .stats-card h2 {
        font-size: 2rem;
    }

    .action-card .card-body,
    .search-card .card-body {
        padding: 20px 15px;
    }
}
</style>

<div class="dashboard-admin">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card stats-card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-book"></i> Total Buku
                        </h5>
                        <h2><?php echo $total_books; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card stats-card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-users"></i> Total Anggota
                        </h5>
                        <h2><?php echo $total_users; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card search-card">
                    <div class="card-header">
                        <h5><i class="fas fa-search"></i> Pencarian Cepat</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo BASE_URL; ?>/book/search" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Cari buku..." required>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>