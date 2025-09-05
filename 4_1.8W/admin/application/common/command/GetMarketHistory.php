<?php
namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\api\model\Fund;
use app\api\model\FundHistory;


class GetMarketHistory extends Command
{
    protected function configure()
    {
        $this->setName('getmarkethistory')
        	->addArgument('name', Argument::OPTIONAL, "your name")
            ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
        	->setDescription('Say Hello');
    }

    protected function execute(Input $input, Output $output)
    {
        //查询基金
        $fund_list = Fund::all(['type' => Fund::TYPE_PUBLIC]);
    	//历史净值
    	$type = '/fundHistory';
    	foreach($fund_list as $key => $val){
    	    //获取基金数据
    	    $res = get_fund_list($val['fund_code'], $type);
    	    $insert = [];
            foreach($res as $k => $v){
                //基金的历史数据是否存在
                $extend_fund_history = FundHistory::get(['date' => $v['date'], 'fund_code' => $v['fund_code']]);
                if($extend_fund_history) continue;
                foreach($v as $listKey => $list){
                    //将键值更改
                    $insert[$k][capital_to_underline($listKey)] = $list;
                    $insert[$k]['createtime'] = time();
                }
            }
            //保存
            $res = (new FundHistory)->insertAll($insert);
            $output->writeln("基金代码".$val['fund_code'].'-------历史净值采集完毕');
    	}
    	$output->writeln('GetMarketHistory采集完毕----------采集完毕');
    	//清除重复数据
    // 	$this->clearRepetitionList();
    }
    //检测并清除重复数据
    protected function clearRepetitionList(){
        //重复数据Sql
        $RepetitionSql = FundHistory::group('date,fund_code')->having('count(1) > 1')->buildSql();
        //删除数据
        $result = FundHistory::where('id', 'in', $RepetitionSql)->delete();
        $output->writeln('clearRepetitionList重复数据清除成功----------共清除'.$result.'条');
    }
}