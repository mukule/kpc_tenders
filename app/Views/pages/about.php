<!-- /app/Views/pages/about.php -->
<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
    <?= $this->include('partials/messages'); ?>
    <h2>About Us</h2>
    <p>This is the content of the about page.</p>
<?= $this->endSection(); ?>
