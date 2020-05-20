<?php

declare(strict_types=1);

namespace Playground;

use Aws\Sns\SnsClient;

class SnsPublisher
{
    public function publish(string $topicArn, string $message): void
    {
        $snsClient = new SnsClient([
            'region'  => getenv('AWS_DEFAULT_REGION'),
            'version' => 'latest',
        ]);

        try {
            $snsClient->publish([
                'TopicArn' => $topicArn,
                'Message'  => $message,
            ]);
            echo 'Successfully published SNS';
        } catch (\Exception $exception) {
            echo 'Publishing SNS failed: ' . $exception->getMessage();
        }
    }
}
