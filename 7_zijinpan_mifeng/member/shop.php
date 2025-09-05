<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '蜜蜂赚 - ';

require_once 'inc_header.php';
?>

<link href="/css/brand.css" rel="stylesheet"

<!--MAN -->
<div class="gao1"></div>
<img src="/picture/banner.jpg" style="width: 100%" alt="wap幻灯片"/>

<?php
$sql = "select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>

<?php
	$query = "select * from `h_farm_shop` order by h_minMemberLevel asc,id asc";
	$result = $db->query($query);
	$rs2 = $db->get_one("select sum(h_num) as sumNum from `h_member_farm` where h_userName = '{$memberLogged_userName}' and h_pid = '{$rs_list['id']}' and h_isEnd = 0");
	while($rs_list = $db->fetch_array($result))
	{
		$lifePoint2 = intval($rs_list['h_point2Day']) * intval($rs_list['h_life']);
		
			echo '                                                    <li>
                            <div class="types-con">
                                <a class="types-info row">
                                    <div class="types-img lazy"> <img src="' , $rs_list['h_pic'] , '"></div>
                                    <div class="types-item row">
                                        <span class="name">' . $rs_list['h_title'] . '</span>
                                        <span class="price">
										<i class="clr">日收益' . $rs_list['h_point2Day'] . '元</br>周期' . $rs_list['h_life'] . '天    总共收益' . ($rs_list['h_point2Day'] * $rs_list['h_life']) . '元</i></span>
										<span class="type"></span>
                                    </div>
									</a>
									<a href="' . $url = GetUrl(1) . '/member/bin.php?act=farm_shop_buy&goodsIds=' . $rs_list['id'] . '&goodsNums=1"  class="type-ask "><i class="btn03-bg icon"></i>立即购买</a>
								    </div>
									</li>';
									
	}
	
?>

<!--http://ruihexin.cn/member/bin.php?act=farm_shop_buy&goodsIds=109&goodsNums=1-->
</table>
</div>
<!--MAN End-->
</div></div>
    <script>
	$("#goumaigo").click(function(e){
		var url="<?php echo $arr;?>"
		
		tishi2();
		$.get(url,function(e){
			tishi2close();
			
			if(unescape(e)=="购买成功"){
					layer.msg('恭喜,购买成功',{shade:0.3,end:function(){
						location.reload();
						}});
				}else{
					layer.msg(unescape(e));
					}
			},'html'
			);
    });
    </script>
<?php
require_once 'inc_footer.php';

?>