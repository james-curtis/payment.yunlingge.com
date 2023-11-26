<?php
$mod = 'blank';
include("../oppay/common.php");
$title = '商户列表';
include './head.php';
if ($islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$numrows = $DB->query("SELECT * from pay_user WHERE 1")->rowCount();
?>

<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">商户列表</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">商户管理</a></li>
                            <li class="breadcrumb-item active" aria-current="page">商户列表</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <?php
    $my = isset($_GET['my']) ? $_GET['my'] : null;
    if ($my == 'add') {
        echo '<div class="row"><div class="col"><div class="card"><div class="card-header"><h3 class="mb-0">添加商户</h3></div><div class="card-body"><form action="./ulist.php?my=add_submit"method="POST"><div class="form-group"><label>结算方式:</label><select class="form-control"name="settle_id">' . ($conf['stype_1'] ? '<option value="1">支付宝</option>' : null) . '' . ($conf['stype_2'] ? '<option value="2">微信</option>' : null) . '' . ($conf['stype_3'] ? '<option value="3">QQ钱包</option>' : null) . '' . ($conf['stype_4'] ? '<option value="4">银行卡</option>' : null) . '</select></div><div class="form-group"><label>结算账号:</label><input type="text"class="form-control"name="account"value=""required></div><div class="form-group"><label>真实姓名:</label><input type="text"class="form-control"name="username"value=""required></div><div class="form-group"><label>商户密匙:</label><input type="text"class="form-control"name="key"value=""maxlength="12" placeholder="6~12位商户密匙"required></div><div class="form-group"><label>网站域名:</label><input type="text"class="form-control"name="url"value=""placeholder="可留空"></div><div class="form-group"><label>邮箱:</label><input type="text"class="form-control"name="email"value="' . $row['emali'] . '"required></div><div class="form-group"><label>ＱＱ:</label><input type="text"class="form-control"name="qq"value=""placeholder="可留空"></div><div class="form-group"><label>是否结算:</label><select class="form-control"name="type"><option value="1">1_是</option><option value="2">2_否</option></select></div><div class="form-group"><label>是否激活:</label><select class="form-control"name="active"><option value="1">1_激活</option><option value="0">0_封禁</option></select></div><input type="submit"class="btn btn-primary btn-block"value="确定添加"></form><br/><a href="./ulist.php">>>返回商户列表</a></div></div></div></div>';
    } elseif ($my == 'edit') {
        $id = $_GET['id'];
        $row = $DB->query("select * from pay_user where id='$id' limit 1")->fetch();
        echo '<div class="row"><div class="col"><div class="card"><div class="card-header"><h3 class="mb-0">修改商户信息</h3></div><div class="card-body"><form action="./ulist.php?my=edit_submit&id=' . $id . '"method="POST"><div class="form-group"><label>结算方式:</label><select class="form-control"name="settle_id"default="' . $row['settle_id'] . '">' . ($conf['stype_1'] ? '<option value="1">支付宝</option>' : null) . '' . ($conf['stype_2'] ? '<option value="2">微信</option>' : null) . '' . ($conf['stype_3'] ? '<option value="3">QQ钱包</option>' : null) . '' . ($conf['stype_4'] ? '<option value="4">银行卡</option>' : null) . '</select></div><div class="form-group"><label>结算账号:</label><input type="text"class="form-control"name="account"value="' . $row['account'] . '"required></div><div class="form-group"><label>真实姓名:</label><input type="text"class="form-control"name="username"value="' . $row['username'] . '"required></div><div class="form-group"><label>商户密匙:</label><input type="text"class="form-control"name="key"value="' . $row['key'] . '"maxlength="12" placeholder="6~12位商户密匙"required></div><div class="form-group"><label>商户余额:</label><input type="text"class="form-control"name="money"value="' . $row['money'] . '"required></div><div class="form-group"><label>网站域名:</label><input type="text"class="form-control"name="url"value="' . $row['url'] . '"placeholder="可留空"></div><div class="form-group"><label>邮箱:</label><input type="text"class="form-control"name="email"value="' . $row['email'] . '"></div><div class="form-group"><label>ＱＱ:</label><input type="text"class="form-control"name="qq"value="' . $row['qq'] . '"placeholder="可留空"></div><div class="form-group"><label>是否结算:</label><select class="form-control"name="type"default="' . $row['type'] . '"><option value="1">1_是</option><option value="2">2_否</option></select></div><div class="form-group"><label>是否激活:</label><select class="form-control"name="active"default="' . $row['active'] . '"><option value="1">1_激活</option><option value="0">0_封禁</option></select></div><input type="submit"class="btn btn-primary btn-block"value="确定修改"></form><br/><a href="./ulist.php">>>返回商户列表</a></div></div></div></div>';
    } elseif ($my == 'add_submit') {
        $settle_id = $_POST['settle_id'];
        $key = $_POST['key'];
        $account = $_POST['account'];
        $username = $_POST['username'];
        $key = $_POST['key'];
        $money = '0.00';
        $url = $_POST['url'];
        $email = $_POST['email'];
        $qq = $_POST['qq'];
        $type = $_POST['type'];
        $active = $_POST['active'];
        if ($account == NULL or $username == NULL or $key == NULL or $email == NULL) {
            echo "<script language='javascript'>alert('保存错误,请确保加*项都不为空!');</script>";
        } elseif (strlen($key) < 6) {
            echo "<script language='javascript'>alert('报告老大，您输入的密匙小于6位！');history.go(-1);</script>";
        } else {
            $sds = $DB->exec("INSERT INTO `pay_user` (`key`, `account`, `username`, `money`, `url`, `addtime`, `type`, `settle_id`, `email`, `qq`, `active`) VALUES ('{$key}', '{$account}', '{$username}', '{$money}', '{$url}', '{$date}', '{$type}', '{$settle_id}', '{$email}', '{$qq}',  '{$active}')");
            $pid = $DB->lastInsertId();
            if ($sds) {
                echo('<br/><br/><br/>添加商户成功！商户ID：' . $pid . '<br/>密钥：' . $key . '<br/><a href="./ulist.php">>>返回商户列表</a>');
            } else {
                echo "<script language='javascript'>alert('报告老大，添加商户失败！');history.go(-1);</script>";
            }
        }
    } elseif ($my == 'edit_submit') {
        $id = $_GET['id'];
        $rows = $DB->query("select * from pay_user where id='$id' limit 1")->fetch();
        if (!$rows)
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');</script>";
        $settle_id = $_POST['settle_id'];
        $key = $_POST['key'];
        $account = $_POST['account'];
        $username = $_POST['username'];
        $money = $_POST['money'];
        $url = $_POST['url'];
        $email = $_POST['email'];
        $qq = $_POST['qq'];
        $type = $_POST['type'];
        $active = $_POST['active'];
        if ($account == NULL or $username == NULL) {
            echo "<script language='javascript'>alert('保存错误,请确保加*项都不为空!');</script>";
        } elseif (strlen($key) < 6) {
            echo "<script language='javascript'>alert('报告老大，您输入的密匙小于6位！');history.go(-1);</script>";
        } else {
            $sql = "update `pay_user` set `key` ='{$key}',`account` ='{$account}',`username` ='{$username}',`money` ='{$money}',`url` ='{$url}',`type` ='$type',`settle_id` ='$settle_id',`email` ='$email',`qq` ='$qq',`active` ='$active' where `id`='$id'";
            if ($DB->exec($sql) || $sqs) {
                echo "<script language='javascript'>window.location.href='./ulist.php';</script>";
            } else {
                echo "<script language='javascript'>alert('报告老大，修改商户信息失败！');history.go(-1);</script>";
            }
        }
    } elseif ($my == 'delete') {
        $id = $_GET['id'];
        $rows = $DB->query("select * from pay_user where id='$id' limit 1")->fetch();
        if (!$rows)
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');</script>";
        $urls = explode(',', $rows['url']);
        $sql = "DELETE FROM pay_user WHERE id='$id'";
        if ($DB->exec($sql)) {
            echo "<script language='javascript'>window.location.href='./ulist.php';</script>";
        } else {
            echo "<script language='javascript'>alert('报告老大，修改商户信息失败！');</script>";
        }
    }
    ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">
                        商户列表
                    </h3>
                    <p class="text-sm mb-0">
                        共有 <b><?php echo $numrows ?></b> 个商户
                    </p>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th>商户号</th>
                            <th>密钥</th>
                            <th>余额</th>
                            <th>结算账号/真实姓名</th>
                            <th>域名/添加时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>商户号</th>
                            <th>密钥</th>
                            <th>余额</th>
                            <th>结算账号/真实姓名</th>
                            <th>域名/添加时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $rs = $DB->query("SELECT * FROM pay_user WHERE 1 order by id desc limit 0,$numrows");
                        foreach ($rs as $res) {
                            echo '<tr><td><b>' . $res['id'] . '</b></td><td>' . $res['key'] . '</td><td>' . $res['money'] . '</td><td>' . ($res['settle_id'] == 2 ? '<font color="green">WX:</font>' : null) . ($res['settle_id'] == 3 ? '<font color="green">QQ:</font>' : null) . $res['account'] . '<br/>' . $res['username'] . '</td><td>' . $res['url'] . '<br/>' . $res['addtime'] . '</td><td>' . ($res['active'] == 1 ? '<font color=green>正常</font>' : '<font color=red>封禁</font>') . '</td><td><a href="./ulist.php?my=edit&id=' . $res['id'] . '"">编辑</a>&nbsp;<a href="./ulist.php?my=delete&id=' . $res['id'] . '"" onclick="return confirm(\'你确实要删除此商户吗？\');">删除</a></td></tr>';
                        } ?>
                        </tbody>
                    </table>
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