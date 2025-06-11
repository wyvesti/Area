<?php

namespace App\Repository;

use App\Entity\Post;
use App\Repository\Database;

class PostRepository {

    public function findAll(): array {
        $list = []; // tableau vide pour stocker
        $connection = Database::connect(); // connexion à la base de données

        $preparedQuery = $connection->prepare("SELECT * FROM post"); // Requête SQL : sélectionne toutes les colonnes de tous
        $preparedQuery->execute(); // Exécute la requête

        while ($line = $preparedQuery->fetch(\PDO::FETCH_ASSOC)) {
            $post = new Post(
                $line["title"],
                $line["content"],
                $line["picture"],
            );
            $post->setId($line["id"]);
            $list[] = $post;
        }

        return $list; // Retourne la liste complète
    }

    public function findById(int $id): ?Post {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM post WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        $line = $preparedQuery->fetch();
        if ($line) {
            $post = new Post(
                $line["title"],
                $line["content"],
                $line["picture"],
            );
            $post->setId($line["id"]);
            return $post;
        }
        return null;
    }


    public function delete(int $id): bool {
        $connection = Database::connect();

        $preparedQuery = $connection->prepare("DELETE FROM post WHERE id=:id");
        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }
}
