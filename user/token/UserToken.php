<?php
namespace asbamboo\security\user\token;

use asbamboo\session\SessionInterface;
use asbamboo\security\user\UserInterface;
use asbamboo\security\user\AnonymousUser;

/**
 * 用户访问令牌（通过session管理用户信息）
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class UserToken implements UserTokenInterface
{
    /**
     * @var SessionInterface
     */
    protected $Session;

    /**
     * 存储用户信息的session key
     * @var string
     */
    private $session_key;

    /**
     * 未登录时显示的用户名称
     * @var string
     */
    private $anonymous_name;

    /**
     * @param SessionInterface $Session
     * @param string $session_key
     * @param string $anonymous_name
     */
    public function __construct(SessionInterface $Session, string $session_key = 'security_user_token', string $anonymous_name = '匿名用户')
    {
        $this->Session          = $Session;
        $this->session_key      = $session_key;
        $this->anonymous_name   = $anonymous_name;
    }

    /**
     * 将用户写入到Session
     * {@inheritDoc}
     * @see \asbamboo\security\user\token\UserTokenInterface::setUser()
     */
    public function setUser(UserInterface $user): UserTokenInterface
    {
        $serialize_user = serialize($user);

        $this->Session->set($this->session_key, $serialize_user);

        return $this;
    }

    /**
     * 从Session中读取用户信息
     * {@inheritDoc}
     * @see \asbamboo\security\user\token\UserTokenInterface::getUser()
     */
    public function getUser(): UserInterface
    {
        $serialize_user     = $this->Session->get($this->session_key);
        if($serialize_user){
            $user           = unserialize($serialize_user);
        }else{
            // 如果用户没有登录，session标记为未登录用户
            $user           = new AnonymousUser($this->anonymous_name);
            $this->setUser($user);
        }
        return $user;
    }
}
