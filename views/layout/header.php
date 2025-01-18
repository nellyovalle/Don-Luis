<header>
  <div class="container py-2">
    <h2 class="display-3 py-0 mb-0 d-flex align-items-center">
      <a href="<?= base_url ?>" class="titulo-tienda">Tienda</a>
    </h2>
    <?php if (!isset($_SESSION["identity"])) : ?>
      <a href="<?= base_url . 'index.php?controller=usuario&action=login' ?>"><i class="fas fa-user-circle"></i></a>
    <?php else : ?>
      <a href="<?= base_url . 'index.php?controller=usuario&action=logOut' ?>"><i class="fas fa-sign-out-alt"></i></a>
    <?php endif; ?>
  </div>
</header>