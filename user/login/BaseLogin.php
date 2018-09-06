<?php
namespace asbamboo\security\user\login;

use asbamboo\security\exception\NotUserInterfaceException;
use asbamboo\security\exception\UserNotExistsException;
use asbamboo\security\exception\NotEqualPasswordException;
use asbamboo\security\user\provider\UserProviderInterface;
use asbamboo\security\user\token\UserTokenInterface;
use asbamboo\security\user\UserInterface;
use asbamboo\event\EventScheduler;
use asbamboo\security\Event;
use asbamboo\http\ServerRequestInterface;

/**
 * 登录处理器
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class BaseLogin implements LoginInterface
{
    /**
     * input参数登录名
     * @var string
     */
    protected $input_name       = 'login_name';

    /**
     * input参数登录密码
     * @var string
     */
    protected $input_password   = 'login_password';

    /**
     * 用户信息供给器，用来根据{$input_name}查询用户信息
     * @var UserProviderInterface
     */
    protected $UserProvider;

    /**
     * 用户访问令牌用户标记用户信息
     * @var UserTokenInterface
     */
    protected $UserToken;

    /**
     * @param UserProviderInterface $UserProvider
     * @param UserTokenInterface $UserToken
     */
    public function __construct(UserProviderInterface $UserProvider, UserTokenInterface $UserToken)
    {
        $this->UserProvider = $UserProvider;
        $this->UserToken    = $UserToken;
    }

    /**
     * 设置参数 登录名
     * @param string $login_name
     * @return self
     */
    public function setInputName(string $login_name) : self
    {
        $this->input_name = $login_name;
        return $this;
    }

    /**
     * 设置参数 登录密码
     * @param string $login_password
     * @return self
     */
    public function setInputPassword(string $login_password) : self
    {
        $this->input_password = $login_password;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\user\login\LoginInterface::handler()
     */
    public function handler(ServerRequestInterface $Request) : bool
    {
        /*
         * Request 参数
         */
        $login_name         = $Request->getPostParam($this->input_name, '');
        $login_password     = $Request->getPostParam($this->input_password, '');

        /*
         * load user
         */
        $user               = $this->UserProvider->loadByLoginName($login_name);

        /*
         * 验证
         */
        if($user == null){
            throw new UserNotExistsException('用户名或者密码错误。');
        }else if(!$user instanceof UserInterface){
            throw new NotUserInterfaceException('用户信息供给器[UserProvider]返回的值，未能实现UserInterface接口。');
        }else if($user->isEqualPassword($login_password) == false){
            throw new NotEqualPasswordException('用户名或者密码错误。');
        }

        /*
         * set session
         */
        $this->UserToken->setUser($user);

        /*
         * 触发事件
         */
        EventScheduler::instance()->on(Event::LOGIN_SUCCESS, $this->UserToken);

        /*
         * return
         */
        return true;
    }
}
