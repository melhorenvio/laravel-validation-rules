<?php

namespace Melhorenvio\ValidationRules;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Melhorenvio\ValidationRules\Skeleton\SkeletonClass
 */
class ValidationRulesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'validation-rules';
    }
}
