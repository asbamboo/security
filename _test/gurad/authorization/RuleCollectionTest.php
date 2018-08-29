<?php
namespace asbamboo\security\_test\gurad\authorization;

use PHPUnit\Framework\TestCase;
use asbamboo\security\gurad\authorization\RuleCollection;
use asbamboo\security\gurad\authorization\RuleInterface;
use asbamboo\security\gurad\authorization\Rule;

/**
 * test 验证规则集合
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月11日
 */
class RuleCollectionTest extends TestCase
{
    static $ruleCollection;

    public function setUp()
    {
        if(! static::$ruleCollection){
            static::$ruleCollection = new RuleCollection();
        }
    }

    public function getAddRuleDataProvider()
    {
        yield [new Rule('1==1')];
        yield [new Rule('1==2')];
    }

    /**
     * @dataProvider getAddRuleDataProvider
     */
    public function testAddRule($rule)
    {
        $this->assertInstanceOf(RuleCollection::class, static::$ruleCollection->addRule($rule));
    }

    public function testForeachRuleCollection()
    {
        foreach(static::$ruleCollection as $rule){
            $this->assertInstanceOf(RuleInterface::class, $rule);
        }
    }
}