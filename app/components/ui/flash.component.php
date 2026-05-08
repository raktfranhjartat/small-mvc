<?php if (!empty($_SESSION['flash'])): 
  $flash = $_SESSION['flash'];
  unset($_SESSION['flash']);
?>

<div class="position-absolute top-50 start-50 translate-middle z-3 alert alert-<?= htmlspecialchars($flash['type'] ?? 'info') ?> alert-dismissible fade show">
  <?= htmlspecialchars($flash['message'] ?? '') ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<?php endif; ?>