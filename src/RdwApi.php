<?php

namespace Programic\Rdw;

use GuzzleHttp\Client;
use Programic\Rdw\Exceptions\InvalidLicenseException;
use Programic\Rdw\Exceptions\UnknownLicenseDataException;
use Programic\Rdw\Exceptions\UnreachableEndpointException;

class RdwApi
{
    protected $client;

    protected $endpoints = [
        'info'              => 'm9d7-ebf2.json',
        'fuel'              => '8ys7-d773.json',
        'bodywork'          => 'vezc-m2t6.json',
        'bodywork_specific'  => 'jhie-znh9.json',
        'vehicle_class'     => 'kmfi-hrps.json',
        'transmission'      => 'r7cw-67gs.json',
    ];

    protected $licensenEndpoint = '5xwu-cdq3.json';
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://opendata.rdw.nl/resource/',
            'verify' => false,
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
        
        if (strlen($license) !== 6) {
            throw new InvalidLicenseException();
        }
        
        $data = [];
        foreach ($types as $type) {
            if (isset($this->endpoints[$type]) === false || $type === 'transmission') {
                continue;
            }

            try {
                $response = ($this->client->get("{$this->endpoints[$type]}?kenteken={$license}"));
                $statusCode = $licenseData->getStatusCode() ?? 404;

                if ($statusCode !== 200) {
                    throw new UnknownLicenseDataException('license', $license);
                }

                $responseBody = (string)$response->getBody();
                $data = array_merge($data, $this->formatResponse($responseBody)[0] ?? []);
            } catch (UnknownLicenseDataException $exception) {
                throw $exception;
            } catch(\Throwable $e) {
                throw new UnreachableEndpointException($type);
            }
        }

        if (in_array('transmission', $types) && isset($data['typegoedkeuringsnummer'])) {
            $approvedKey = $data['typegoedkeuringsnummer'];

            if (strpos($approvedKey, '/') !== false) {
                $approvedKeySplitted = explode('/', $approvedKey);
                $yearSplitted = substr($approvedKeySplitted[0], 5, 7);
                $approvedKeyFiltered = substr($approvedKeySplitted[0], 0, 3) . $yearSplitted . '/' . $approvedKeySplitted[1];
                $variant = $data['variant'];

                try {
                    $response = ($this->client->get("{$this->endpoints['transmission']}?eu_type_goedkeuringssleutel={$approvedKeyFiltered}&eeg_variantcode=${variant}"));
                    $statusCode = $licenseData->getStatusCode() ?? 404;

                    if ($statusCode !== 200) {
                        throw new UnknownLicenseDataException('license', $license);
                    }

                    $responseBody = (string)$response->getBody();
                    $data = array_merge($data, $this->formatResponse($responseBody)[0] ?? []);
                } catch (UnknownLicenseDataException $exception) {
                    throw $exception;
                } catch(\Throwable $e) {
                    throw new UnreachableEndpointException($type);
                }
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
