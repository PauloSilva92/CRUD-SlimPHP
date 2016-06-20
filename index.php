<?php
    require 'vendor/autoload.php';
    require_once "user.php";

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app = new \Slim\App;

    // cors
    $app->add(new \Tuupola\Middleware\Cors([
        "origin" => ["*"],
        "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
        "headers.allow" => ["X-Requested-With,content-type", "Authorization", "token"],
        "headers.expose" => [],
        "credentials" => false,
        "cache" => 0,
    ]));


    $container = $app->getContainer();

    // Register component on container
    $container['view'] = function ($container) {
        return new \Slim\Views\PhpRenderer('./public/');
    };

    //rota principal que renderiza a index.html
    $app->get('/', function ($request, $response, $args) {
        return $this->view->render($response,'index.html',[]);
    });

    //rota para salvar usuário
   $app->post('/user', function(Request $request, Response $response){
        $id = uniqid(time(), true);
        $userToSave =  $request->getParsedBody();

        $data = [];
        $data['nome'] =  filter_var($userToSave['nome'], FILTER_SANITIZE_STRING);
        $data['email'] =  filter_var($userToSave['email'], FILTER_SANITIZE_STRING);

        $userClass = new User();
        $result = $userClass->salvar($id,$data['nome'],$data['email']);

        $newResponse = $response->withJson($result);
        return $newResponse;
    });

    $app->get('/users', function (Request $request, Response $response){
        $userClass = new User();
        $todos = $userClass->listarTodos();
        $newResponse = $response->withJson($todos);
        return $newResponse;
    });

    $app->run()
?>
