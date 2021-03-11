<?php

namespace Kodewbit\YouTube\Contracts;

use Google\Client;
use Google_Service_YouTube;
use Google_Service_YouTube_SearchListResponse;

interface YouTube
{
    /**
     * Return the associated Google\Client class.
     *
     * @return Client
     */
    public function getClient();

    /**
     * Return Google Service YouTube class.
     *
     * @return Google_Service_YouTube
     */
    public function getService();

    /**
     * Retrieves a list of search resources (search.listSearch)
     *
     * @param $part
     * @param array $optParams
     * @return Google_Service_YouTube_SearchListResponse
     */
    public function search($part, $optParams = []);
}
