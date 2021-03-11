<?php

namespace Kodewbit\YouTube\Facades;

use Illuminate\Support\Facades\Facade;
use Kodewbit\YouTube\Contracts\YouTube as YouTubeInterface;

/**
 * Class YouTube
 *
 * @package Kodewbit\YouTube\Facades
 *
 * @method static \Kodewbit\YouTube\YouTube getClient()
 * @method static \Kodewbit\YouTube\YouTube getService()
 * @method static \Kodewbit\YouTube\YouTube search($part, $optParams = array())
 */
class YouTube extends Facade
{
    /**
     * @inheritdoc
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return YouTubeInterface::class;
    }
}
