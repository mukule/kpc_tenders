<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <?= $this->include('partials/messages'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/procurement_plans') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Procurement Plans</h2>
        <a href="<?= base_url('/tenders/proc_plans_create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Procurement Plan
        </a>
    </div>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <?php if (!empty($procurementPlans)): ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type of Procurement Plan</th>
                        <th>Goods Description</th>
                        <th>Units</th>
                        <th>Quantity</th>
                        <th>Procurement Method</th>
                        <th>AGPO Category</th>
                        <th>Section</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($procurementPlans as $plan): ?>
                    <tr>
                        <td><?= esc($plan['id']); ?></td>
                        <td><?= esc($plan['type_of_procurement_plan']); ?></td>
                        <td><?= esc($plan['goods_desc']); ?></td>
                        <td><?= esc($plan['units']); ?></td>
                        <td><?= esc($plan['quantity']); ?></td>
                        <td><?= esc($plan['pro_methods']); ?></td>
                        <td><?= esc($plan['agpo_category']); ?></td>
                        <td><?= esc($plan['section']); ?></td>
                        <td><?= esc($plan['created_at']); ?></td>
                        <td>
                            <?php
                            // Find the username for the created_by user
                            $createdBy = array_filter($users, function($user) use ($plan) {
                                return $user['id'] == $plan['created_by'];
                            });
                            $createdBy = array_shift($createdBy);
                            echo esc($createdBy['username'] ?? 'N/A');
                            ?>
                        </td>
                        <td><?= esc($plan['updated_at'] ?? 'N/A'); ?></td>
                        <td>
                            <?php
                            // Find the username for the updated_by user
                            $updatedBy = array_filter($users, function($user) use ($plan) {
                                return $user['id'] == $plan['updated_by'];
                            });
                            $updatedBy = array_shift($updatedBy);
                            echo esc($updatedBy['username'] ?? 'N/A');
                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url('tenders/proc_plans_edit/' . $plan['id']) ?>" class="btn btn-warning btn-sm">
                                 Edit
                            </a>
                            <a href="<?= base_url('proc_plans_delete/' . $plan['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                 Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No procurement plans found.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
