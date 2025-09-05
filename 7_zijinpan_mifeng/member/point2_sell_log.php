<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '金币卖出记录 - ';

require_once 'inc_header.php';
?>

<nav class="nav3 p">
    <i class="btn2"><a href="javascript:history.go(-1)">返回</a></i>
    <strong><?php echo $pageTitle . $webInfo['h_webName']; ?></strong>
</nav>

<!--MAN -->

<div class="gao1"></div>



<div class="panel panel-default">
  <div class="panel-heading">金币卖出列表</div>
   
<div class="panel-body">
<strong><span style="color:#F00;">警告:</span></strong><br>
<span style="color:#F00;">1.如果买家已把钱币打到你支付宝，而你超过12小时不确认收款，公司将没收你本次交易金币</span><br>
</div>
   
<table class="table table-striped table-hover">
  <tr>
    <td>单号ID</td>
    <td>挂单金额</td>
    <td>收款支付宝信息</td>
    <td>联系信息</td>
    <td>状态</td>
    <td>买家信息</td>
    <td>操作</td>
  </tr>
  
<?php
list_();
function list_(){
	global $rewriteOpen,$db;
	global $page,$total_count,$met_pageskin;
	global $mid,$mType,$mTitle,$mPageKey;
	global $cid,$cPageKey;
	global $memberLogged_userName;
	$mid = 111;
	$total_count = $db->counter('h_point2_sell', "h_userName = '{$memberLogged_userName}'", 'id');
	$page = (int)$page;
	if($page_input){$page=$page_input;}
	$list_num = 10;
	$met_pageskin = 5;
	$rowset = new Pager($total_count,$list_num,$page);
	$from_record = $rowset->_offset();
	$query = "select * from `h_point2_sell` where h_userName = '{$memberLogged_userName}' order by h_addTime desc,id desc LIMIT $from_record, $list_num";
	$result = $db->query($query);
	while($list = $db->fetch_array($result))
	{
		$rs_list[]=$list;
	}
	if($rewriteOpen == 1)
	{
		$page_list = $rowset->link("/$mPageKey/page",".html");
	}
	else
	{
		$page_list = $rowset->link(GetUrl(2) . "?page=");
	}

	if(count($rs_list) > 0)
	{
		foreach ($rs_list as $key=>$val)
		{
			echo '  <tr>
				<td>' , $val['id'] , '</td>
				<td>' , $val['h_money'] , '金币</td>
				<td>支付宝帐号：' , $val['h_alipayUserName'] , '<br />支付宝户名：' , $val['h_alipayFullName'] , '</td>
				<td>微信：' , $val['h_weixin'] , '<br />手机：' , $val['h_tel'] , '</td>
				<td>' , $val['h_state'] , '</td>
				<td>';
if(strlen($val['h_buyUserName']) > 0){
	echo $val['h_buyUserName'] , '<br />';
	echo $val['h_buyTime'] , '<br />';
	if($val['h_buyIsPay']){
		echo '<span style="color:#0000ff">已付款</span><br />';
	}else{
		echo '<span style="color:#ff0000">未付款</span><br />';
	}
}else{
	echo '-';
}
				echo '</td>
				<td>';
				
				if($val['h_state'] == '等待卖家确认收款'){
					echo '<button onclick="jinbi_queren(' , $val['id'] , ')" class="btn btn-success guadan_go" type="button">我已收到款</button>';
				}else if($val['h_state'] == '挂单中'){
					echo '<button onclick="jinbi_chedan(' , $val['id'] , ')" class="btn btn-danger" type="button">放弃拍卖</button>';
				}else{
					echo '-';
				}
				
				echo '</td>
			  </tr>';
		}
	}
	else
	{
		echo '<tr><td colspan="99">暂无记录</td></tr>';
	}

	if(count($rs_list) > 0) echo "<tr>
                    <td colspan='99'>{$page_list}</td>
                </tr>";
}
?>
 
</table>


</div>
</div>
<!--MAN End-->
</div></div>

 <script>
	mgo(47);
	var indexdd;
	
	function jinbi_chedan(rid){
	    layer.msg("确认撤回本次交易?.",{time: 20000, btn: ['确定撤单', '我点错了'],btn1: function(){jihuo_chedan2(rid)}});	
		}
		
	function jihuo_chedan2(c){
		tishi2();
		$.get("/member/bin.php?act=point2_sell_quit&id="+encodeURI(c),function(e){
			tishi2close();
			if(e!=""){
				if(unescape(e)=='修改成功'){
					layer.msg("撤单成功,金币已经返回到您的账户中,3秒后返回",function(){location.reload();});
					}else{
					layer.msg(unescape(e))
					}
				}
			},'html');
		}	
		
		
	function jinbi_queren(rid){
	    layer.msg("请确认买家已经把钱币打到您的支付宝账户.",{time: 20000, btn: ['确定已打款', '我点错了'],btn1: function(){jihuo_queren2(rid)}});	
		}
		
	function jihuo_queren2(c){
		tishi2();
		$.get("/member/bin.php?act=point2_sell_confirm&id="+encodeURI(c),function(e){
			tishi2close();
			if(e!=""){
				if(unescape(e)=='修改成功'){
					layer.msg("本次交易成功,金币已经打入买家账户,3秒后返回",function(){location.reload();});
					}else{
					layer.msg(unescape(e))
					}
				}
			},'html');
		}
	
	
   </script>
    
<?php
require_once 'inc_footer.php';
?>