<?php
namespace asbamboo\security\_test\user;

use PHPUnit\Framework\TestCase;
use asbamboo\security\user\BaseUser;
use asbamboo\security\exception\UserTypeNotExistsException;

/**
 * test 基础用户类型
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class BaseUserTest extends TestCase
{
    /**
     *
     * @var BaseUser
     */
    static $user;

    public function setUp()
    {
        if(!static::$user){
            static::$user = new BaseUser();
        }
    }

    /**
     * 测试登录名的get 和 set
     */
    public function testSetLoginName()
    {
        $login_name         = 'test_login_name';
        $user               = static::$user->setLoginName($login_name);
        $this->assertInstanceOf(BaseUser::class, $user);
        return $login_name;
    }

    /**
     * @depends testSetLoginName
     */
    public function testGetLoginName($login_name)
    {
        $this->assertEquals($login_name, static::$user->getLoginName());
    }

    /**
     * 测试设置未加密的密码，然后校验密码是否正确
     */
    public function testSetLoginPassword1()
    {
        $password         = '123456';
        $user               = static::$user->setLoginPassword($password, false);
        $this->assertInstanceOf(BaseUser::class, $user);
        $this->assertTrue(static::$user->isEqualPassword($password));
    }

    /**
     * 测试设置已经加密的密码，然后校验获取的密码是否和设置的密码一致
     */
    public function testSetLoginPassword2()
    {
        $password   = static::$user->encodePassword('123456');
        $user       = static::$user->setLoginPassword($password, true);

        $this->assertEquals($password, static::$user->getLoginPassword());
    }

    /**
     * 测试设置超出范围的用户类型
     */
    public function testSetRoles()
    {
        $roles  = ['r1', 'r2', 'r3'];
        $user   = static::$user->setRoles($roles);
        $this->assertInstanceOf(BaseUser::class, $user);
        return $roles;
    }

    /**
     * @depends testSetRoles
     */
    public function testGetRoles($roles)
    {
        $this->assertEquals($roles, static::$user->getRoles());
    }
}