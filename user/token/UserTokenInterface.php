<?php
namespace asbamboo\security\user\token;

use asbamboo\security\user\UserInterface;

/**
 * 用户访问令牌
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月9日
 */
interface UserTokenInterface
{
    /**
     * 设置用户信息
     * 应该将用户信息写入session
     *
     * @param UserInterface $user
     * @return self
     */
    public function setUser(UserInterface $user) : self;

    /**
     * 获取用户信息
     * 应该从session获取用户信息
     *
     * @return UserInterface
     */
    public function getUser() : UserInterface;
}