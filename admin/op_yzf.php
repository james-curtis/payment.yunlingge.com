<?php
include("../oppay/common.php");
$title = '易支付配置';
include './head.php';
if ($islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
header("Content-type: text/html; charset=utf-8");
if (isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if ($x == 'pwd') continue;
        $value = daddslashes($value);
        $DB->query("insert into admin set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的接口信息已修改成功！');history.go(-1);</script>";
    exit();
}
if (empty($conf['yzf_alipay_id']) || $conf['yzf_alipay_id'] == '' || empty($conf['yzf_alipay_key']) || $conf['yzf_alipay_key'] == '') {
    $aszt1 = "非法参数或不正确！";
} else {
    $post1 = json_decode(curl_get($conf['yzf_alipay_api'] . 'api.php?act=query&pid=' . $conf['yzf_alipay_id'] . '&key=' . $conf['yzf_alipay_key']), 1);
    $aszt1 = "获取成功！";
    if ($post1[code] == '1') {
    } else {
        $aszt1 = "连接失败！";
    }
}
if (empty($conf['yzf_wxpay_id']) || $conf['yzf_wxpay_id'] == '' || empty($conf['yzf_wxpay_key']) || $conf['yzf_wxpay_key'] == '') {
    $aszt2 = "非法参数或不正确！";
} else {
    $post2 = json_decode(curl_get($conf['yzf_wxpay_api'] . 'api.php?act=query&pid=' . $conf['yzf_wxpay_id'] . '&key=' . $conf['yzf_wxpay_key']), 1);
    $aszt2 = "获取成功！";
    if ($post2[code] == '1') {
    } else {
        $aszt2 = "连接失败！";
    }
}
if (empty($conf['yzf_qqpay_id']) || $conf['yzf_qqpay_id'] == '' || empty($conf['yzf_qqpay_key']) || $conf['yzf_qqpay_key'] == '') {
    $aszt3 = "非法参数或不正确！";
} else {
    $post3 = json_decode(curl_get($conf['yzf_qqpay_api'] . 'api.php?act=query&pid=' . $conf['yzf_qqpay_id'] . '&key=' . $conf['yzf_qqpay_key']), 1);
    $aszt3 = "获取成功！";
    if ($post3[code] == '1') {
    } else {
        $aszt3 = "连接失败！";
    }
}
if (empty($conf['yzf_tenpay_id']) || $conf['yzf_tenpay_id'] == '' || empty($conf['yzf_tenpay_key']) || $conf['yzf_tenpay_key'] == '') {
    $aszt4 = "非法参数或不正确！";
} else {
    $post4 = json_decode(curl_get($conf['yzf_tenpay_api'] . 'api.php?act=query&pid=' . $conf['yzf_tenpay_id'] . '&key=' . $conf['yzf_tenpay_key']), 1);
    $aszt4 = "获取成功！";
    if ($post4[code] == '1') {
    } else {
        $aszt4 = "连接失败！";
    }
}
?>

<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">易支付配置</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">接口设置</a></li>
                            <li class="breadcrumb-item active" aria-current="page">易支付配置</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">易支付接口调用状态</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8"><p class="mb-0"><code>温馨提示：</code>请时刻留意对接信息是否被篡改，如发现异常，请及时联系上家修改！</p>
                            </div>
                        </div>
                        <hr>
                        <li class='list-group-item'><b>当前支付宝接口：</b><?php echo $conf['yzf_alipay_api'] ?> <a
                                    href="<?php echo $conf['yzf_alipay_api'] ?>" class="btn btn-danger">点此访问</a></li>
                        <li class='list-group-item'><b>获取状态：</b><?php echo $aszt1 ?>
                            <br/><b>余额：</b><?php echo $post1[money] ?>元<br/><b>结算账号：</b><?php echo $post1[account] ?>
                            <br/><b>结算姓名：</b><?php echo $post1[username] ?></li>
                        <li class='list-group-item'><b>当前微信支付接口：</b><?php echo $conf['yzf_wxpay_api'] ?> <a
                                    href="<?php echo $conf['yzf_wxpay_api'] ?>" class="btn btn-danger">点此访问</a></li>
                        <li class='list-group-item'><b>获取状态：</b><?php echo $aszt2 ?>
                            <br/><b>余额：</b><?php echo $post2[money] ?>元<br/><b>结算账号：</b><?php echo $post2[account] ?>
                            <br/><b>结算姓名：</b><?php echo $post2[username] ?></li>
                        <li class='list-group-item'><b>当前QQ钱包接口：</b><?php echo $conf['yzf_qqpay_api'] ?> <a
                                    href="<?php echo $conf['yzf_qqpay_api'] ?>" class="btn btn-danger">点此访问</a></li>
                        <li class='list-group-item'><b>获取状态：</b><?php echo $aszt3 ?>
                            <br/><b>余额：</b><?php echo $post3[money] ?>元<br/><b>结算账号：</b><?php echo $post3[account] ?>
                            <br/><b>结算姓名：</b><?php echo $post3[username] ?></li>
                        <li class='list-group-item'><b>当前财付通接口：</b><?php echo $conf['yzf_tenpay_api'] ?> <a
                                    href="<?php echo $conf['yzf_tenpay_api'] ?>" class="btn btn-danger">点此访问</a></li>
                        <li class='list-group-item'><b>获取状态：</b><?php echo $aszt4 ?>
                            <br/><b>余额：</b><?php echo $post4[money] ?>元<br/><b>结算账号：</b><?php echo $post4[account] ?>
                            <br/><b>结算姓名：</b><?php echo $post4[username] ?></li>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">官方推荐商家</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">名称</th>
                            <th scope="col">星级</th>
                            <th scope="col">域名</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">易支付配置</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form class="needs-validation" action="./op_yzf.php?mod=site_n" method="post" role="form">
                            <div class="form-row">
                                <div class="col-md-12 mb-3"><label class="form-control-label">支付宝接口地址:</label><input
                                            type="text" name="yzf_alipay_api" class="form-control text-primary"
                                            value="<?php echo $conf['yzf_alipay_api']; ?>"></div>
                                <div class="col-md-12 mb-3"><label class="form-control-label">支付宝接口商户ID:</label><input
                                            type="text" name="yzf_alipay_id" class="form-control text-primary"
                                            value="<?php echo $conf['yzf_alipay_id']; ?>"></div>
                                <div class="col-md-12 mb-3"><label class="form-control-label">支付宝接口商户密钥:</label><input
                                            type="text" name="yzf_alipay_key" class="form-control text-primary"
                                            value="<?php echo $conf['yzf_alipay_key']; ?>"></div>
                            </div>
                            <hr/>
                            <div class="form-row">
                                <div class="col-md-12 mb-3"><label class="form-control-label">微信支付接口地址:</label><input
                                            type="text" name="yzf_wxpay_api" class="form-control text-green"
                                            value="<?php echo $conf['yzf_wxpay_api']; ?>"></div>
                                <div class="col-md-12 mb-3"><label class="form-control-label">微信支付接口商户ID:</label><input
                                            type="text" name="yzf_wxpay_id" class="form-control text-green"
                                            value="<?php echo $conf['yzf_wxpay_id']; ?>"></div>
                                <div class="col-md-12 mb-3"><label class="form-control-label">微信支付接口商户密钥:</label><input
                                            type="text" name="yzf_wxpay_key" class="form-control text-green"
                                            value="<?php echo $conf['yzf_wxpay_key']; ?>"></div>
                            </div>
                            <hr/>
                            <div class="form-row">
                                <div class="col-md-12 mb-3"><label class="form-control-label">QQ钱包接口地址:</label><input
                                            type="text" name="yzf_qqpay_api" class="form-control text-danger"
                                            value="<?php echo $conf['yzf_qqpay_api']; ?>"></div>
                                <div class="col-md-12 mb-3"><label class="form-control-label">QQ钱包接口商户ID:</label><input
                                            type="text" name="yzf_qqpay_id" class="form-control text-danger"
                                            value="<?php echo $conf['yzf_qqpay_id']; ?>"></div>
                                <div class="col-md-12 mb-3"><label class="form-control-label">QQ钱包接口商户密钥:</label><input
                                            type="text" name="yzf_qqpay_key" class="form-control text-danger"
                                            value="<?php echo $conf['yzf_qqpay_key']; ?>"></div>
                            </div>
                            <hr/>
                            <div class="form-row">
                                <div class="col-md-12 mb-3"><label class="form-control-label">财付通接口地址:</label><input
                                            type="text" name="yzf_tenpay_api" class="form-control text-defaut"
                                            value="<?php echo $conf['yzf_tenpay_api']; ?>"></div>
                                <div class="col-md-12 mb-3"><label class="form-control-label">财付通接口商户ID:</label><input
                                            type="text" name="yzf_tenpay_id" class="form-control text-defaut"
                                            value="<?php echo $conf['yzf_tenpay_id']; ?>"></div>
                                <div class="col-md-12 mb-3"><label class="form-control-label">财付通接口商户密钥:</label><input
                                            type="text" name="yzf_tenpay_key" class="form-control text-defaut"
                                            value="<?php echo $conf['yzf_tenpay_key']; ?>"></div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"
                                                                                        id="invalidCheck"
                                                                                        type="checkbox"
                                                                                        required=""><label
                                            class="custom-control-label" for="invalidCheck">我已确保为本人修改信息</label></div>
                            </div>
                            <button class="btn btn-primary form-control" type="submit" name="submit">确定修改</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 主页结束 -->
    <?php include 'foot.php'; ?>
    <script>var items = $("select[default]");
        for (i = 0; i < items.length; i++) {
            $(items[i]).val($(items[i]).attr("default"))
        }</script>