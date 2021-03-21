<?php

namespace Kodewbit\YouTube;

use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTube_ChannelListResponse;
use Google_Service_YouTube_PlaylistListResponse;
use Google_Service_YouTube_SearchListResponse;
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
    private function configureClient(Google_Client $client)
    {
        // Get the developer key provided by the developer. This key is necessary
        // to make requests to the YouTube API and can be obtained from the
        // address: https://console.developers.google.com. In case the developer
        // key is not set, an exception is thrown.
        $developerKey = config('youtube.key');

        if ($developerKey) {
            $client->setDeveloperKey($developerKey);
        } else {
            throw InvalidConfigurationException::missingKey();
        }

        return $client;
    }

    /**
     * @inheritdoc
     *
     * @return Google_Service_YouTube
     */
    public function api()
    {
        return new parent($this->client);
    }

    /**
     * @inheritdoc
     *
     * @param string $string
     * @param array $part
     * @param array $optParams
     * @return Collection|Google_Service_YouTube_SearchListResponse[]
     */
    public function search(string $string, $part = [], $optParams = [])
    {
        $part = array_merge($part, [
            'id',
            'snippet'
        ]);

        $optParams = array_merge($optParams, [
            'q' => $string
        ]);

        return collect($this->search->listSearch($part, $optParams)->getItems());
    }

    /**
     * @inheritdoc
     *
     * @param string $url
     * @return mixed|null
     */
    public function getResourceId(string $url)
    {
        return preg_match('/\\W([\\w-]{9,})(\\W|$)/', $url, $matches) ? $matches[1] : null;
    }

    /**
     * @inheritdoc
     *
     * @param string $channel
     * @param array $part
     * @param array $optParams
     * @return Google_Service_YouTube_SearchListResponse[]|Collection
     */
    public function getChannelVideos(string $channel, $part = [], $optParams = [])
    {
        $part = array_merge($part, [
            'id',
            'snippet'
        ]);

        $optParams = array_merge($optParams, [
            'type' => 'video',
            'order' => 'date',
            'channelId' => $channel
        ]);

        return collect($this->search->listSearch($part, $optParams)->getItems());
    }

    /**
     * @inheritdoc
     *
     * @param $channel
     * @param array $part
     * @param array $optParams
     * @return Collection|Google_Service_YouTube_ChannelListResponse[]
     */
    public function getChannelDetails($channel, $part = [], $optParams = [])
    {
        // This method allows obtaining information about one or more channels
        // from their id. In the case that you pass an iterable object with
        // several channels id, it would be necessary to convert it to a
        // string where each id is separated by commas.
        if (is_iterable($channel)) {
            if (is_a($channel, Collection::class)) {
                $channel = $channel->implode(', ');
            } else {
                $channel = implode(', ', $channel);
            }
        }

        $part = array_merge($part, [
            'id',
            'snippet'
        ]);

        $optParams = array_merge($optParams, [
            'id' => $channel
        ]);

        return collect($this->channels->listChannels($part, $optParams)->getItems());
    }

    /**
     * @inheritdoc
     *
     * @param $channel
     * @param array $part
     * @param array $optParams
     * @return Collection|Google_Service_YouTube_PlaylistListResponse[]
     */
    public function getChannelPlaylists($channel, $part = [], $optParams = [])
    {
        $part = array_merge($part, [
            'id',
            'snippet',
            'status'
        ]);

        $optParams = array_merge($optParams, [
            'channelId' => $channel
        ]);

        return collect($this->playlists->listPlaylists($part, $optParams)->getItems());
    }
}
