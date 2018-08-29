<?php
namespace asbamboo\security\user\login;

use asbamboo\http\ServerRequestInterface;

/**
 * 用户登出
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月28日
 */
interface LogoutInterface
{
    /**
     * 登出处理
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function handler(ServerRequestInterface $Request) : bool;
}