<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<div class="container p-3">
    <h2><?= esc($title); ?></h2>
    <hr>
    <div class="content bg-white p-4 rounded shadow-sm">
        <!-- Add content for tender details here -->
        <p>Details about tenders will be displayed here.</p>
       
       
    </div>
</div>

<?= $this->endSection(); ?>
