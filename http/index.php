<?php

require '../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$INDEX = 'users';

$client = ClientBuilder::create()->build();

$params = ['index' => $INDEX];
$indexExists = $client->indices()->exists($params);

if($indexExists){
    $params = ['index' => $INDEX];
    
    $filters = array_filter($_GET);
    
    if(!empty($filters)){
        $must = [];
    
        $ageRules['range']['age']['gte'] = $filters['age-min'];
        $ageRules['range']['age']['lte'] = $filters['age-max'];
        array_push($must, $ageRules);
        
        if(isset($filters['name'])){
            $emailRules['prefix']['name'] = $filters['name'];
            array_push($must, $emailRules);
        }
        
        if(isset($filters['email'])){
            $emailRules['match']['email'] = $filters['email'];
            array_push($must, $emailRules);
        }
    
        $params['body']['query']['bool'] = compact('must');
    }
        
    $response = $client->search($params);
    
    $hits = $response['hits']['hits'];
    
    echo json_encode([
        'status' => 1,
        'hits' => $hits,
    ]);
}
else{
    echo json_encode([
        'status' => 1,
        'hits' => [],
    ]);
}

exit;