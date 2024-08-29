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
        <?php if (!empty($documentTypes)): ?>
            <div class="list-group">
                <?php foreach ($documentTypes as $docType): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-3"><?= esc($docType['name']); ?></h5>
                            <!-- Link to add a new document for this type -->
                            <a href="<?= base_url('/tenders/tender_docs_create/' . $tenderId . '/' . $docType['id']); ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add Document
                            </a>
                        </div>
                        <?php
                        // Filter documents for the current document type
                        $docs = array_filter($tenderDocuments, function($doc) use ($docType) {
                            return $doc['doc_type_id'] == $docType['id'];
                        });
                        ?>
                        <?php if (!empty($docs)): ?>
                            <ul class="list-group mt-3">
                                <?php foreach ($docs as $doc): ?>
                                    <li class="list-group-item">
                                        <strong><?= esc($doc['document_name']); ?></strong><br>
                                        <a href="<?= base_url('/tenders/tender_doc/' . $doc['id']); ?>" target="_blank">View Document</a>
                                        <a href="<?= base_url('/tenders/tender_docs_edit/' . $doc['id']); ?>" class="btn btn-warning btn-sm float-right ml-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <!-- Delete link with a confirmation dialog -->
                                        <a href="<?= base_url('/tenders/tender_doc_delete/' . $doc['id']); ?>" class="btn btn-danger btn-sm float-right ml-2" onclick="return confirm('Are you sure you want to delete this document?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <hr>
                        <?php else: ?>
                            <p>No documents available</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No document types found.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
