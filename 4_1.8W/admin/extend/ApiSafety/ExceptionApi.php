<?php
namespace ApiSafety;

/**
 * 接口安全异常类
 */
class ExceptionApi extends \Exception
{

    public function errorMessage()
    {
        return $this->getMessage();
    }
}
