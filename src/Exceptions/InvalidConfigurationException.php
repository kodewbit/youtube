<?php

namespace Kodewbit\YouTube\Exceptions;

use InvalidArgumentException;

class InvalidConfigurationException extends InvalidArgumentException implements ExceptionInterface
{
    /**
     * Missing the API key to use. This key is necessary to make requests to
     * the YouTube API.
     *
     * @return static
     */
    public static function missingApiKey()
    {
        return new static('YouTube API key is required. Please visit https://console.developers.google.com');
    }
}
