<?php

namespace App\Repository;

use App\Entity\Category;
use App\Repository\Database;
class CategoryRepository
{

    public function findById(int $id): ?Category
    {

        $connection = Database::connect();

        $query = $connection->prepare("SELECT * FROM category WHERE id = :id");
        $query->bindValue(":id", $id);

        $query->execute();

        $line = $query->fetch(\PDO::FETCH_ASSOC);

        if ($line) {
            $category = new Category($line["name"]);
            $category->setId($line["id"]);

            return $category;
        }
        return null;
    }

    public function findAll(): array
    {

        $list = [];

        $connection = Database::connect();
        $query = $connection->query("SELECT * FROM category");

        while ($line = $query->fetch(\PDO::FETCH_ASSOC)) {
            $category = new Category($line["name"]);
            $category->setId($line["id"]);

            $list[] = $category;
        }

        return $list;
    }
}
