<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/tenders') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Create Tender</h2>
    </div>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <!-- Display Validation Errors -->
        <?php if (isset($validation) && $validation->getErrors()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($validation->getErrors() as $error): ?>
                        <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form for Creating Tender -->
        <form action="<?= base_url('/tenders/create_tenders') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= old('name'); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="ref_number">Reference Number</label>
                <input type="text" class="form-control" id="ref_number" name="ref_number" value="<?= old('ref_number'); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="start_date">Start Date</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?= old('start_date'); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="close_date">Close Date</label>
                <input type="datetime-local" class="form-control" id="close_date" name="close_date" value="<?= old('close_date'); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="document_type">Document Type</label>
                <select id="document_type" name="document_type" class="form-control" required>
                    <option value="">Select Document Type</option>
                    <?php foreach ($doc_types as $doc_type): ?>
                        <option value="<?= esc($doc_type['id']); ?>" <?= old('document_type') == $doc_type['id'] ? 'selected' : ''; ?>>
                            <?= esc($doc_type['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="site_visit_details1">Site Visit Details 1</label>
                <textarea class="form-control" id="site_visit_details1" name="site_visit_details1"><?= old('site_visit_details1'); ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="site_visit_details2">Site Visit Details 2</label>
                <textarea class="form-control" id="site_visit_details2" name="site_visit_details2"><?= old('site_visit_details2'); ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="tender_file">Tender File (PDF only, max 5MB)</label>
                <input type="file" class="form-control" id="tender_file" name="tender_file" accept=".pdf" required>
            </div>
            <div class="form-group mb-3">
                <label for="eligibility">Eligibility</label>
                <select id="eligibility" name="eligibility" class="form-control" required>
                    <option value="">Select Eligibility</option>
                    <?php foreach ($eligibilities as $eligibility): ?>
                        <option value="<?= esc($eligibility['id']); ?>" <?= old('eligibility') == $eligibility['id'] ? 'selected' : ''; ?>>
                            <?= esc($eligibility['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="created_by" value="<?= session()->get('user_id'); ?>">
            <input type="hidden" name="updated_by" value="<?= session()->get('user_id'); ?>">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
