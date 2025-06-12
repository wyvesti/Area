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

        $categoryRepository = new CategoryRepository();

        while ($line = $preparedQuery->fetch(\PDO::FETCH_ASSOC)) {
            $category = $categoryRepository->findById($line["category_id"]);

            $post = new Post(
                $line["title"],
                $line["content"],
                $line["picture"],
                $line["created_at"],
    $line["user_id"]
            );
            $post->setId($line["id"]);
            $post->setCreatedAt($line["created_at"]);
            $post->setCategory($category);

            $list[] = $post;
        }

        return $list; // Retourne la liste complète
    }

    public function findById(int $id): ?Post {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM post WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        $line = $preparedQuery->fetch(\PDO::FETCH_ASSOC);
        if ($line) {
            $categoryRepository = new CategoryRepository();
            $category = $categoryRepository->findById($line["category_id"]);

            $post = new Post(
                $line["title"],
                $line["content"],
                $line["picture"],
                $line["created_at"],
    $line["user_id"]
            );
            $post->setId($line["id"]);
          //  $post->setCreatedAt($line["created_at"]);
            $post->setCategory($category);

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

    public function findByCategoryId(int $categoryId): array {
        $connection = Database::connect();

        $prepareQuery = $connection->prepare("SELECT * FROM post WHERE category_id = :id");
        $prepareQuery->bindValue(":id", $categoryId);
        $prepareQuery->execute();

        $list = [];

        while($line = $prepareQuery->fetch(\PDO::FETCH_ASSOC)){
            $post = new Post(
                $line["title"],
                $line["content"],
                $line["picture"],
                $line["created_at"],
                $line["user_id"]
            );
            $post->setId($line["id"]);

            $categoryRepo = new CategoryRepository();
            $category = $categoryRepo->findById($line["category_id"]);
            $post->setCategory($category);

            $list[] = $post;
        }
        return $list;
    }

    // Met à jour les informations existant
    public function update(Post $post): bool {
        $connection = Database::connect();

        $preparedQuery = $connection->prepare("UPDATE post SET title=:title, content=:content, picture=:picture, user_id = :user_id WHERE id=:id");

        // Injection des valeurs à mettre à jour
        $preparedQuery->bindValue(":title", $post->getTitle());
        $preparedQuery->bindValue(":content", $post->getContent());
        $preparedQuery->bindValue(":picture", $post->getPicture());
        $preparedQuery->bindValue(":id", $post->getId());
        $preparedQuery->bindValue(":user_id", $post->getUserId());

        $preparedQuery->execute();

        // Retourne si une ligne a été modifiée
        return $preparedQuery->rowCount() > 0;
    }

    public function persist(Post $post): void {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("
            INSERT INTO post (title, content, picture, created_at, user_id, category_id)
            VALUES (:title, :content, :picture, :createdAt, :userId, :categoryId)
        ");
        $preparedQuery->bindValue(":title", $post->getTitle());
    $preparedQuery->bindValue(":content", $post->getContent());
    $preparedQuery->bindValue(":picture", $post->getPicture());
    $preparedQuery->bindValue(":createdAt", $post->getCreatedAt()); // string format
    $preparedQuery->bindValue(":userId", $post->getUserId());
    $preparedQuery->bindValue(":categoryId", $post->getCategory()?->getId());

    $preparedQuery->execute();

    // Récupère l'id auto-généré et le met dans ton objet
    $post->setId($connection->lastInsertId());
}
}
