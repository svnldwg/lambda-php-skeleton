<?php

declare(strict_types=1);

namespace LambdaPhpSkeleton\TronaldDump;

use Bref\Logger\StderrLogger;

class Client
{
    private StderrLogger $logger;

    public function __construct(StderrLogger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return mixed[]
     */
    public function getRandomQuote(): array
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://tronalddump.io/random/quote', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            $this->logger->error(
                'Request to tronalddump API failed',
                [
                    'httpStatusCode' => $response->getStatusCode(),
                    'reason'         => $response->getReasonPhrase(),
                ]
            );

            throw new \RuntimeException('API request failed');
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
