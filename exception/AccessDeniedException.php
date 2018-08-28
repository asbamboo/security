<?php
namespace asbamboo\security\exception;

/**
 * exception 没有权限时，拒绝访问
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月11日
 */
class AccessDeniedException extends \RuntimeException implements SecurityExceptionInterface
{
    public function __construct(string $message="对不起，您没有访问权限。", \Exception $previous = null)
    {
        parent::__construct($message, 403, $previous);
    }
}