<?php
namespace asbamboo\security\user;

/**
 * 匿名用户
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class AnonymousUser extends BaseUser
{
    /**
     * @param string $login_name
     */
    public function __construct(string $login_name = '匿名用户')
    {
        $this->setLoginName($login_name);
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\security\user\BaseUser::getRoles()
     */
    public function getRoles() : array
    {
        return [Role::ANONYMOUS];
    }
}