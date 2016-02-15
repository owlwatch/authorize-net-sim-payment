<!doctype>
<html>
  <head>
    <title><?= $this->e($title) ?></title>
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?= $assets->url('/styles/bootstrap.css') ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $assets->url('/styles/main.css') ?>" />
  </head>
  <body>
    
    <div class="container outer-container">
      <header>
        <div class="invoice-number">
          Invoice #<?= $this->e( $invoice ) ?>
        </div>
        <img src="<?= $assets->url('/images/mfa-logo.png') ?>" alt="MFA-CPA" />
      </header>
      <main>
        <?= $this->section('content') ?>
      </main>
    </div>
    
    <footer>
      <div class="container">
        <a href="<?= $config->get('site_url') ?>">
          <?= $this->e( $config->get('site_link_text') ) ?>
        </a> |
        <a href="<?= $config->get('privacy_url') ?>">
          Privacy Policy
        </a>
      </div>
    </footer>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
    <script src="<?= $assets->url('/scripts/main.js') ?>"></script>
  </body>
</html>