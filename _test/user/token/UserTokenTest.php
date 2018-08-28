<?php
namespace asbamboo\security\_test\user\token;

use PHPUnit\Framework\TestCase;
use asbamboo\session\Session;
use asbamboo\security\user\token\UserToken;
use asbamboo\security\user\AnonymousUser;

/**
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class UserTokenTest extends TestCase
{
    /**
     *
     * @var UserToken
     */
    public $userToken;

    public function setUp()
    {
        $session                = new Session();
        $session->start();
        $this->userToken        = new UserToken($session);
    }

    /**
     * userToken 未设置 user的情况下直接getUser
     */
    public function testGetUser()
    {
        $user               = $this->userToken->getUser();

        $this->assertInstanceOf(AnonymousUser::class, $user);
    }

    /**
     * 通过 set user 判断get user得到的user是否就是set user
     * @depends testGetUser
     */
    public function testSetUser($userToken)
    {
        $user1   = new AnonymousUser();
        $this->userToken->setUser($user1);
        $user2   = $this->userToken->getUser();

        $this->assertEquals($user2, $user1);
    }
}
