<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '公告详情 - ';

require_once 'inc_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pager.php';
?>

<nav class="nav3 p">
    <i class="btn2"><a href="javascript:history.go(-1)">返回</a></i>
    <strong><?php echo $pageTitle . $webInfo['h_webName']; ?></strong>
</nav>

<!--MAN -->

<div class="gao1"></div>



<div class="panel panel-default">
  <div class="panel-heading">公告详情</div>
	<?php
    news_show();
    function news_show(){
        global $id;
        global $db;
        
        $id = intval($id);
        
        $sql = "select * from `h_article` where h_menuId = 108 and id = '{$id}' LIMIT 1";
        $rs = $db->get_one($sql);
        if($rs){
            echo '<div class="panel-body">';
            echo '<h3 style="text-align:center;">' , $rs['h_title'] , '</h3>';
            echo '<p style="text-align:right;">' , $rs['h_addTime'] , '</p>';
            echo '<p>' , $rs['h_info'] , '</p>';
            echo '</div>';
        }
    }
    ?>
 </div>
</div>
<!--MAN End-->
</div></div>

<script>
	$("#mlindex").addClass("btn-long16");
    </script>

<?php
require_once 'inc_footer.php';
?>