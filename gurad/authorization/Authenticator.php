<?php
namespace asbamboo\security\gurad\authorization;

use asbamboo\http\ServerRequestInterface;
use asbamboo\security\user\UserInterface;
use asbamboo\security\exception\AccessDeniedException;

/**
 * 权限认证器
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年3月11日
 */
class Authenticator implements AuthenticatorInterface
{
    /**
     * @var RuleCollectionInterface
     */
    private $rules;

    /**
     * @param RuleCollectionInterface $rules
     */
    public function __construct(RuleCollectionInterface $rules)
    {
        $this->rules    = $rules;
    }

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\gurad\authorization\AuthenticatorInterface::validate()
     */
    public function validate(UserInterface $user, ServerRequestInterface $request) : bool
    {
        foreach($this->rules AS $rule){
            if(!eval($rule->get())){
                throw new AccessDeniedException("对不起，您没有访问权限。");
            }
        }

        return true;
    }
}