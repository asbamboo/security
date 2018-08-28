<?php
namespace asbamboo\security\user\provider;

use asbamboo\security\user\UserInterface;

/**
 * 用户信息提供器
 * 用户根据登录名查找用户信息
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
interface UserProviderInterface
{
    /**
     * 通过登录名查找，用户信息。返回null（用户不存在）或者 user（UserInterface）
     * @param string $login_name
     * @return UserInterface|NULL
     */
    public function loadByLoginName(string $login_name) : ?UserInterface;
}