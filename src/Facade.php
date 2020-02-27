<?php

namespace FilippoToso\DialogflowBackup;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * @see \Filippotoso\Travelport\Skeleton\SkeletonClass
 */
class Facade extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dialogflow-backup';
    }
}
