<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/tenders') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Edit Tender</h2>
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

        <!-- Form for Editing Tender -->
        <form action="<?= base_url('/tenders/tenders_edit/' . esc($tender['id'])) ?>" method="post">
            <?= csrf_field(); ?>

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= old('name', esc($tender['name'])); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="ref_number">Reference Number</label>
                <input type="text" class="form-control" id="ref_number" name="ref_number" value="<?= old('ref_number', esc($tender['ref_number'])); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="start_date">Start Date</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?= old('start_date', date('Y-m-d\TH:i', strtotime(esc($tender['start_date'])))); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="close_date">Close Date</label>
                <input type="datetime-local" class="form-control" id="close_date" name="close_date" value="<?= old('close_date', date('Y-m-d\TH:i', strtotime(esc($tender['close_date'])))); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Document Types</label>
                <div class="form-check">
                    <?php 
                    // Ensure document_types is a valid JSON string
                    $documentTypes = is_string($tender['document_types']) ? json_decode($tender['document_types'], true) : [];
                    foreach ($doc_types as $doc_type): ?>
                        <input type="checkbox" class="form-check-input" id="document_type_<?= esc($doc_type['id']); ?>" name="document_types[]" value="<?= esc($doc_type['id']); ?>" <?= in_array($doc_type['id'], old('document_types', $documentTypes ?? [])) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="document_type_<?= esc($doc_type['id']); ?>">
                            <?= esc($doc_type['name']); ?>
                        </label>
                        <br>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="site_visit_details1">Site Visit Details 1</label>
                <textarea class="form-control" id="site_visit_details1" name="site_visit_details1"><?= old('site_visit_details1', esc($tender['site_visit_details1'])); ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="site_visit_details2">Site Visit Details 2</label>
                <textarea class="form-control" id="site_visit_details2" name="site_visit_details2"><?= old('site_visit_details2', esc($tender['site_visit_details2'])); ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="eligibility">Eligibility</label>
                <select id="eligibility" name="eligibility" class="form-control" required>
                    <option value="">Select Eligibility</option>
                    <?php foreach ($eligibilities as $eligibility): ?>
                        <option value="<?= esc($eligibility['id']); ?>" <?= old('eligibility', $tender['eligibility']) == $eligibility['id'] ? 'selected' : ''; ?>>
                            <?= esc($eligibility['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="created_by" value="<?= esc($tender['created_by']); ?>">
            <input type="hidden" name="updated_by" value="<?= esc(session()->get('user_id')); ?>">

            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
