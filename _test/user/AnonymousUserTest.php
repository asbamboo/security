<?php
namespace asbamboo\security\_test\user;

use PHPUnit\Framework\TestCase;
use asbamboo\security\user\AnonymousUser;
use asbamboo\security\user\Role;

/**
 * test 未登录用户实例
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
class AnonymousUserTest extends TestCase
{
    public $user;

    public $login_name;

    public function setUp()
    {
        $this->login_name   = "未登录用户";
        $this->user         = new AnonymousUser($this->login_name);
    }

    public function testGetLoginPassword()
    {
        $this->assertEmpty($this->user->getLoginPassword());
    }

    public function testGetRoles()
    {
        $this->assertEquals([Role::ANONYMOUS], $this->user->getRoles());
    }

    public function testGetLoginName()
    {
        $this->assertEquals($this->login_name, $this->user->getLoginName());
    }
}