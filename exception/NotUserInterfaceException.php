<?php
namespace asbamboo\security\exception;

/**
 * 异常 提示UserProvider返回的User未能实现UserInterface
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月8日
 */
class NotUserInterfaceException extends \RuntimeException implements SecurityExceptionInterface
{
    
}
