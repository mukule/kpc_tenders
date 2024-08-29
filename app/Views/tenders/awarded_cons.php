<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <?= $this->include('partials/messages'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/awarded_cons') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Awarded Contracts</h2>
        <a href="<?= base_url('/tenders/awarded_cons_create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Awarded Contract
        </a>
    </div>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <?php if (!empty($awardedContracts)): ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Reference Number</th>
                        <th>Contract Details</th>
                        <th>Procurement Method</th>
                        <th>Contract Category</th>
                        <th>Supplier Name</th>
                        <th>Contract Value</th>
                        <th>Dates</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($awardedContracts as $contract): ?>
                    <tr>
                        <td><?= esc($contract['id']); ?></td>
                        <td><?= esc($contract['ref_num']); ?></td>
                        <td><?= esc($contract['cont_details']); ?></td>
                        <td><?= esc($contract['pro_method']); ?></td>
                        <td><?= esc($contract['cont_cat']); ?></td>
                        <td><?= esc($contract['supp_name']); ?></td>
                        <td><?= esc($contract['cont_value']); ?></td>
                        <td><?= esc($contract['start_date']); ?> - <?= esc($contract['end_date']); ?></td>
                        <td><?= esc($contract['created_at']); ?></td>
                        <td>
                            <?php
                            // Find the username for the created_by user
                            $createdBy = array_filter($users, function($user) use ($contract) {
                                return $user['id'] == $contract['created_by'];
                            });
                            $createdBy = array_shift($createdBy);
                            echo esc($createdBy['username'] ?? 'N/A');
                            ?>
                        </td>
                        <td><?= esc($contract['updated_at'] ?? 'N/A'); ?></td>
                        <td>
                            <?php
                            // Find the username for the updated_by user
                            $updatedBy = array_filter($users, function($user) use ($contract) {
                                return $user['id'] == $contract['updated_by'];
                            });
                            $updatedBy = array_shift($updatedBy);
                            echo esc($updatedBy['username'] ?? 'N/A');
                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url('tenders/awarded_cons_edit/' . $contract['id']) ?>" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <a href="<?= base_url('awarded_cons_delete/' . $contract['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                Del
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No awarded contracts found.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
