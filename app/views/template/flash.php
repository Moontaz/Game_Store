<!-- Flash message display -->
<?php if (isset($_SESSION['flash'])) : ?>
<div class="alert alert-<?= $_SESSION['flash']['type']; ?> alert-dismissible fade show" role="alert"
   style="z-index:200;position:absolute;width:95vw; left:2.5vw;">
   <?= $_SESSION['flash']['message']; ?>
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
   unset($_SESSION['flash']);
   ?>
<?php endif; ?>