<?php
namespace asbamboo\security\user\login;

use asbamboo\http\ServerRequestInterface;

/**
 * 用户登录接口
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月6日
 */
interface LoginInterface
{
    /**
     * 登录处理
     * @param ServerRequestInterface $Request
     * @return bool
     */
    public function handler(ServerRequestInterface $Request) : bool;
}