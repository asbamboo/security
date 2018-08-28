<?php
namespace asbamboo\security\exception;

/**
 * 异常 用户密码不能匹配
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月8日
 */
class NotEqualPasswordException extends \InvalidArgumentException implements SecurityExceptionInterface
{
    
}