<?php
namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\Db;

class GetMarket extends Command
{
    protected function configure()
    {
        $this->setName('getmarket')
        	->addArgument('name', Argument::OPTIONAL, "your name")
            ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
        	->setDescription('Say Hello');
    }

    protected function execute(Input $input, Output $output)
    {
        //查询基金代码
    	$fund = Db::name('fundcode')->order('seek_sum')->limit(300)->select();
    	//基本数据
    	$type = '/getFundDetail';
    	foreach($fund as $key => $val){
    	    //判断是否已经存在
    	    $extends_fund_code = \app\api\model\Fund::get(['fund_code' => $val['code']]);
    	    if($extends_fund_code) {
    	        $output->writeln("基金代码".$val['code'].'-------已存在');
    	        continue; 
    	    }
    	    //获取基金数据
    	    $res = get_fund_list($val['code'], $type);
    	    $insert = [];
            foreach($res['fundFullInfo'] as $k => $v){
                //将键值更改
                $insert[capital_to_underline($k)] = $v;
            }
            //公募基金
            $insert['type'] = \app\api\model\Fund::TYPE_PUBLIC;
            //保存
            $res = (new \app\api\model\Fund)->save($insert);
            $output->writeln("基金代码".$val['code'].'-------采集完毕');
    	}
    	$output->writeln('GetMarket采集完毕----------采集完毕');
    }
}