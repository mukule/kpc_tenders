<!-- /app/Views/pages/home.php -->
<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <?= $this->include('partials/messages'); ?>
    
    <!-- Jumbotron Section -->
    <div class="jumbotron mt-3">
        <h1 class="display-2">Welcome, <?= session()->get('username'); ?></h1>
        
        <?php
        $accessLevel = session()->get('access_level');
        if ($accessLevel == 1): ?>
            <p class="card-title">You are a superuser.</p>
        <?php elseif ($accessLevel == 2): ?>
            <p class="card-title">You are an admin.</p>
        <?php elseif ($accessLevel == 3): ?>
            <p class="card-title">You are a manager.</p>
        <?php else: ?>
            <p class="card-title">You have a standard user role.</p>
        <?php endif; ?>

        <hr class="my-4">
    </div>

    <!-- New Content Section -->
    <div class="content bg-white p-4 rounded shadow-sm">
        <div class="row">
            <!-- Users Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/staffs') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x mb-3"></i>
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">Manage System Users</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Departments Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/departments') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-building fa-3x mb-3"></i>
                            <h5 class="card-title">Departments</h5>
                            <p class="card-text">Manage Departments</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Careers Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/tenders') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-briefcase fa-3x mb-3"></i>
                            <h5 class="card-title">Tenders</h5>
                            <p class="card-text">Manage Tenders</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Tenders Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/careers') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-file-contract fa-3x mb-3"></i>
                            <h5 class="card-title">Careers</h5>
                            <p class="card-text">Manage Careers</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
