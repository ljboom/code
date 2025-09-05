<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '金币提现 - ';

require_once 'inc_header.php';
?>

<nav class="nav3 p">
    <i class="btn2"><a href="javascript:history.go(-1)">返回</a></i>
    <strong><?php echo $pageTitle . $webInfo['h_webName']; ?></strong>
</nav>

<!--MAN -->

<div class="gao1"></div>


<?php
$sql = "select * from `h_withdraw` where id = '{$_GET['oid']}' LIMIT 1";
$rs = $db->get_one($sql);
?>

<div class="panel panel-default">
  <div class="panel-heading">提现详情</div>
  
   <!--ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#t1" aria-controls="home" role="tab" data-toggle="tab">支付宝充值</a></li>
    <li role="presentation"><a href="#t2" aria-controls="profile" role="tab" data-toggle="tab">微信充值</a></li>
    <li role="presentation"><a href="#t3" aria-controls="messages" role="tab" data-toggle="tab">线下充值</a></li>
  </ul-->

<div class="panel-body">


<br />
<input type="hidden" name="act" id="act" value="rrr">
 <div class="form-group">
    <label for="x2" class="col-sm-2 control-label">提现金额</label>
    <div class="col-sm-10">
      <?php echo $rs['h_money']; ?> 元
	 
    </div>
  </div>
<br /><br />
   <div class="form-group">
    <label for="x2" class="col-sm-2 control-label" >到账金额</label>
    <div class="col-sm-10">
      
	 <?php echo $rs['h_money']-$rs['h_fee']; ?> 元<br />
	  
    </div>
  </div>
<br /><br />
     <div class="form-group">
    <label for="x2" class="col-sm-2 control-label" >提现状态</label>
    <div class="col-sm-10">
      
	 <?php echo $rs['h_state']; ?> <br />
	  
    </div>
  </div>

</div>




</div>
</div>
<!--MAN End-->
<?php
require_once 'inc_footer.php';
?>