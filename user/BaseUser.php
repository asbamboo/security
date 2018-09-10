<?php
namespace asbamboo\security\user;

/**
 * 基础用户类型
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class BaseUser implements UserInterface
{
    /**
     * 登录名
     * @var string
     */
    private $login_name;

    /**
     * 登录密码
     * @var string
     */
    private $login_password;

    /**
     * 用户类型
     * @var array
     */
    private $roles = [];

    /**
     * 设置登录名
     * @param string $login_name
     * @return UserInterface
     */
    public function setLoginName(string $login_name) : UserInterface
    {
        $this->login_name   = $login_name;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\user\UserInterface::getLoginName()
     */
    public function getLoginName(): string
    {
        return $this->login_name;
    }

    /**
     * 设置密码
     * @param string $password
     * @param bool $encoded
     * @return UserInterface
     */
    public function setLoginPassword(string $password, bool $encoded = false) : UserInterface
    {
        $this->login_password   = $encoded == true ? $password : $this->encodePassword($password);

        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\user\UserInterface::getLoginPassword()
     */
    public function getLoginPassword(): ?string
    {
        return $this->login_password;
    }

    /**
     * 判断密码值是否正确
     * {@inheritDoc}
     * @see \asbamboo\security\user\UserInterface::isEqualPassword()
     */
    public function isEqualPassword(string $password): bool
    {
        return password_verify($password, $this->getLoginPassword());
    }

    /**
     * 设置用户角色
     *
     * @param array $roles
     * @return UserInterface
     */
    public function setRoles(array $roles = []) : UserInterface
    {
        $this->roles    = $roles;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\user\UserInterface::getRoles()
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\user\UserInterface::encodePassword()
     */
    public function encodePassword(string $password): ?string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}