<?php

use Elasticsearch\ClientBuilder;
use Faker\Factory;

require '../vendor/autoload.php';

if(isset($_POST['amount'])){
    $INDEX = 'users';

    $amount = $_POST['amount'];

    $client = ClientBuilder::create()->build();

    $indexExists = $client->indices()->exists(['index' => $INDEX]);
    
    if(!$indexExists){
        $params = [
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
    
        $response = $client->index($params);
    }

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
            'age' => $faker->numberBetween(18, 50),
            'name' => $faker->firstName(),
            'email' => $faker->email(),
            'phone' => '+38' . $faker->randomElement($operators) . $faker->randomNumber(7, true),
        ];
    }

    $response = $client->bulk($params);
    
    var_dump($response);
    
    // echo json_encode($response);
}

exit;