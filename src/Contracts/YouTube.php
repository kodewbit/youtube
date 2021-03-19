<?php

namespace Kodewbit\YouTube\Contracts;

use Google_Service_YouTube;
use Google_Service_YouTube_ChannelListResponse;
use Google_Service_YouTube_SearchListResponse;
use Illuminate\Support\Collection;

interface YouTube
{
    /**
     * Get Google Service YouTube API.
     *
     * @return Google_Service_YouTube
     */
    public function api();

    /**
     * Retrieves a list of search resources (search.listSearch).
     *
     * @param string $string
     * @param array $part
     * @param array $optParams
     * @return Collection|Google_Service_YouTube_SearchListResponse[]
     */
    public function search(string $string, $part = [], $optParams = []);

    /**
     * Get the id of a YouTube resource from its URL.
     *
     * @param string $url
     * @return mixed|null
     */
    public function getResourceId(string $url);

    /**
     * Get videos from a given channel.
     *
     * @param string $channel
     * @param array $part
     * @param array $optParams
     * @return Collection|Google_Service_YouTube_SearchListResponse[]
     */
    public function getChannelVideos(string $channel, $part = [], $optParams = []);

    /**
     * Get information about one or more channels using their id.
     *
     * @param $channel
     * @param array $part
     * @param array $optParams
     * @return Collection|Google_Service_YouTube_ChannelListResponse[]
     */
    public function getChannelDetails($channel, $part = [], $optParams = []);
}
