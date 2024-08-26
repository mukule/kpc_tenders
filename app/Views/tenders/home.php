<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <h2><?= esc($title); ?></h2>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <div class="row">
            <!-- Tenders Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/tender_uploads') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-file-alt fa-3x mb-3"></i>
                            <h5 class="card-title">Tenders</h5>
                            <p class="card-text">Manage Tender Uploads</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Awarded Contracts Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/awarded_contracts') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-handshake fa-3x mb-3"></i>
                            <h5 class="card-title">Awarded Contracts</h5>
                            <p class="card-text">Manage Awarded Contracts</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Procurement Plans Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/procurement_plans') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-check fa-3x mb-3"></i>
                            <h5 class="card-title">Procurement Plans</h5>
                            <p class="card-text">Manage Procurement Plans</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Eligibility Card -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('/eligibilities') ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <h5 class="card-title">Eligibility</h5>
                            <p class="card-text">Manage Eligibility Criteria</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
    <a href="<?= base_url('/docs') ?>" class="text-decoration-none">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-file-alt fa-3x mb-3"></i> <!-- Updated icon -->
                <h5 class="card-title">Document Types</h5>
                <p class="card-text">Manage Doc Types</p>
            </div>
        </div>
    </a>
</div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
