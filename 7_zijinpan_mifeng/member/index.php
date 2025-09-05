<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '';

require_once 'inc_header.php';
require_once '1.php';
?>

<?php
$sql = "select *";
$sql .= ",(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers";
$sql .= ",(select sum(h_price) from `h_log_point2` where h_userName = a.h_userName and h_price > 0) as point2sum";
$sql .= " from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>

 <div class="user_top" align="center">
 <div class="tx"><img class="user_tb" src="/picture/noavatar_middle.jpg"></div>
 <div class="name">我的ID：<?php echo $rs['h_userName'];?></div>
 <div class="bdziti" style="width:100%; float:left;">
 <ul>
   <li><span>余额：<?php echo $rs['h_point2'];?></span></li>
   <li><span>业绩：<?php echo $rs['point2sum'] + 0;?></span></li>
   <li style="border:none;"><span>直推数量：<?php echo $rs['comMembers'];?></span></li>
 </ul>
 </div>
 </div>
	<div class="vipduo_user clear">
		<div class="vipduo_tu">
			
			<a href="/member/point2_log_in.php"><img src="/picture/fx1.png"><p>账户收入</p></a>
			<a href="/member/point2_log_out.php"><img src="/picture/jl.png"><p>账户支出</p></a>
			<a href="/member/jintix.php"><img src="/picture/u-sign.png"><p>申请提现</p></a>
			<a href="/member/point2_withdraw_log.php"><img src="/picture/mx.png"><p>提现明细</p></a>
                        <a href="/member/point2_transfer.php"><img src="/picture/tc.png"><p>金币转账</p></a>
			<a href="/member/tuiguang.php"><img src="/picture/zhuan1.png"><p>推广赚钱</p></a>
			<a href="/member/pi.php"><img src="/picture/qqfh.png"><p>信息修改</p></a>
                        <a href="/member/msg.php"><img src="/picture/qqfh.png"><p>讯息传送</p></a>
			<a href="/member/com_list.php"><img src="/picture/qt1.png"><p>我的团队</p></a>
			<a href="/member/rr.php"><img src="/picture/u-msg.png"><p>团队结构</p></a>
			<a href="/images/zaixiankefu.png" onclick="showImg()"><img src="/picture/qq.png"><p>联系客服</p></a>
			
                        <a href="/member/logout.php"><img src="/picture/tc.png"><p>退出登录</p></a>
              
		</div>
	</div>
</div>
<div class="bg_img" style="background:rgba(0,0,0,0.4);top:0px;display:none;position:fixed;width:100%;height:100%;z-index:999999"></div>
<img class="img" src="/picture/kfewm.jpg" style="display:none;position:absolute;top:30%;left:50%;width:180px;margin-left:-90px;z-index:9999999"/>

</body>
</html>

<?php
require_once 'inc_footer.php';
?>