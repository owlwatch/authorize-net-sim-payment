<?php
$this->layout('layout', [
  'title'     => $config->get('title'),
  'assets'    => $assets,
  'config'    => $config,
  'invoice'   => $invoice
]);