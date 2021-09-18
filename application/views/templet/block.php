<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?=base_url('assets/')?>block.css">
  </head>
  <body>
    <div class="container">
      <h2>Oops! Page not found.</h2>
      <h1>404</h1>
      <p>Jangan Nakal Yaa</p>
      <?php if ($this->session->userdata('akun')=='vote'):?>

      <a href="<?=base_url('user')?>">Go back </a>
      <?php elseif ($this->session->userdata('akun')=='admin'):?>
      <a href="<?=base_url('Home')?>">Go back home</a>
      <?php else:?>
        <a href="<?=base_url('')?>">Go back </a>
      <?php endif; ?>

    </div>
  </body>
</html>