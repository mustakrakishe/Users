<?php

use Elasticsearch\ClientBuilder;

require '../vendor/autoload.php';

if(isset($_POST['amount'])){
    $INDEX = 'users';
    $TYPE = 'user';

    $amount = $_POST['amount'];

    $client = ClientBuilder::create()->build();

    $indexExists = $client->indices()->exists(['index' => $INDEX]);
    
    if(!$indexExists){
        $params = [
            'index' => $INDEX,
            'type' => $TYPE,
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

    for($i = 0; $i < $amount; $i++){
        $params['body'][] = [
            'index' => [
                '_index' => $INDEX,
                '_type'    => $TYPE
            ]
        ];

        $params['body'][] = [
            'age'     => 'my_value',
            'name' => 'some more values',
            'email' => 'some more values',
            'phone' => 'some more values',
        ];
    }

    $responses = $client->bulk($params);
    
    
    
    var_dump($response);
    
    // echo json_encode($response);
}

exit;