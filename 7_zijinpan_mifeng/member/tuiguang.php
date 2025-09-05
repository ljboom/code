<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '';

require_once 'inc_header.php';
?>

<!--MAN -->
<?php
$sql = "select *";
$sql .= ",(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers";
$sql .= ",(select sum(h_price) from `h_log_point2` where h_userName = a.h_userName and h_price > 0) as point2sum";
$sql .= " from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>

    <tr>
    <td colspan="3">
    <?php
        $url = GetUrl(1) . '/member/reg.php?t=' . $rs['h_userName'];
	?>
	
<!--    </br>链接推广: 
<input onclick="oCopy(this)" value="<?php echo $url; ?>">
<script language="javascript">
function oCopy(obj){
obj.select();
js=obj.createTextRange();
js.execCommand("Copy")
alert("复制成功!");



if($rs['point2sum'] <= 0){
	echo "<script>alert('未购买理财的用户不能推广!');history.back();</script>";  
}

}-->
</script>	
	</br>
	<style type="text/css">
   .img{text-align:center;}
   .img img{width:90%;}
</style>
  <p class="img"><img src="ewm.php?url=<?php echo urlencode($url);?>" /></p></br></div>
<script type="text/javascript">
	
	</td>
	
    </tr>

</table>

</div>

</div>



<!--MAN End-->
</div></div>

<?php
require_once 'inc_footer.php';
?>

