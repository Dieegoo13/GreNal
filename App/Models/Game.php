<?php
namespace App\Models;

use Config\Database;
use PDO;

class Game
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function saveGame(int $golsInter, int $golsGremio): bool
    {
        $resultado = $this->defineResultado($golsInter, $golsGremio);

        $query = "
            INSERT INTO tb_jogos (gols_inter, gols_gremio, resultado)
            VALUES (:inter, :gremio, :resultado)
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':inter', $golsInter, PDO::PARAM_INT);
        $stmt->bindParam(':gremio', $golsGremio, PDO::PARAM_INT);
        $stmt->bindParam(':resultado', $resultado, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getStats(): array
    {
        $query = "
            SELECT
                SUM(CASE WHEN resultado = 'inter' THEN 1 ELSE 0 END) AS vitorias_inter,
                SUM(CASE WHEN resultado = 'gremio' THEN 1 ELSE 0 END) AS vitorias_gremio,
                SUM(CASE WHEN resultado = 'empate' THEN 1 ELSE 0 END) AS empates,
                SUM(gols_inter) AS gols_inter,
                SUM(gols_gremio) AS gols_gremio,
                COUNT(*) AS total_jogos
            FROM tb_jogos
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllGames(): array
    {
        $query = "SELECT * FROM tb_jogos ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function defineResultado(int $golsInter, int $golsGremio): string
    {
        if ($golsGremio > $golsInter) return 'gremio';
        if ($golsInter > $golsGremio) return 'inter';
        return 'empate';
    }
}
