<?php
$mod='blank';
include("../oppay/common.php");
$title='结算操作';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

		<div class="header bg-primary pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">结算操作</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">资金管理</a></li><li class="breadcrumb-item active" aria-current="page">结算操作</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                结算操作
              </h3>
              <p class="text-sm mb-0">
                结算标准：金额大于<?php echo $conf['settle_money']?>元，需扣除<?php $a=100;$b=$conf['settle_rate'];echo $a*$b?>%手续费<br/>结算列表请勿重复生成，CSV文件可以重复下载！
              </p>
            </div>
            <div class="table-responsive py-4">
            	<?php
								if(isset($_GET['batch'])){
									$batch=$_GET['batch'];
									$allmoney=$_GET['allmoney'];
									$count=$DB->query("SELECT * from pay_settle where batch='$batch'")->rowCount();
									$srow=$DB->query("SELECT * FROM pay_batch WHERE batch='{$batch}' limit 1")->fetch();
									if($srow['status']==0){
										$rs=$DB->query("SELECT * from pay_settle where batch='$batch'");
										while($row = $rs->fetch())
										{
											$dcmoney=$row['money']+$row['fee'];
											$DB->exec("update `pay_user` set `money`=`money`-'{$dcmoney}',`apply`='0' where `id`='{$row['pid']}'");
											$DB->exec("update `pay_settle` set `status`='1' where `id`='{$row['id']}'");
										}
										$DB->exec("update `pay_batch` set `status`='1' where `batch`='{$batch}'");
									}
								?>
            	<form action="download.php"method="get"role="form"class="text-center"><input type="hidden"name="batch"value="<?php echo $batch?>"/><input type="hidden"name="allmoney"value="<?php echo $allmoney?>"/><p class="text-sm mb-0 text-center">当前需要结算的共有<?php echo $count?>条记录<br/>批次号：<?php echo $batch?><br/>总金额：<?php echo $allmoney?>元</p><input type="submit"value="下载CSV文件"class="btn btn-primary"/></form><br/><form action="transfer.php"method="get"role="form"class="text-center"><input type="hidden"name="batch"value="<?php echo $batch?>"/><input type="submit"value="单笔转账到支付宝账户"class="btn btn-info"/></form><br/><form action="wxtransfer.php"method="get"role="form"class="text-center"><input type="hidden"name="batch"value="<?php echo $batch?>"/><input type="submit"value="微信企业付款"class="btn btn-success"/>
            	</form>
            	<?php }else{?>
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>批次号</th><th>总金额</th><th>生成时间</th><th>状态</th><th>操作</th></tr></thead><tfoot><tr><th>批次号</th><th>总金额</th><th>生成时间</th><th>状态</th><th>操作</th></tr></tfoot>
                <tbody>
                  <?php
                  	$rs=$DB->query("SELECT * FROM pay_batch WHERE 1 order by time desc limit 10");
                    foreach($rs as $res){
                    echo '<tr><td><b>'.$res['batch'].'</b></td><td>'.$res['allmoney'].'</td><td>'.$res['time'].'</td><td>'.($res['status']==1?'<font color=green>已完成</font>':'<font color=red>未完成</font>').'</td><td><a href="./settle.php?batch='.$res['batch'].'&allmoney='.$res['allmoney'].'" class="btn btn-sm btn-primary" onclick="return confirm(\'是否确定生成本批次结算列表？\');">生成结算列表</a></td></tr>';
                  }?>
                </tbody>
              </table>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>