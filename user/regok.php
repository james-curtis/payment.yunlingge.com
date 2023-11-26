<?php 
require_once('../oppay/common.php');
$alipay_config['partner'] = $conf['reg_pid'];
$alipay_config['key'] = $DB->query("SELECT `key` FROM `pay_user` WHERE `id`='{$conf['reg_pid']}' limit 1")->fetchColumn();
require_once("./epay_notify.class.php");
@header('Content-Type: text/html; charset=UTF-8');
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {
	$out_trade_no = $_GET['out_trade_no'];
	$trade_no = $_GET['trade_no'];
	$trade_status = $_GET['trade_status'];
	if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['
		trade_status'] == 'TRADE_SUCCESS') {
		$srow=$DB->query("SELECT * FROM pay_regcode WHERE trade_no='{$trade_no}' limit 1")->fetch();
		$array = explode('|',$srow['data']);
		$type = addslashes($array[0]);
		$account = addslashes($array[1]);
		$username = addslashes($array[2]);
		$url = addslashes($array[3]);
		if($srow['type']==1){
			$phone = addslashes($srow['email']);
			$email = addslashes($array[4]);
		}else{
			$email = addslashes($srow['email']);
		}
    $tgid = addslashes($array[5]);
		if($srow['status']==0){
			$DB->exec("update `pay_regcode` set `status` ='1' where `id`='{$srow['id']}'");
			$key = random(32);
		$sds=$DB->exec("INSERT INTO `pay_user` (`key`, `account`, `username`, `money`, `url`, `email`, `phone`, `addtime`, `type`, `active`) VALUES ('{$key}', '{$account}', '{$username}', '0', '{$url}', '{$email}', '{$phone}', '{$date}', '0', '1')");
		$pid=$DB->lastInsertId();
			if($sds){
      //云凌支付系统推广逻辑
      if(!empty($tgid)){
        $sj=$conf['tgyj'];
        $abc=$DB->exec("UPDATE `pay_user` SET `money`=money+'{$sj}' WHERE `id`='$tgid'");
        $abc1=$DB->exec("UPDATE `pay_user` SET `tgrs`=tgrs+'1' WHERE `id`='$tgid'");
      }
      //推广逻辑结束
			$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
			$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
			$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';
			$sub = $conf['web_name'].' - 注册成功通知';
			$msg = '<h2>商户注册成功通知</h2>感谢您注册'.$conf['web_name'].'！<br/>您的商户ID：'.$pid.'<br/>您的商户秘钥：'.$key.'<br/>'.$conf['web_name'].'官网：<a href="http://'.$_SERVER['HTTP_HOST'].'/" target="_blank">'.$_SERVER['HTTP_HOST'].'</a><br/>【<a href="'.$siteurl.'" target="_blank">商户管理后台</a>】';
			$result = send_mail($email, $sub, $msg);
		}else{
			sysmsg('申请商户失败！'.$DB->errorCode());
		}
	}else{
		$row=$DB->query("SELECT * FROM pay_user WHERE account='$account' and email='$email' order by id desc limit 1")->fetch();
		if($row){
			$pid = $row['id'];
			$key = $row['key'];
		}else{
			sysmsg('申请商户失败！');
		}
	}
}
}else {
    sysmsg('签名校验失败！');
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $conf['web_name']?>,云凌支付专为行业各大程序系统，提供优质的第三方支付一键对接！ by AS">
  <meta name="author" content="OP">
  <title>申请商户成功 | <?php echo $conf['web_name']?></title>
  <meta name="keywords" content="云凌支付,易支付,云钱包,云支付,云结算,支付接口,免签约,微信支付,支付宝,QQ钱包,财付通,个人支付接口,免签支付接口">
  <link rel="shortcut icon" href="//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo $conf['web_qq']; ?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" />
  <link rel="stylesheet" href="/assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/fortawesome.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/aswl.min.css" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
</head>
<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main"class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light"><div class="container"><a class="navbar-brand"href="/"><?php echo $conf['web_name']?></a><button class="navbar-toggler"type="button"data-toggle="collapse"data-target="#navbar-collapse"aria-controls="navbar-collapse"aria-expanded="false"aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button><div class="navbar-collapse navbar-custom-collapse collapse"id="navbar-collapse"><div class="navbar-collapse-header"><div class="row"><div class="col-6 collapse-brand"><a href="/"><?php echo $conf['web_name'];?></a></div><div class="col-6 collapse-close"><button type="button"class="navbar-toggler"data-toggle="collapse"data-target="#navbar-collapse"aria-controls="navbar-collapse"aria-expanded="false"aria-label="Toggle navigation"><span></span><span></span></button></div></div></div><ul class="navbar-nav mr-auto"><li class="nav-item"><a href="agreement.php"class="nav-link"><span class="nav-link-inner--text">服务条款</span></a></li><li class="nav-item"><a href="/doc.php"class="nav-link"><span class="nav-link-inner--text">开发文档</span></a></li><li class="nav-item"><a href="login.php"class="nav-link"><span class="nav-link-inner--text">商户登录</span></a></li><li class="nav-item"><a href="reg.php"class="nav-link"><span class="nav-link-inner--text">商户注册</span></a></li><li class="nav-item"><a onclick="return confirm('请直奔主题,不要问在不在,节省彼此的时间,懂?')"href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['web_qq']; ?>&site=qq&menu=yes"class="nav-link"><span class="nav-link-inner--text">联系客服</span></a></li></ul><ul class="navbar-nav align-items-lg-center ml-lg-auto"><li class="nav-item d-none d-lg-block ml-lg-4"><a href="https://ds.aswlcm.cn"target="_blank"class="btn btn-neutral btn-icon"><span class="btn-inner--icon"><i class="fas fa-shopping-cart mr-2"></i></span><span class="nav-link-inner--text">O泡小卖铺</span></a></li></ul></div></div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">申请商户成功</h1>
              <p class="text-lead text-white">山穷水尽疑无路，柳暗花明又一村</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card card-profile bg-secondary mt-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo $conf['web_qq']; ?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-4">
                <h3>商户信息已发送至您的邮箱<br>请注意查收～</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; <?=date('Y')?> <a href="/" class="font-weight-bold ml-1" target="_blank"><?php echo $conf['web_name']; ?></a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="http://www.miibeian.gov.cn/" class="nav-link" target="_blank">备案号：<?php echo $conf['beian']; ?></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>