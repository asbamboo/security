<?php
namespace asbamboo\security\gurad\authorization;

/**
 * 权限规则集合接口
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月10日
 */
interface RuleCollectionInterface extends \Iterator
{
    /**
     * 添加权限规则
     * @param RuleInterface $rule
     * @return self
     */
    public function addRule(RuleInterface $rule) : self;
}