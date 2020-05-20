<?php

declare(strict_types=1);

namespace Playground;

use Aws\DynamoDb\Marshaler;
use Playground\Service\DmAvailabilityChecker;
use Playground\ValueObject\Gtin;

class DynamoDbClient
{
    private \Aws\DynamoDb\DynamoDbClient $dynamoDb;

    public function __construct()
    {
        $this->dynamoDb = new \Aws\DynamoDb\DynamoDbClient([
            'region'  => getenv('AWS_DEFAULT_REGION'),
            'version' => 'latest',
        ]);
    }

    /**
     * @param string $tableName
     * @param string $fieldName
     *
     * @return mixed[]
     */
    public function scan(string $tableName, string $fieldName): array
    {
        $marshaler = new Marshaler();

        $params = [
            'TableName'            => $tableName,
            'ProjectionExpression' => $fieldName,
        ];

        $results = [];
        do {
            $result = $this->dynamoDb->scan($params);

            foreach ($result['Items'] as $i) {
                $json = $marshaler->unmarshalItem($i);
                assert(is_array($json));
                echo $json[$fieldName] . PHP_EOL;
                $results[] = $json[$fieldName];
            }

            if (isset($result['LastEvaluatedKey'])) {
                $params['ExclusiveStartKey'] = $result['LastEvaluatedKey'];
            }
        } while (isset($result['LastEvaluatedKey']));

        return $results;
    }

    public function deleteGtin(Gtin $gtin): void
    {
        $marshaler = new Marshaler();
        $key = $marshaler->marshalJson('
            {
                "gtin": "' . $gtin->value() . '"
            }
        ');
        $this->dynamoDb->deleteItem([
            'TableName' => DmAvailabilityChecker::TABLE_DM_AVAILABILITY,
            'Key'       => $key,
        ]);
    }
}
