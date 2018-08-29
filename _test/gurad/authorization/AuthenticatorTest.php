<?php
namespace asbamboo\security\_test\gurad\authorization;

use asbamboo\security\exception\AccessDeniedException;
use PHPUnit\Framework\TestCase;
use asbamboo\security\user\AnonymousUser;
use asbamboo\http\ServerRequest;
use asbamboo\security\user\Role;
use asbamboo\security\gurad\authorization\Rule;
use asbamboo\security\gurad\authorization\RuleCollection;
use asbamboo\security\gurad\authorization\Authenticator;

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
        $User           = new AnonymousUser();
        $Request        = new ServerRequest();
        $Rule           = new Rule('$user->getRoles() == ["r1"] && strpos($request->getPath(), "/") === 0');
        $RuleCollection = new RuleCollection();
        $RuleCollection->addRule($Rule);
        $authenticator  =  new Authenticator($RuleCollection);

        $this->expectException(AccessDeniedException::class);
        $authenticator->validate($User, $Request);
    }

    /**
     * 测试权限认证通过
     */
    public function testValidateOk()
    {
        $User           = new AnonymousUser();
        $Request        = new ServerRequest();
        $Rule           = new Rule('$user->getRoles() == ["' . Role::ANONYMOUS . '"]');
        $RuleCollection = new RuleCollection();
        $RuleCollection->addRule($Rule);
        $authenticator  =  new Authenticator($RuleCollection);

        $this->assertTrue($authenticator->validate($User, $Request));
    }
}