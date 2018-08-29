<?php
namespace asbamboo\security\gurad\authorization;

/**
 * 验证规则集合
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月11日
 */
class RuleCollection implements RuleCollectionInterface
{
    /**
     * @var integer
     */
    private $position = 0;
    
    /**
     * 规则数组
     * @var RuleInterface[]
     */
    private $rules;

    /**
     * 
     */
    public function __construct()
    {
        $this->position = 0;
    }
    
    /**
     * {@inheritDoc}
     * @see \asbamboo\security\gurad\authorization\RuleCollectionInterface::addRule()
     */
    public function addRule(RuleInterface $rule): RuleCollectionInterface
    {
        $this->rules[]  = $rule;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \Iterator::next()
     */
    public function next()
    {
        ++ $this->position;
    }

    /**
     * {@inheritDoc}
     * @see \Iterator::valid()
     */
    public function valid()
    {
        return isset($this->rules[$this->position]);
    }

    /**
     * {@inheritDoc}
     * @see \Iterator::current()
     */
    public function current()
    {
        return $this->rules[$this->position];
    }
    
    /**
     * {@inheritDoc}
     * @see \Iterator::rewind()
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * {@inheritDoc}
     * @see \Iterator::key()
     */
    public function key()
    {
        return $this->position;
    }
    
}