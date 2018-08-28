<?php
namespace asbamboo\security\gurad\authorization;

/**
 * 验证规则
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月11日
 */
class Rule implements RuleInterface
{
    private $rule;

    /**
     * $rule 可以作为php代码执行的字符串 其中$user表示asbamboo\user\UserInterface的实例, $request表示asbamboo\http\ServerRequestInterface的实例
     * @param string $rule
     */
    public function __construct(string $rule)
    {
        $this->rule = $rule;
    }

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\gurad\authorization\RuleInterface::get()
     */
    public function get() : string
    {
        return 'return ' . $this->rule . ';';
    }
}