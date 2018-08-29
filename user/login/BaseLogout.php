<?php
namespace asbamboo\security\user\login;

use asbamboo\http\ServerRequestInterface;
use asbamboo\security\user\token\UserTokenInterface;
use asbamboo\security\user\AnonymousUser;
use asbamboo\event\EventScheduler;
use asbamboo\security\Event;

/**
 * 注销登录
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月28日
 */
class BaseLogout implements LogoutInterface
{
    /**
     *
     * @var UserTokenInterface
     */
    private $UserToken;

    /**
     *
     * @param UserTokenInterface $UserToken
     */
    public function __construct(UserTokenInterface $UserToken)
    {
        $this->UserToken    = $UserToken;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\security\user\login\LogoutInterface::handler()
     */
    public function handler(ServerRequestInterface $Request) : bool
    {
        $user   = new AnonymousUser();
        $this->UserToken->setUser($user);

        /*
         * 触发事件
         */
        EventScheduler::instance()->on(Event::LOGOUT_SUCCESS, $this->UserToken);

        return true;
    }
}