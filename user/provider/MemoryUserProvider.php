<?php
namespace asbamboo\security\user\provider;

use asbamboo\security\user\UserInterface;
use asbamboo\security\user\BaseUser;

/**
 * 存储在代码运行过程中的用户
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class MemoryUserProvider implements UserProviderInterface
{
    /**
     * 存在系统用户信息
     * @var array
     */
    private $users  = [];

    /**
     * 添加用户
     * @param string $login_name
     * @param string $login_password
     * @param array $types
     */
    public function addUser(string $login_name, string $login_password, array $roles = []) : self
    {
        $this->users[$login_name]   = [
            'login_name'            => $login_name,
            'login_password'        => $login_password,
            'roles'                 => $roles,
        ];

        return $this;
    }

    /**
     * load user
     * @param string $login_name
     * @return UserInterface|NULL
     */
    public function loadByLoginName(string $login_name): ?UserInterface
    {
        if(array_key_exists($login_name, $this->users)){
            return $this->convertUser($this->users[$login_name]);
        }

        return null;
    }

    /**
     * 将用户信息 array 转换成 Base User
     * @param array $user
     * @return \asbamboo\security\user\BaseUser
     */
    private function convertUser(array $user) : UserInterface
    {
        $baseUser   = new BaseUser();
        $baseUser->setLoginName($user['login_name']);
        $baseUser->setLoginPassword($user['login_password']);
        $baseUser->setRoles($user['roles']);
        return $baseUser;
    }

}