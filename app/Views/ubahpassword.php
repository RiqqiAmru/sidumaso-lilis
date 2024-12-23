<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Ubah Password Akun Saya</h1>
  </div>

  <section class="section">
    <div class="container mt-5">
      <h2>Ubah Password</h2>

      <?php if (session()->get('error')): ?>
      <div class="alert alert-danger"><?= session()->get('error') ?></div>
      <?php endif; ?>

      <?php if (session()->get('success')): ?>
      <div class="alert alert-success"><?= session()->get('success') ?></div>
      <?php endif; ?>

      <?php if (isset($errors) && count($errors) > 0): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($errors as $error): ?>
          <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

      <form action="/akun/ubah-password" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
          <label for="current_password">Password Lama</label>
          <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="new_password">Password Baru</label>
          <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="confirm_password">Konfirmasi Password Baru</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ubah Password</button>
      </form>
    </div>
  </section>
</main>

<?= $this->endSection(); ?>