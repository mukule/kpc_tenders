<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/vacancies') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Vacancies</h2>
        <a href="<?= base_url('/careers/vacancies_create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Vacancy
        </a>
    </div>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <?= $this->include('partials/messages'); ?>
        <?php if (!empty($vacancies)): ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Reference</th>
                        <th>Duration</th>
                        <th>Function</th>
                        <th>Education Level</th>
                        <th>Type</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vacancies as $vacancy): ?>
                    <tr>
                        <td><?= esc($vacancy['id']); ?></td>
                        <td><?= esc($vacancy['title']); ?></td>
                        <td><?= esc($vacancy['ref']); ?></td>
                        <td>
                            <?= esc(date('Y-m-d', strtotime($vacancy['open_date']))); ?> - <?= esc(date('Y-m-d', strtotime($vacancy['close_date']))); ?>
                        </td>
                        <td>
                            <?= esc($vacancy_functions[$vacancy['vac_function']]['name'] ?? 'N/A'); ?>
                        </td>
                        <td>
                            <?= esc($education_levels[$vacancy['min_educational_level']]['name'] ?? 'N/A'); ?>
                        </td>
                        <td>
                            <?= esc($vacancy_types[$vacancy['vac_type']]['name'] ?? 'N/A'); ?>
                        </td>
                        <td><?= esc(date('Y-m-d H:i:s', strtotime($vacancy['created_at']))); ?></td>
                        <td>
                            <?= esc($users[$vacancy['created_by']]['username'] ?? 'N/A'); ?>
                        </td>
                        <td>
                            <a href="<?= base_url('careers/vacancies_edit/' . $vacancy['id']) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('/vacancies_delete/' . $vacancy['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vacancy?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No vacancies found.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
