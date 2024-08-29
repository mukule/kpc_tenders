<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/awarded_cons') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2>Edit Awarded Contract</h2>
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

        <!-- Form for Editing Awarded Contract -->
        <form action="<?= base_url('/tenders/awarded_cons_edit/' . $contract['id']) ?>" method="post">
            <?= csrf_field(); ?>

            <div class="form-group mb-3">
                <label for="ref_num">Reference Number</label>
                <input type="text" class="form-control" id="ref_num" name="ref_num" value="<?= old('ref_num', $contract['ref_num']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="cont_details">Contract Details</label>
                <textarea class="form-control" id="cont_details" name="cont_details" required><?= old('cont_details', $contract['cont_details']); ?></textarea>
            </div>

            <!-- Select Field for Procurement Method -->
            <div class="form-group mb-3">
                <label for="pro_method">Procurement Method</label>
                <select id="pro_method" name="pro_method" class="form-control" required>
                    <option value="">Select Procurement Method</option>
                    <option value="RFQ" <?= old('pro_method', $contract['pro_method']) == 'RFQ' ? 'selected' : ''; ?>>RFQ</option>
                    <option value="OPEN" <?= old('pro_method', $contract['pro_method']) == 'OPEN' ? 'selected' : ''; ?>>OPEN</option>
                    <option value="RESTRICTED" <?= old('pro_method', $contract['pro_method']) == 'RESTRICTED' ? 'selected' : ''; ?>>RESTRICTED</option>
                    <option value="DIRECT" <?= old('pro_method', $contract['pro_method']) == 'DIRECT' ? 'selected' : ''; ?>>DIRECT</option>
                </select>
            </div>

            <!-- Select Field for Contract Category -->
            <div class="form-group mb-3">
                <label for="cont_cat">Contract Category</label>
                <select id="cont_cat" name="cont_cat" class="form-control" required>
                    <option value="">Select Contract Category</option>
                    <option value="ALL" <?= old('cont_cat', $contract['cont_cat']) == 'ALL' ? 'selected' : ''; ?>>ALL</option>
                    <option value="YOUTH" <?= old('cont_cat', $contract['cont_cat']) == 'YOUTH' ? 'selected' : ''; ?>>YOUTH</option>
                    <option value="WOMEN" <?= old('cont_cat', $contract['cont_cat']) == 'WOMEN' ? 'selected' : ''; ?>>WOMEN</option>
                    <option value="PWD" <?= old('cont_cat', $contract['cont_cat']) == 'PWD' ? 'selected' : ''; ?>>PWD</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="supp_name">Supplier Name</label>
                <input type="text" class="form-control" id="supp_name" name="supp_name" value="<?= old('supp_name', $contract['supp_name']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="cont_value">Contract Value</label>
                <input type="number" class="form-control" id="cont_value" name="cont_value" value="<?= old('cont_value', $contract['cont_value']); ?>" step="0.01" required>
            </div>

            <div class="form-group mb-3">
                <label for="start_date">Start Date</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?= old('start_date', $contract['start_date']); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="end_date">End Date</label>
                <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?= old('end_date', $contract['end_date']); ?>" required>
            </div>

            <input type="hidden" name="created_by" value="<?= $contract['created_by']; ?>">
            <input type="hidden" name="updated_by" value="<?= session()->get('user_id'); ?>">

            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
