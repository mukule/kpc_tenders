<!-- /app/Views/pages/departments.php -->
<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Departments</h2>
        <a href="<?= base_url('/departments/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Department
        </a>
    </div>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <?php if (!empty($departments)): ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($departments as $department): ?>
                    <tr>
                        <td><?= esc($department['id']); ?></td>
                        <td><?= esc($department['name']); ?></td>
                        <td><?= esc($department['created_at']); ?></td>
                        <td><?= esc($department['created_by_username'] ?? 'N/A'); ?></td>
                        <td><?= esc($department['updated_at'] ?? 'N/A'); ?></td>
                        <td><?= esc($department['updated_by_username'] ?? 'N/A'); ?></td>
                        <td><?= $department['active'] ? 'Active' : 'Inactive'; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No departments added yet.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
