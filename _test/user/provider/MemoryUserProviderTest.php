<?php
namespace asbamboo\security\_test\user\provider;

use PHPUnit\Framework\TestCase;
use asbamboo\security\user\provider\MemoryUserProvider;
use asbamboo\security\user\UserInterface;

/**
 * test 存储在代码运行过程中的用户
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class MemoryUserProviderTest extends TestCase
{
    /**
     *
     * @var MemoryUserProvider
     */
    static $provider;

    public function setUp()
    {
        if(!static::$provider){
            static::$provider   = new MemoryUserProvider();
        }
    }

    public function testAddUser()
    {
        $user                   = [
            'login_name'        => 'test_user',
            'login_password'    => 'test_password',
            'roles'             => ['r1', 'r2'],
        ];
        $addedUser                   = static::$provider->addUser($user['login_name'], $user['login_password'], $user['roles']);

        $this->assertInstanceOf(MemoryUserProvider::class, $addedUser);

        return $user;
    }

    /**
     * 测试加载testAddUser中添加的用户
     * @depends testAddUser
     */
    public function testLoadByLoginName1($user)
    {
        $loadUser       = static::$provider->loadByLoginName($user['login_name']);

        $this->assertTrue($loadUser->isEqualPassword($user['login_password']));
        $this->assertEquals($user['roles'], $loadUser->getRoles());
    }

    /**
     * 测试加载不存在的用该沪
     */
    public function testLoadByLoginName2()
    {
        $login_name = 'not_exists_user';
        $user       = static::$provider->loadByLoginName($login_name);

        $this->assertNull($user);
    }
}