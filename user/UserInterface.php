<?php
namespace asbamboo\security\user;

/**
 * 用户接口
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月6日
 */
interface UserInterface
{
    /**
     * 获取登录名
     * @return string
     */
    public function getLoginName() : string;

    /**
     * 获取登录密码
     * @return string
     */
    public function getLoginPassword() : ?string;

    /**
     * 密码加密
     * @return string
     */
    public function encodePassword(string $password) : ?string;

    /**
     * 比较密码是否等于用户当前密码
     * @param string $password
     * @return bool
     */
    public function isEqualPassword(string $password) : bool;

    /**
     * 用户角色
     *
     * @return array
     */
    public function getRoles() : array;
}