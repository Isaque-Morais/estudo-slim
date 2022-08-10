<?php

require __DIR__ . '/vendor/autoload.php';


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


// Configuração de exibição de erro (Não funcional)

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$construction = new AppFactory($configuration);


$app = AppFactory::create();

/* Resquisição GET */

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Teste de API");
    return $response;
});

/* Resquisição GET */

$app->get('/construction', function (Request $request, Response $response, $args) {

  $construction = [
    '1' => 'MRV',
    '2' => 'Tenda',
    '3' => 'Cyrela'

  ];

  $response->getBody()->write(json_encode($construction));
  return $response->withHeader('Content-type', 'application/json');
});

/* Resquisição GET */

$app->get('/construction/{id}', function (Request $request, Response $response, $args) {
  $constructions = [
    '1' => 'MRV',
    '2' => 'Tenda',
    '3' => 'Cyrela'

  ];

  $construction[$args['id']] = $constructions[$args ['id']];
  $response->getBody()->write(json_encode($construction));
  return $response->withHeader('Content-type', 'application/json');
});

/* Resquisição GET */

$app->get('/obras/{nome}', function(Request $request, Response $response, array $args){

  $limit = $request->getQueryParams()['limit']?? 2000;
  $nome = $args['nome'];
  
  $response->getBody()->write("{$limit} obras do banco de dados com o nome {$nome}.");
  return $response;

});

/* Resquisição POST */

$app->post('/obra', function(Request $request, Response $response, array $args): Response {

  $data = $request->getParsedBody();
  $nome =  $data['nome'] ?? '';

  $response->getBody()->write("Obra 123 {$nome} (post)");
  
  return $response;

});

/* Resquisição PUT */

$app->put('/obra', function(Request $request, Response $response, array $args) {

  $data = $request->getParsedBody();
  $nome =  $data['nome'] ?? '';

  $response->getBody()->write("Teste 123 {$nome} (put)");
  return $response;

});

/* Resquisição DELETE */

$app->delete('/obra', function(Request $request, Response $response, array $args) {

  $data = $request->getParsedBody();
  $nome =  $data['nome'] ?? '';

  $response->getBody()->write("Teste 123 {$nome} (delete)");
  return $response;

});

$app->run();