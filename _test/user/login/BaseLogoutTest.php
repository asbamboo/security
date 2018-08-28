<?php
namespace asbamboo\security\_test\user\login;

use PHPUnit\Framework\TestCase;
use asbamboo\security\user\token\UserToken;
use asbamboo\session\Session;
use asbamboo\security\user\login\BaseLogout;
use asbamboo\http\ServerRequest;
use asbamboo\security\user\AnonymousUser;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月28日
 */
class BaseLogoutTest extends TestCase
{
    public function testHandler()
    {
        $Session    = new Session();
        $UserToken  = new UserToken($Session);
        $Request    = new ServerRequest();
        $Logout     = new BaseLogout($UserToken);
        $Logout->handler($Request);

        $user       = $UserToken->getUser();
        $this->assertInstanceOf(AnonymousUser::class, $user);
    }
}