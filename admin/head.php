<?php
    $baidu="12345678";
    include("../oppay/common.php");
    if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
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
  <link rel="shortcut icon" href="/favicon.ico" />
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
        <a class="navbar-brand" href="index.php" style="font-weight: bold;color: bule">云凌支付系统</a>
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
          <ul class="navbar-nav"><li class="nav-item"><a class="nav-link"href="./index.php"><i class="ni ni-compass-04 text-primary"></i><span class="nav-link-text">后台首页</span></a></li><li class="nav-item"><a class="nav-link"href="#shanghu"data-toggle="collapse"role="button"aria-expanded="false"aria-controls="navbar-examples"><i class="ni ni-single-02 text-orange"></i><span class="nav-link-text">商户管理</span></a><div class="collapse"id="shanghu"><ul class="nav nav-sm flex-column"><li class="nav-item"><a href="ulist.php?my=add"class="nav-link">添加商户</a></li><li class="nav-item"><a href="plist.php?my=add"class="nav-link">添加合作者</a></li><li class="nav-item"><a href="ulist.php"class="nav-link">商户列表</a></li><li class="nav-item"><a href="plist.php"class="nav-link">合作者列表</a></li></ul></div></li><li class="nav-item"><a class="nav-link"href="#zijin"data-toggle="collapse"role="button"aria-expanded="false"aria-controls="navbar-examples"><i class="ni ni-credit-card text-info"></i><span class="nav-link-text">资金管理</span></a><div class="collapse"id="zijin"><ul class="nav nav-sm flex-column"><li class="nav-item"><a href="order.php"class="nav-link">订单明细</a></li><li class="nav-item"><a href="zhuan.php"class="nav-link">转账明细</a></li><li class="nav-item"><a href="settle.php"class="nav-link">结算操作</a></li><li class="nav-item"><a href="slist.php"class="nav-link">结算列表</a></li></ul></div></li><li class="nav-item"><a class="nav-link"href="#xitong"data-toggle="collapse"role="button"aria-expanded="false"aria-controls="navbar-examples"><i class="ni ni-settings-gear-65 text-pink"></i><span class="nav-link-text">系统设置</span></a><div class="collapse"id="xitong"><ul class="nav nav-sm flex-column"><li class="nav-item"><a href="webset.php"class="nav-link">站点信息配置</a></li><li class="nav-item"><a href="jkset.php"class="nav-link">系统监控配置</a></li><li class="nav-item"><a href="agreement.php"class="nav-link">服务条款配置</a></li><li class="nav-item"><a href="gg.php"class="nav-link">用户公告配置</a></li><li class="nav-item"><a href="splj.php"class="nav-link">商品拦截配置</a></li><li class="nav-item"><a href="shdl.php"class="nav-link">商户登录配置</a></li><li class="nav-item"><a href="sqsh.php"class="nav-link">商户申请配置</a></li><li class="nav-item"><a href="ylfl.php"class="nav-link">盈利费率配置</a></li><li class="nav-item"><a href="dxyx.php"class="nav-link">短信邮箱配置</a></li><li class="nav-item"><a href="update.php"class="nav-link">检查版本更新</a></li></ul></div></li><li class="nav-item"><a class="nav-link"href="#jiekou"data-toggle="collapse"role="button"aria-expanded="false"aria-controls="navbar-examples"><i class="ni ni-planet text-red"></i><span class="nav-link-text">接口设置</span></a><div class="collapse"id="jiekou"><ul class="nav nav-sm flex-column"><li class="nav-item"><a href="op_td.php"class="nav-link">支付通道配置</a></li><li class="nav-item"><a href="op_gfjk.php"class="nav-link">官方支付配置</a></li><li class="nav-item"><a href="op_mzf.php"class="nav-link">码支付配置</a></li><li class="nav-item"><a href="op_yzf.php"class="nav-link">易支付配置</a></li></ul></div></li><li class="nav-item"><a class="nav-link"href="#qita"data-toggle="collapse"role="button"aria-expanded="false"aria-controls="navbar-examples"><i class="ni ni-send text-green"></i><span class="nav-link-text">其他设置</span></a><div class="collapse"id="qita"><ul class="nav nav-sm flex-column"><li class="nav-item"><a href="dljl.php"class="nav-link">登录记录查询</a></li><li class="nav-item"><a href="adminset.php"class="nav-link">管理员信息配置</a></li><li class="nav-item"><a href="template.php"class="nav-link">首页模板配置</a></li></ul></div></li>
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
          <ul class="navbar-nav align-items-center ml-md-auto"><li class="nav-item d-xl-none"><!--Sidenav toggler--><div class="pr-3 sidenav-toggler sidenav-toggler-dark"data-action="sidenav-pin"data-target="#sidenav-main"><div class="sidenav-toggler-inner"><i class="sidenav-toggler-line"></i><i class="sidenav-toggler-line"></i><i class="sidenav-toggler-line"></i></div></div></li><li class="nav-item d-sm-none"><a class="nav-link"href="#"data-action="search-show"data-target="#navbar-search-main"><i class="ni ni-zoom-split-in"></i></a></li>
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0"><li class="nav-item dropdown"><a class="nav-link pr-0"href="#"role="button"data-toggle="dropdown"aria-haspopup="true"aria-expanded="false"><div class="media align-items-center"><span class="avatar avatar-sm rounded-circle"><img alt="Avatar"src="<?php echo ($conf['web_qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$conf['web_qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'/assets/images/as.png'?>"></span><div class="media-body ml-2 d-none d-lg-block"><span class="mb-0 text-sm font-weight-bold"><?php echo $conf['web_name']?></span></div></div></a><div class="dropdown-menu dropdown-menu-right"><div class="dropdown-header noti-title"><h6 class="text-overflow m-0">欢迎使用云凌支付系统</h6></div><a href="adminset.php"class="dropdown-item"><i class="ni ni-single-02"></i><span>管理员账号配置</span></a><div class="dropdown-divider"></div><a href="./login.php?logout"class="dropdown-item"><i class="ni ni-user-run"></i><span>钱圈够了，赶紧溜！</span></a></div></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header结束 -->