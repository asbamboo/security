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
    private $RuleCollection;

    /**
     * @param RuleCollectionInterface $RuleCollection
     */
    public function __construct(RuleCollectionInterface $RuleCollection)
    {
        $this->RuleCollection    = $RuleCollection;
    }

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\gurad\authorization\AuthenticatorInterface::validate()
     */
    public function validate(UserInterface $user, ServerRequestInterface $request) : bool
    {
        foreach($this->RuleCollection AS $Rule){
            if(!eval($Rule->get())){
                throw new AccessDeniedException("对不起，您没有访问权限。");
            }
        }

        return true;
    }
}