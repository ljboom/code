<?php
namespace app\index\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class CashBack extends Command
{
    protected function configure()
    {
        $this->setName('cash_back')->setDescription('定時返現脚本');
    }

    protected function execute(Input $input, Output $output)
    {

    }
}