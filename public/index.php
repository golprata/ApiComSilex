<?php
/*
 * lenvantar o server comando: php -S localhost:8080 -t pasta
 */
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__."/../vendor/autoload.php";


/** com o Silex **/

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__. "/../views"
));
/**
 *  **** Rotas das VIEWS ****
 */
$app->get("/", function() use ($app){
    return $app['twig']->render("/home.twig", []);
});

$app->get("/cupons", function() use ($app){
    return $app['twig']->render("/cupons/lista.twig", []);
});

$app->get("/pais/add", function() use ($app){
    return $app['twig']->render("/pais/add.twig", []);
});

$app->get("/pais/edit/{id}", function($id) use ($app){
    $con = \Portal\utils\Conexao::getInstance()->getConexao();
    $pais = new Portal\model\Pais($id);
    $dao = new Portal\model\PaisDAO($con);
    $lista = $dao->buscarPorID($pais);
    $json = json_encode($lista);
    $lista = json_decode($json,true);
    return $app['twig']->render("/pais/edit.twig", $lista);
});

$app->get("/pais", function() use ($app){

    $con = \Portal\utils\Conexao::getInstance()->getConexao();
    $pais = new Portal\model\Pais();
    $dao = new Portal\model\PaisDAO($con);
    $lista = $dao->listarTodos();
    return $app['twig']->render('pais/tabela.twig', ['paises' => $lista]);
});

$app->get("/pais/{id}", function($id) use ($app){

    $con = \Portal\utils\Conexao::getInstance()->getConexao();
    $pais = new Portal\model\Pais($id);
    $dao = new Portal\model\PaisDAO($con);
    $lista = $dao->buscarPorID($pais);
    return $app->json($lista);
});

/**
 *    **** APIRest ****
 */
//ADICIONAR PAIS
$app->post('/ApiRest/pais/add', function (Request $request) use ($app){

    $con = \Portal\utils\Conexao::getInstance()->getConexao();
    $pais = new Portal\model\Pais(null,$request->get('descricao'),$request->get('nascionalidade'));
    $dao = new Portal\model\PaisDAO($con);
    $id = $dao->cadastrar($pais);
    return $app->redirect('../../pais');
});
//EDITAR UM PAIS
$app->post('/ApiRest/pais/edit', function (Request $request) use ($app){

    $con = \Portal\utils\Conexao::getInstance()->getConexao();
    $pais = new Portal\model\Pais($request->get('id'),$request->get('descricao'),$request->get('nascionalidade'));
    $dao = new Portal\model\PaisDAO($con);
    $dao->atualizar($pais);
    return $app->redirect('../../../pais');

});
//DELETAR UM PAIS (get)
$app->get('/ApiRest/pais/delete/{id}', function (Request $request, $id) use ($app){

    $con = \Portal\utils\Conexao::getInstance()->getConexao();
    $pais = new Portal\model\Pais($id);
    $dao = new Portal\model\PaisDAO($con);
    $dao->deletar($pais);
    return $app->redirect('../../../pais');
});
// DELETAR UM PAIS (delete)
$app->delete('/ApiRest/pais/delete/{id}', function (Request $request, $id) use ($app){

//    $con = \Portal\utils\Conexao::getInstance()->getConexao();
//    $pais = new Portal\model\Pais($id);
//    $dao = new Portal\model\PaisDAO($con);
//    $id = $dao->deletar($pais);
//    return $app->redirect('../../pais');
    return "deletado";

});


$app->run();


