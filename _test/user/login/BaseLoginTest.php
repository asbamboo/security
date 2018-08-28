<?php
namespace asbamboo\security\_test\user\login;

use PHPUnit\Framework\TestCase;
use asbamboo\security\user\UserInterface;
use asbamboo\security\user\provider\MemoryUserProvider;
use asbamboo\security\user\login\BaseLogin;
use asbamboo\security\user\token\UserTokenInterface;
use asbamboo\http\ServerRequest AS Request;
use asbamboo\security\exception\UserNotExistsException;
use asbamboo\security\exception\NotEqualPasswordException;

/**
 * test 登录处理器
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class BaseLoginTest extends TestCase
{
    static $login;
    static $login_name;
    static $login_password;

    public function setUp()
    {
        if(! static::$login){
            static::$login_name     = 'base_login_test_name';
            static::$login_password = 'base_login_test_password';
            static::$login          = new BaseLogin(new TestUserProvider(static::$login_name, static::$login_password), new testToken());
        }
    }

    public function testSetInputName()
    {
        $input_name = 'test_login_id';
        $login      = static::$login->setInputName($input_name);
        $this->assertInstanceOf(BaseLogin::class, $login);
        return $input_name;
    }

    public function testSetInputPassword()
    {
        $input_password = 'test_login_password';
        $login          = static::$login->setInputPassword($input_password);
        $this->assertInstanceOf(BaseLogin::class, $login);
        return $input_password;
    }

    /**
     * 测试用户不存在
     * @depends testSetInputName
     * @depends testSetInputPassword
     */
    public function testHandler1($input_name, $input_password)
    {
        $_POST[$input_name]      = 'not_exists_username';
        $_POST[$input_password]  = 'not_exists_password';
        $request                    = new Request();

        $this->expectException(UserNotExistsException::class);
        static::$login->handler($request);
    }

    /**
     * 测试用户密码错误
     * @depends testSetInputName
     * @depends testSetInputPassword
     */
    public function testHandler2($input_name, $input_password)
    {
        $_POST[$input_name]      = static::$login_name;
        $_POST[$input_password]  = 'error password';
        $request                    = new Request();

        $this->expectException(NotEqualPasswordException::class);
        static::$login->handler($request);
    }

    /**
     * 测试成功登录
     * @depends testSetInputName
     * @depends testSetInputPassword
     */
    public function testHandlerOk($input_name, $input_password)
    {
        $_POST[$input_name]      = static::$login_name;
        $_POST[$input_password]  = static::$login_password;
        $request                    = new Request();

        $handler                = static::$login->handler($request);
        $this->assertTrue($handler);
    }
}

class TestUserProvider extends MemoryUserProvider
{
    public function __construct(string $login_name, string $login_password)
    {
        parent::addUser($login_name, $login_password);
    }
}

class testToken implements UserTokenInterface
{
    private $user;

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): UserTokenInterface
    {
        $this->user = $user;
        return $this;
    }
}