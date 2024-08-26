<!-- /app/Views/pages/create_department.php -->
<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <h2>Create Department</h2>
    <hr>
    <?= $this->include('partials/messages'); ?>
    <div class="content bg-white p-4 rounded shadow-sm">
        <form action="<?= base_url('/departments/store'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group mb-3">
                <label for="name">Department Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= esc($data['name'] ?? '') ?>" required>
                <?= \Config\Services::validation()->getError('name'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Create Department</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
