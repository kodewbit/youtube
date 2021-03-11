<?php

namespace Kodewbit\YouTube\Exceptions;

use InvalidArgumentException;

class InvalidConfigurationException extends InvalidArgumentException implements ExceptionInterface
{
    /**
     * Missing the developer key to use, these are obtained through the API
     * Console.
     *
     * @return static
     */
    public static function missingDeveloperKey()
    {
        return new static('YouTube API key is required. Please visit https://console.developers.google.com');
    }
}
