<?php
namespace asbamboo\security\gurad\authorization;

use asbamboo\security\exception\AccessDeniedException;
use PHPUnit\Framework\TestCase;
use asbamboo\security\user\AnonymousUser;
use asbamboo\http\ServerRequest;
use asbamboo\security\user\Role;

/**
 * 测试权限认证器
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月11日
 */
class AuthenticatorTest extends TestCase
{
    /**
     * 测试权限未通过
     */
    public function testValidate1()
    {
        $user           = new AnonymousUser();
        $request        = new ServerRequest();
        $rule           = new Rule('$user->getRoles() == ["r1"] && strpos($request->getPath(), "/") === 0');
        $ruleCollection = new RuleCollection();
        $ruleCollection->addRule($rule);
        $authenticator  =  new Authenticator($ruleCollection);

        $this->expectException(AccessDeniedException::class);
        $authenticator->validate($user, $request);
    }

    /**
     * 测试权限认证通过
     */
    public function testValidateOk()
    {
        $user           = new AnonymousUser();
        $request        = new ServerRequest();
        $rule           = new Rule('$user->getRoles() == ["' . Role::ANONYMOUS . '"]');
        $ruleCollection = new RuleCollection();
        $ruleCollection->addRule($rule);
        $authenticator  =  new Authenticator($ruleCollection);

        $this->assertTrue($authenticator->validate($user, $request));
    }
}