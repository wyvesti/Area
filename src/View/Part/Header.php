<?php

namespace App\View\Part; // nom de l'espace : App\View\Part

class Header {
    public static string $pageTitle = ""; // titre modifiable par les contrôleurs

    public function render() { // méthode pour afficher l’en-tête
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>My dogs - <?= self::$pageTitle ?></title> <!-- titre dynamique -->
        </head>
        <body>
            <header>Mon Header
                <nav> <!-- menu de navigation -->
                    <a href="/">Home</a>
                    <a href="/add-dog">Add dog</a>
                    (<a href="/person">Person</a>
                    <a href="/about">About</a>)
                </nav>

                <form action="/search" method="get"> <!-- formulaire de recherche -->
                    <label>Search :
                        <input type="text" name="keyword">
                    </label>
                    <button>Go</button>
                </form>
            </header>
        <?php
    }
}

