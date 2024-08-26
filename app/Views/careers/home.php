<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <h2><?= esc($title); ?></h2>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <div class="row">
            <!-- Vacancies Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/vacancies') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-briefcase fa-3x mb-3"></i>
                            <h5 class="card-title">Vacancies</h5>
                            <p class="card-text">Manage Job Vacancies</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Vacancy Type Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/job_types') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-tags fa-3x mb-3"></i>
                            <h5 class="card-title">Vacancy Type</h5>
                            <p class="card-text">Manage Vacancy Types</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Job Functions Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/job_functions') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                            <h5 class="card-title">Job Functions</h5>
                            <p class="card-text">Manage Job Functions</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Education Levels Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/edu_lvls') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                            <h5 class="card-title">Education Levels</h5>
                            <p class="card-text">Manage Education Levels</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
