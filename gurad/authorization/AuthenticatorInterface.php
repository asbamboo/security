<?php
namespace asbamboo\security\gurad\authorization;

use asbamboo\security\user\UserInterface;
use asbamboo\http\ServerRequestInterface;

/**
 * 权限认证器接口
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
interface AuthenticatorInterface
{
    /**
     * 权限验证
     */
    public function validate(UserInterface $user, ServerRequestInterface $request) : bool;
}