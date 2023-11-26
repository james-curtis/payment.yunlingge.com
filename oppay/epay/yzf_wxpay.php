<?php
//云凌支付系统文件
$alipay_config['partner']		= $conf['yzf_wxpay_id'];
$alipay_config['key']			= $conf['yzf_wxpay_key'];
$alipay_config['sign_type']    = strtoupper('MD5');
$alipay_config['input_charset']= strtolower('utf-8');
$alipay_config['transport']    = 'http';
$alipay_config['apiurl']    = $conf['yzf_wxpay_api'];
?>