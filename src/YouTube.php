<?php

namespace Kodewbit\YouTube;

use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Collection;
use Kodewbit\YouTube\Contracts\YouTube as YouTubeInterface;
use Kodewbit\YouTube\Exceptions\InvalidConfigurationException;

class YouTube extends Google_Service_YouTube implements YouTubeInterface
{
    /**
     * The client used to deliver requests.
     *
     * @var Google_Client
     */
    private $client;

    /**
     * YouTube constructor.
     *
     * @param Google_Client $client
     * @param null $rootUrl
     */
    public function __construct(Google_Client $client, $rootUrl = null)
    {
        parent::__construct($client, $rootUrl);

        $this->client = $this->configureClient($client);
    }

    /**
     * Configure the Google API client.
     *
     * @param Google_Client $client
     * @return Google_Client
     */
    public function configureClient(Google_Client $client)
    {
        // Get the developer key provided by the developer. This key is necessary
        // to make requests to the YouTube API and can be obtained from the
        // address: https://console.developers.google.com. In case the developer
        // key is not set, an exception is thrown.
        $developerKey = config('youtube.key');

        if (!$developerKey) {
            throw InvalidConfigurationException::missingDeveloperKey();
        }

        $client->setDeveloperKey($developerKey);

        return $client;
    }

    /**
     * @inheritdoc
     *
     * @return Google_Service_YouTube
     */
    public function getService()
    {
        return new parent($this->client);
    }

    /**
     * @inheritdoc
     *
     * @param $part
     * @param array $optParams
     * @return Collection
     */
    public function search($part, $optParams = [])
    {
        return collect($this->search->listSearch($part, $optParams)->getItems());
    }
}
