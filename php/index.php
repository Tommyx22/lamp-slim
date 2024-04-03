<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';

$app = AppFactory::create();

$app->get('/alunni', 'AlunniController:getAlunni');
$app->get('/alunni/{id}', 'AlunniController:getAlunno');
$app->post('/alunni', 'AlunniController:createAlunno');
$app->put('/alunni/{id}', 'AlunniController:updateAlunno');
$app->delete('/alunni/{id}', 'AlunniController:deleteAlunno');

$app->run();