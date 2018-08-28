<?php
namespace asbamboo\security\_test\gurad\authorization;

use PHPUnit\Framework\TestCase;
use asbamboo\security\gurad\authorization\Rule;

/**
 * test 验证规则
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月11日
 */
class RuleTest extends TestCase
{
    static $rule;
    
    static $rule_condition;
    
    public function setUp()
    {
        if(! static::$rule){
            static::$rule_condition = '1==2';
            static::$rule           = new Rule(static::$rule_condition);
        }
    }
    
    public function testGet()
    {
        $this->assertFalse(eval(static::$rule->get()));
    }
    
    public function testRuleTrue()
    {
        $rule   = new Rule("1 == 1");
        $this->assertTrue(eval($rule->get()));
    }
}