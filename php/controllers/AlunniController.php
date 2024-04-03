<?php
  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Slim\Factory\AppFactory;

  require __DIR__ . '/vendor/autoload.php';

  $app = AppFactory::create();

  class AlunniController{

      function getAlunni(Request $request, Response $response, $args){
          $mysqli = new mysqli('my_mariadb', 'root', 'ciccio', 'scuola');

          $result = $mysqli->query("SELECT * FROM alunni");
          $results = $result->fetch_all(MYSQLI_ASSOC);

          return $response->withJson($results);
      }

      function getAlunno(Request $request, Response $response, $args){
          $id = $args['id'];
          $mysqli = new mysqli('my_mariadb', 'root', 'ciccio', 'scuola');

          $result = $mysqli->query("SELECT * FROM alunni WHERE id = $id");
          $alunno = $result->fetch_assoc();

          return $response->withJson($alunno);
      }

      function createAlunno(Request $request, Response $response, $args){
          $data = $request->getParsedBody();

          $nome = $data['nome'];
          $cognome = $data['cognome'];

          $mysqli = new mysqli('my_mariadb', 'root', 'ciccio', 'scuola');
          $query = "INSERT INTO alunni (nome, cognome) VALUES ('$nome', '$cognome')";
          $mysqli->query($query);

          return $response->withStatus(201)->withJson(['message' => 'Alunno creato']);
      }

      function updateAlunno(Request $request, Response $response, $args){

          $id = $args['id'];
          $data = $request->getParsedBody();

          $nome = $data['nome'];
          $cognome = $data['cognome'];

          $mysqli = new mysqli('my_mariadb', 'root', 'ciccio', 'scuola');
          $query = "UPDATE alunni SET nome = '$nome', cognome = '$cognome' WHERE id = $id";
          $mysqli->query($query);

          return $response->withJson(['message' => 'Alunno aggiornato']);
      }

      function deleteAlunno(Request $request, Response $response, $args){

          $id = $args['id'];

          $mysqli = new mysqli('my_mariadb', 'root', 'ciccio', 'scuola');
          $query = "DELETE FROM alunni WHERE id = $id";

          $mysqli->query($query);
          return $response->withJson(['message' => 'Alunno eliminato']);
      }
}
