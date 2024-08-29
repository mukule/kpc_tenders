<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <?= $this->include('partials/messages'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/tenders') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Tenders</h2>
        <a href="<?= base_url('/tenders/tenders_create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Tender
        </a>
    </div>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <?php if (!empty($tenders)): ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Ref Number</th>
                        <th>Dates</th>
                        <th>Site Visit Details 1</th>
                        <th>Site Visit Details 2</th>
                        <th>Eligibility</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th>Documents</th> <!-- New column header -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tenders as $tender): ?>
                    <tr>
                        <td><?= esc($tender['id']); ?></td>
                        <td><?= esc($tender['name']); ?></td>
                        <td><?= esc($tender['ref_number']); ?></td>
                        <td><?= esc($tender['start_date']); ?> - <?= esc($tender['close_date']); ?></td>
                        <td><?= esc($tender['site_visit_details1']); ?></td>
                        <td><?= esc($tender['site_visit_details2']); ?></td>
                        <td>
                            <?php
                            // Find the eligibility
                            $eligibility = array_filter($eligibilities, function($item) use ($tender) {
                                return $item['id'] == $tender['eligibility'];
                            });
                            $eligibility = array_shift($eligibility);
                            echo esc($eligibility['name'] ?? 'N/A');
                            ?>
                        </td>
                        <td><?= esc($tender['created_at']); ?></td>
                        <td>
                            <?php
                            // Find the username for the created_by user
                            $createdBy = array_filter($users, function($user) use ($tender) {
                                return $user['id'] == $tender['created_by'];
                            });
                            $createdBy = array_shift($createdBy);
                            echo esc($createdBy['username'] ?? 'N/A');
                            ?>
                        </td>
                        <td><?= esc($tender['updated_at'] ?? 'N/A'); ?></td>
                        <td>
                            <?php
                            // Find the username for the updated_by user
                            $updatedBy = array_filter($users, function($user) use ($tender) {
                                return $user['id'] == $tender['updated_by'];
                            });
                            $updatedBy = array_shift($updatedBy);
                            echo esc($updatedBy['username'] ?? 'N/A');
                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url('tender_docs/' . $tender['id']) ?>" class="btn btn-info btn-sm">
                                View Docs
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url('tenders/tenders_edit/' . $tender['id']) ?>" class="btn btn-warning btn-sm">
                                 Edit
                            </a>
                            <a href="<?= base_url('tender_delete/' . $tender['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                 Del
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tenders found.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
