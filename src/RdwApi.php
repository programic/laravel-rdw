<?php

namespace Programic\Rdw;

use GuzzleHttp\Client;

class RdwApi
{
    protected $client;

    protected $endpoints = [
        'info'              => 'm9d7-ebf2.json',
        'fuel'              => '8ys7-d773.json',
        'bodywork'          => 'vezc-m2t6.json',
        'bodywork_specific'  => 'jhie-znh9.json',
        'vehicle_class'     => 'kmfi-hrps.json'
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://opendata.rdw.nl/resource/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Get
     *
     * @param string $license
     * @param array $types
     * @return mixed
     */
    public function find(string $license, array $types)
    {
        $license = $this->formatLicense($license);
        $data = [];
        foreach ($types as $type) {
            if (isset($this->endpoints[$type]) === false) {
                continue;
            }

            try {
                $response = (string) ($this->client->get("{$this->endpoints[$type]}?kenteken={$license}"))->getBody();

                $data = array_merge($data, $this->formatResponse($response)[0]);
            } catch(\Throwable $e) {
                throw new \Exception('License not found');
            }
        }

        return $data;
    }

    protected function formatLicense(string $license): string
    {
        $license = preg_replace("/[^a-zA-Z0-9]+/", "", $license);

        return strtoupper($license);
    }

    protected function formatResponse($data): array
    {
        return json_decode($data, true);
    }
}
