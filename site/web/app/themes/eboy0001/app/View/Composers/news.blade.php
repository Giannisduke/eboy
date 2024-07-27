<?php
use Automattic\WooCommerce\Client;

$woocommerce = new Client(
  'http://eboy.test',
  'ck_01a3d4f3afd9864238a90534b3919d41eb768023',
  'cs_ef4cc96f0c6bd804237e28b58cc271eecabe2921',
  [
    'version' => 'wc/v3',
  ]
);
?>