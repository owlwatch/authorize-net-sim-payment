<?php
if( !$isAjax ){
  $this->layout('layout', [
    'title'     => $config->get('title'),
    'assets'    => $assets,
    'config'    => $config,
    'invoice'   => $invoice
  ]);
}
?>
<p>
  Clicking below will bring you to a form to pay <strong>$<?= $this->e( $amount ) ?></strong>
  toward invoice #<?= $invoice ?>.
</p>
<div class="centered">
  <form action="https://test.authorize.net/gateway/transact.dll" method="POST">
    <?= $simForm->getHiddenFieldString() ?>
    <button class="btn btn-primary" type="submit">
      Continue to Payment Form
      <span class="fa fa-angle-right"></span>
    </button>
  </form>
</div>