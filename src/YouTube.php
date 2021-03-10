<?php

namespace Kodewbit\YouTube;

use Google_Client;
use Google_Service_YouTube;

class YouTube extends Google_Service_YouTube
{
    /**
     * YouTube constructor.
     *
     * @param Google_Client $client
     * @param null $rootUrl
     */
    public function __construct(Google_Client $client, $rootUrl = null)
    {
        parent::__construct($client, $rootUrl);

        $client->setDeveloperKey(config('youtube.key'));
    }
}
