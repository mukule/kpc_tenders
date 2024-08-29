<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('/tender_uploads') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h2><?= esc($title); ?></h2> <!-- Dynamic title -->
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

        <!-- Form for Editing Tender Document -->
        <form action="<?= base_url('/tenders/tender_docs_edit/' . $document['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group mb-3">
                <label for="document_name">Document Names</label>
                <input type="text" class="form-control" id="document_name" name="document_name" value="<?= esc($document['document_name']); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="file">Choose New File (Optional)</label>
                <input type="file" class="form-control" id="file" name="file">
                <!-- Existing file preview (if applicable) -->
                <?php if (!empty($document['file'])): ?>
                    <p>Current File: <a href="<?= base_url('/tenders/tender_doc/' . $document['id']); ?>" target="_blank">View Current File</a></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">
                Update Document
            </button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
