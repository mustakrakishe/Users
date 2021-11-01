<?php

use Elasticsearch\ClientBuilder;
use Faker\Factory;

require '../vendor/autoload.php';

$BATCH_SIZE = 100000;
$INDEX = 'users';

if (isset($_POST['amount'])) {
    $total = $_POST['amount'];
    $client = ClientBuilder::create()->build();

    $params = ['index' => $INDEX];
    $indexExists = $client->indices()->exists($params);

    if (!$indexExists) {
        $params = createIndexParams($INDEX);
        $client->indices()->create($params);
    }

    $params = ['refresh' => true];

    for ($i = 0; $i < $total; $i++) {
        $params['body'][] = [
            'index' => [
                '_index' => $INDEX,
            ]
        ];

        $params['body'][] = makeUser();
        
        if ($i % $BATCH_SIZE == 0) {
            $client->bulk($params);
            $params = ['refresh' => true];
        }
    }

    if (!empty($params['body'])) {
        $client->bulk($params);
    }
    
    // echo json_encode($response);
}

exit;

function createIndexParams($INDEX)
{
    return [
        'index' => $INDEX,
        'body' => [
            'mappings' => [
                'properties' => [
                    'age' => ['type' => 'byte'],
                    'name' => ['type' => 'text'],
                    'email' => ['type' => 'keyword'],
                    'phone' => ['type' => 'text'],
                ],
            ],
        ],
    ];
}

function makeUser(){
    $faker = Factory::create('Ru_RU');

    $operators = [
        '039', '067', '068', '096', '097', '098',
        '050', '066', '095', '099',
        '063', '093',
    ];

    $user = [
        'age' => $faker->numberBetween(18, 40),
        'name' => $faker->firstName(),
        'email' => $faker->email(),
        'phone' => '+38' . $faker->randomElement($operators) . $faker->randomNumber(7, true),
    ];

    return $user;
}
