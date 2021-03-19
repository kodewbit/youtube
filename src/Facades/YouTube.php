<?php

namespace Kodewbit\YouTube\Facades;

use Illuminate\Support\Facades\Facade;
use Kodewbit\YouTube\Contracts\YouTube as YouTubeInterface;

/**
 * Class YouTube
 *
 * @package Kodewbit\YouTube\Facades
 *
 * @method static \Kodewbit\YouTube\YouTube api()
 * @method static \Kodewbit\YouTube\YouTube search(string $string, $part = [], $optParams = [])
 * @method static \Kodewbit\YouTube\YouTube getResourceId(string $url)
 * @method static \Kodewbit\YouTube\YouTube getChannelVideos(string $channel, $part = [], $optParams = [])
 * @method static \Kodewbit\YouTube\YouTube getChannelDetails($channel, $part = [], $optParams = [])
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
