<?php
@header('Content-Type: text/html; charset=UTF-8');
if($userrow['active']==0){
  sysmsg($conf['user_no']);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $conf['web_name']?> by OP">
  <meta name="author" content="OP">
  <title><?php echo $title?> | <?php echo $conf['web_name']?></title>
  <meta name="keywords" content="云凌支付,云钱包,云支付,云结算,支付接口,支付营销,对账,微信支付,支付宝,QQ钱包,个人支付接口,免签支付接口">
  <link rel="shortcut icon" href="<?php echo ($userrow['qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'/assets/images/as.png'?>" />
  <link rel="stylesheet" href="/assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/fortawesome.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/css/aswl.min.css" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
</head>
<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="index.php" style="font-weight: bold;color: bule"><?php echo $conf['web_name']?></a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav"><li class="nav-item"><a class="nav-link"href="./"><i class="ni ni-compass-04 text-primary"></i><span class="nav-link-text">用户中心</span></a></li><li class="nav-item"><a class="nav-link"href="#dingdianyujiesuanleft"data-toggle="collapse"role="button"aria-expanded="false"aria-controls="navbar-examples"><i class="ni ni-ungroup text-orange"></i><span class="nav-link-text">订单与结算</span></a><div class="collapse"id="dingdianyujiesuanleft"><ul class="nav nav-sm flex-column"><li class="nav-item"><a href="order.php"class="nav-link">订单明细</a></li><li class="nav-item"><a href="settle.php"class="nav-link">结算明细</a></li><li class="nav-item"><a href="apply.php"class="nav-link">手动结算</a></li></ul></div></li><li class="nav-item"><a class="nav-link"href="test.php"><i class="ni ni-atom text-primary"></i><span class="nav-link-text">在线测试</span></a></li><li class="nav-item"><a class="nav-link"href="tgfl.php"><i class="ni ni-like-2 text-pink"></i><span class="nav-link-text">推广返利</span></a></li><li class="nav-item"><a class="nav-link"href="zhuan.php"><i class="ni ni-delivery-fast text-green"></i><span class="nav-link-text">商户转账</span></a></li><li class="nav-item"><a class="nav-link"href="phb.php"><i class="ni ni-chart-bar-32 text-info"></i><span class="nav-link-text">商户排行</span></a></li><li class="nav-item"><a class="nav-link"onclick="return confirm('进群可获取平台最新信息，请在进群验证信息中填写您的商户ID，点击确定立即加群！')"href="<?php echo $conf['qun']?>"target="blank"><i class="ni ni-hat-3 text-default"></i><span class="nav-link-text">商户群聊</span></a></li><li class="nav-item"><a class="nav-link"href="<?php echo $conf['hzlink1']?>"><i class="ni ni-world text-green"></i><span class="nav-link-text"><?php echo $conf['hzhb1']?></span></a></li><li class="nav-item"><a class="nav-link"href="<?php echo $conf['hzlink2']?>"><i class="ni ni-world text-red"></i><span class="nav-link-text"><?php echo $conf['hzhb2']?></span></a></li>
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">集成包下载</h6>
          <ul class="navbar-nav mb-md-3"><li class="nav-item"><a class="nav-link"onclick="return confirm('您将要下载同行易支付系统集成包文件，将文件覆盖到您站点根目录即可完成对接，点击确定开始下载！')"href="<?php echo $conf['sdk']?>"target="_blank"><i class="ni ni-diamond"></i><span class="nav-link-text">易支付集成包</span></a></li><li class="nav-item"><a class="nav-link"onclick="return confirm('您将要下载彩虹代刷系统集成包文件，将文件覆盖到您站点根目录即可完成对接，点击确定开始下载！')"href="<?php echo $conf['chds']?>"target="_blank"><i class="ni ni-palette"></i><span class="nav-link-text">彩虹代刷集成包</span></a></li><li class="nav-item"><a class="nav-link"onclick="return confirm('您将要下载VHMS系统集成包文件，将文件覆盖到您站点根目录即可完成对接，点击确定开始下载！')"href="<?php echo $conf['vhms']?>"target="_blank"><i class="ni ni-planet"></i><span class="nav-link-text">VHMS集成包</span></a></li><li class="nav-item"><a class="nav-link"onclick="return confirm('您将要下载SWAP系统集成包文件，将文件覆盖到您站点根目录即可完成对接，点击确定开始下载！')"href="<?php echo $conf['swapidc']?>"target="_blank"><i class="ni ni-spaceship"></i><span class="nav-link-text">SWAP集成包</span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- 搜索框 -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3"id="navbar-search-main"action="https://www.baidu.com/s?ie=utf-8&"><div class="form-group mb-0"><div class="input-group input-group-alternative input-group-merge"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search"></i></span></div><input class="form-control"placeholder="百度一下,你就知道"type="text"name="wd"></div></div><button type="button"class="close"data-action="search-close"data-target="#navbar-search-main"aria-label="Close"><span aria-hidden="true">×</span></button>
          </form>
          <!-- 工具栏 -->
          <ul class="navbar-nav align-items-center ml-md-auto"><li class="nav-item d-xl-none"><!--Sidenav toggler--><div class="pr-3 sidenav-toggler sidenav-toggler-dark"data-action="sidenav-pin"data-target="#sidenav-main"><div class="sidenav-toggler-inner"><i class="sidenav-toggler-line"></i><i class="sidenav-toggler-line"></i><i class="sidenav-toggler-line"></i></div></div></li><li class="nav-item d-sm-none"><a class="nav-link"href="#"data-action="search-show"data-target="#navbar-search-main"><i class="ni ni-zoom-split-in"></i></a></li><li class="nav-item dropdown"><a class="nav-link"href="#"role="button"data-toggle="dropdown"aria-haspopup="true"aria-expanded="false"><i class="ni ni-bell-55"></i></a><div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden"><!--Dropdown header--><div class="px-3 py-3"><h6 class="text-sm text-muted m-0">欢迎使用<strong class="text-primary"><?php echo $conf['web_name']?></strong>请查看最新公告.</h6></div><!--List group--><div class="list-group list-group-flush"><a href="#"class="list-group-item list-group-item-action"><div class="row align-items-center"><div class="col-auto"><!--Avatar--><img alt="用户中心公告"src="<?php echo ($userrow['qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'/assets/images/as.png'?>"class="avatar rounded-circle"></div><div class="col ml--2"><div class="d-flex justify-content-between align-items-center"><div><h4 class="mb-0 text-sm"><?php echo $conf['web_name']?>官方公告①</h4></div></div><p class="text-sm mb-0"><?php echo $conf['gg1'];?></p></div></div></a><a href="#"class="list-group-item list-group-item-action"><div class="row align-items-center"><div class="col-auto"><!--Avatar--><img alt="Avatar"src="/assets/images/team-1.jpg"class="avatar rounded-circle"></div><div class="col ml--2"><div class="d-flex justify-content-between align-items-center"><div><h4 class="mb-0 text-sm"><?php echo $conf['web_name']?>官方公告②</h4></div></div><p class="text-sm mb-0"><?php echo $conf['gg2'];?></p></div></div></a><a href="#"class="list-group-item list-group-item-action"><div class="row align-items-center"><div class="col-auto"><!--Avatar--><img alt="用户中心公告"src="/assets/images/team-2.jpg"class="avatar rounded-circle"></div><div class="col ml--2"><div class="d-flex justify-content-between align-items-center"><div><h4 class="mb-0 text-sm"><?php echo $conf['web_name']?>官方公告③</h4></div></div><p class="text-sm mb-0"><?php echo $conf['gg3'];?></p></div></div></a><a href="#"class="list-group-item list-group-item-action"><div class="row align-items-center"><div class="col-auto"><!--Avatar--><img alt="用户中心公告"src="../../assets/images/team-3.jpg"class="avatar rounded-circle"></div><div class="col ml--2"><div class="d-flex justify-content-between align-items-center"><div><h4 class="mb-0 text-sm"><?php echo $conf['web_name']?>官方公告④</h4></div></div><p class="text-sm mb-0"><?php echo $conf['gg4'];?></p></div></div></a><a href="#"class="list-group-item list-group-item-action"><div class="row align-items-center"><div class="col-auto"><!--Avatar--><img alt="用户中心公告"src="../../assets/images/team-4.jpg"class="avatar rounded-circle"></div><div class="col ml--2"><div class="d-flex justify-content-between align-items-center"><div><h4 class="mb-0 text-sm"><?php echo $conf['web_name']?>官方公告⑤</h4></div></div><p class="text-sm mb-0"><?php echo $conf['gg5'];?></p></div></div></a></div><!--View all--><a href="#"class="dropdown-item text-center text-primary font-weight-bold py-3">只显示最近5条...</a></div></li>
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0"><li class="nav-item dropdown"><a class="nav-link pr-0"href="#"role="button"data-toggle="dropdown"aria-haspopup="true"aria-expanded="false"><div class="media align-items-center"><span class="avatar avatar-sm rounded-circle"><img alt="Avatar"src="<?php echo ($userrow['qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'/assets/images/as.png'?>"></span><div class="media-body ml-2 d-none d-lg-block"><span class="mb-0 text-sm font-weight-bold"><?php echo $userrow['username']?></span></div></div></a><div class="dropdown-menu dropdown-menu-right"><div class="dropdown-header noti-title"><h6 class="text-overflow m-0">欢迎使用<?php echo $conf['web_name']?>!</h6></div><a href="userinfo.php"class="dropdown-item"><i class="ni ni-single-02"></i><span>朕的户籍</span></a><a href="order.php"class="dropdown-item"><i class="ni ni-calendar-grid-58"></i><span>订单明细</span></a><div class="dropdown-divider"></div><a href="login.php?logout"class="dropdown-item"><i class="ni ni-user-run"></i><span>钱圈够了，赶紧溜！</span></a></div></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header结束 -->
    <?php if(isset($msg)){?>
    <div class="alert alert-info">
    <?php echo $msg?>
    </div>
    <?php }?>