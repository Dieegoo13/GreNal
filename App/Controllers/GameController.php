<?php

namespace App\Controllers;

use App\Models\Game;
use Core\Action;

class GameController extends Action
{

    public function index()
    {

        $this->render('index');

    }

    public function create()
    {

        $this->render('create');
    }


    public function insertGame()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Método não permitido");
        }

        $golsInter = $_POST['gols_inter'] ?? null;
        $golsGremio = $_POST['gols_gremio'] ?? null;

        if ($golsInter === null || $golsGremio === null || $golsInter < 0 || $golsGremio < 0) {
            die("Campos inválidos");
        }

        $game = new Game();
        $sucesso = $game->saveGame($golsInter, $golsGremio);

        if ($sucesso) {
            header('Location: /');
            exit;
        } else {
            die("Erro ao salvar o jogo");
        }
    }


    public function listarJogos()
    {
        header('Content-Type: application/json');
        $game = new Game();
        $dados = $game->getAllGames();
        echo json_encode($dados);
    }

    public function estatisticas()
    {
        header('Content-Type: application/json');
        $game = new Game();
        $stats = $game->getStats();
        echo json_encode($stats);
    }

}
