<?php

namespace Kodewbit\YouTube;

use Google\Client;
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
     * The Google Service YouTube.
     *
     * @var Google_Service_YouTube
     */
    private $service;

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
        $this->service = $this->configureService($this->client);
    }

    /**
     * Setup the Google Client.
     *
     * @param Google_Client $client
     * @return Google_Client
     */
    private function configureClient(Google_Client $client)
    {
        if (!config('youtube.key')) {
            throw InvalidConfigurationException::missingDeveloperKey();
        }

        $client->setDeveloperKey(config('youtube.key'));

        return $client;
    }

    /**
     * Configure Google YouTube Service.
     *
     * @param Google_Client $client
     * @return Google_Service_YouTube
     */
    private function configureService(Google_Client $client)
    {
        return new Google_Service_YouTube($client);
    }

    /**
     * @inheritdoc
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @inheritdoc
     *
     * @return Google_Service_YouTube
     */
    public function getService()
    {
        return $this->service;
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
        $response = $this->search->listSearch($part, $optParams);

        return collect($response->getItems());
    }
}
