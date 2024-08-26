<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/careers') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Education Levels</h2>
        <a href="<?= base_url('/careers/create_edu_lvls') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Education Level
        </a>
    </div>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <?php if (!empty($education_levels)): ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($education_levels as $level): ?>
                    <tr>
                        <td><?= esc($level['id']); ?></td>
                        <td><?= esc($level['name']); ?></td>
                        <td><?= esc($level['created_at']); ?></td>
                        <td>
                            <?php
                            // Find the username for the created_by user
                            $createdBy = array_filter($users, function($user) use ($level) {
                                return $user['id'] == $level['created_by'];
                            });
                            $createdBy = array_shift($createdBy);
                            echo esc($createdBy['username'] ?? 'N/A');
                            ?>
                        </td>
                        <td><?= esc($level['updated_at'] ?? 'N/A'); ?></td>
                        <td>
                            <?php
                            // Find the username for the updated_by user
                            $updatedBy = array_filter($users, function($user) use ($level) {
                                return $user['id'] == $level['updated_by'];
                            });
                            $updatedBy = array_shift($updatedBy);
                            echo esc($updatedBy['username'] ?? 'N/A');
                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url('careers/edit_edu_lvls/' . $level['id']) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('careers/del_edu_lvls/' . $level['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No education levels found.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
