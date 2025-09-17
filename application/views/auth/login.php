<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Orang Tua</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-header text-center bg-primary text-white">
          <h4>Login Orang Tua</h4>
        </div>
        <div class="card-body">
          <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
              <?= $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <form action="<?= site_url('auth/login'); ?>" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
