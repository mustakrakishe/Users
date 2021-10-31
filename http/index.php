<?php

use Elasticsearch\ClientBuilder;

require '../vendor/autoload.php';

$INDEX = 'users';

$client = ClientBuilder::create()->build();

$response = $client->search(['index' => $INDEX]);

$hits = $response['hits']['hits'];

echo json_encode($hits);

exit;