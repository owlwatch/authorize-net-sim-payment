<?php
$this->layout('layout', [
  'title'     => $config->get('title'),
  'assets'    => $assets,
  'config'    => $config,
  'invoice'   => $invoice
]);
?>

<?php
if( $name ){
  ?>
<p>Hi <?= $this->e( $name ) ?>-</p>
  <?php
}
?>
<form action="<?= ROOTURL ?>/confirm" method="post" id="payment" class="form-inline">
  <p><label for="Amount">Please enter the amount you'd like to pay toward invoice #<?= $this->e( $invoice ) ?> ($<?= $amount ?>)</label></p>
  <div class="centered">
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon">$</span>
        <input id="Amount" class="form-control" name="Amount" type="text" value="<?= $this->e( $amount ) ?>" />
      </div>
    </div>
    <button type="submit" class="btn btn-primary">
      Make Payment <span class="fa fa-angle-right"></span>
    </button>
  </div>
  <input type="hidden" name="Invoice" value="<?= $this->e( $invoice ) ?>" />
  <input type="hidden" name="Client" value="<?= $this->e( $client) ?>" />
</form>