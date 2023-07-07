<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\JobOffer;

class Locator
{
    public const BASE_URL = 'https://api-adresse.data.gouv.fr';
    public function __construct(private HttpClientInterface $client)
    {
    }

    public function getCoordinates(JobOffer $jobOffer): array
    {
        $response = $this->client->request('GET', self::BASE_URL . '/search', [
            'query' => [
                'q' => $jobOffer->getCity()
            ]
        ]);
        if ($response->getStatusCode() === 200) {
            $content = ($response->toArray());
            return $content['features'][0]['geometry']['coordinates'];
        }
        return [];
    }
}
