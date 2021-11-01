<?php

use Elasticsearch\ClientBuilder;
use Faker\Factory;

require '../vendor/autoload.php';

if(isset($_POST['amount'])){
    $INDEX = 'users';

    $amount = $_POST['amount'];
    $client = ClientBuilder::create()->build();

    $params = ['index' => $INDEX];
    $indexExists = $client->indices()->exists($params);
    
    if(!$indexExists){
        $params = createIndexParams($INDEX);
        $response = $client->index($params);
    }

    $params = indexBulkParams($INDEX, $amount);
    $response = $client->bulk($params);
    // echo json_encode($response);
}

exit;

function createIndexParams($INDEX){
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

function indexBulkParams($INDEX, $amount){
    $faker = Factory::create('Ru_RU');

    $operators = [
        '039', '067', '068', '096', '097', '098',
        '050', '066', '095', '099',
        '063', '093',
    ];

    for($i = 0; $i < $amount; $i++){
        $params['body'][] = [
            'index' => [
                '_index' => $INDEX,
            ]
        ];

        $params['body'][] = [
            'age' => $faker->numberBetween(18, 40),
            'name' => $faker->firstName(),
            'email' => $faker->email(),
            'phone' => '+38' . $faker->randomElement($operators) . $faker->randomNumber(7, true),
        ];
    }

    return $params;
}