<!-- /app/Views/pages/staffs.php -->
<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>kPC Staffs</h2>
        <a href="<?= base_url('/register') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Staff
        </a>
    </div>
    <hr>
     <?= $this->include('partials/messages'); ?>
    <div class="content bg-white p-2 rounded shadow-sm">
        <?php if (empty($users)): ?>
            <p class="text-center">No staff members found.</p>
        <?php else: ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Access Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['id']); ?></td>
                        <td><?= esc($user['username']); ?></td>
                        <td><?= esc($user['full_name']); ?></td>
                        <td><?= esc($user['email']); ?></td>
                        <td>
                            <?php
                            // Find the department name
                            $departmentName = 'N/A';
                            foreach ($departments as $department) {
                                if ($user['department_id'] == $department['id']) {
                                    $departmentName = esc($department['name']);
                                    break;
                                }
                            }
                            echo $departmentName;
                            ?>
                        </td>
                        <td>
                            <?php
                            switch ($user['access_lvl']) {
                                case 1:
                                    echo 'Superuser';
                                    break;
                                case 2:
                                    echo 'Admin';
                                    break;
                                case 3:
                                    echo 'Staff';
                                    break;
                                default:
                                    echo 'N/A';
                                    break;
                            }
                            ?>
                        </td>
                        
                        <td>
                            <a href="<?= base_url('/updateStaffStatus/' . $user['id']); ?>" class="btn btn-sm <?= $user['active'] ? 'btn-danger' : 'btn-success'; ?>">
                                <?= $user['active'] ? 'Deactivate' : 'Activate'; ?>
                            </a>
                            <a href="<?= base_url('/editStaff/' . $user['id']); ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
