<?php

namespace Pay;

use think\Db;
use think\facade\Env;

class USDT extends PayBase
{
    const PAY_BANK_LIST = [
        'TRC20' => 'TRC20',
        'ERC20' => 'ERC20'
    ];

    public function parsePayCallback($type = ''): array
    {
        // TODO: Implement parsePayCallback() method.
    }

    public function payCallbackSuccess()
    {
        // TODO: Implement payCallbackSuccess() method.
    }

    public function payCallbackFail()
    {
        // TODO: Implement payCallbackFail() method.
    }

    public function createPay(array $op_data): array
    {
        // TODO: Implement createPay() method.
    }

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        // TODO: Implement create_payout() method.
    }

    public function parsePayoutCallback($type = ''): array
    {
        // TODO: Implement parsePayoutCallback() method.
    }

    public function parsePayoutCallbackSuccess()
    {
        // TODO: Implement parsePayoutCallbackSuccess() method.
    }

    public function parsePayoutCallbackFail()
    {
        // TODO: Implement parsePayoutCallbackFail() method.
    }
}