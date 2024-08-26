<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/vacancies') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Edit Vacancy</h2>
    </div>
    <hr>

    <div class="content bg-white p-4 rounded shadow-sm">
        <?= $this->include('partials/messages'); ?>
        
        <!-- Display Validation Errors -->
        <?php if (isset($validation) && !empty($validation)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($validation as $error): ?>
                        <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form for Editing Vacancy -->
        <form action="<?= base_url('/careers/vacancies_edit/' . $vacancy['id']) ?>" method="post">
            <?= csrf_field(); ?>
            
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= esc(old('title', $vacancy['title'])); ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="ref">Reference</label>
                <input type="text" class="form-control" id="ref" name="ref" value="<?= esc(old('ref', $vacancy['ref'])); ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="open_date">Open Date</label>
                <input type="datetime-local" class="form-control" id="open_date" name="open_date" value="<?= esc(old('open_date', date('Y-m-d\TH:i', strtotime($vacancy['open_date'])))); ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="close_date">Close Date</label>
                <input type="datetime-local" class="form-control" id="close_date" name="close_date" value="<?= esc(old('close_date', date('Y-m-d\TH:i', strtotime($vacancy['close_date'])))); ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="vac_function">Vacancy Function</label>
                <select class="form-control" id="vac_function" name="vac_function" required>
                    <option value="">Select a function</option>
                    <?php foreach ($vacancy_functions as $function): ?>
                        <option value="<?= esc($function['id']); ?>" <?= old('vac_function', $vacancy['vac_function']) == $function['id'] ? 'selected' : ''; ?>>
                            <?= esc($function['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group mb-3">
                <label for="min_educational_level">Minimum Educational Level</label>
                <select class="form-control" id="min_educational_level" name="min_educational_level" required>
                    <option value="">Select an educational level</option>
                    <?php foreach ($education_levels as $level): ?>
                        <option value="<?= esc($level['id']); ?>" <?= old('min_educational_level', $vacancy['min_educational_level']) == $level['id'] ? 'selected' : ''; ?>>
                            <?= esc($level['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group mb-3">
                <label for="vac_type">Vacancy Type</label>
                <select class="form-control" id="vac_type" name="vac_type" required>
                    <option value="">Select a vacancy type</option>
                    <?php foreach ($vacancy_types as $type): ?>
                        <option value="<?= esc($type['id']); ?>" <?= old('vac_type', $vacancy['vac_type']) == $type['id'] ? 'selected' : ''; ?>>
                            <?= esc($type['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
