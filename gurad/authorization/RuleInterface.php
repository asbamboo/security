<?php
namespace asbamboo\security\gurad\authorization;

/**
 * 权限规则接口
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
interface RuleInterface
{
    /**
     * 获取可以作为php代码执行的字符串 字符串返回true|false
     * 字符串中 $user表示asbamboo\user\UserInterface的实例
     * 字符串中 $request表示asbamboo\http\ServerRequestInterface的实例
     * 例如下面的规则表示用户需要登录:
     * function get()
     * {
     *   return "return $user->isLogin() == true;";
     * }
     * @return string
     */
    public function get() : string;
}