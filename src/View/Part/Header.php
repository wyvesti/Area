<?php

namespace App\View\Part;

class Header {
    public static string $pageTitle = "Welcome";

    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <title><?= self::$pageTitle ?></title> <!-- titre dynamique -->
        </head>
        <body>
            <header class=" main-header">Mon Header
                <nav> <!-- menu de navigation -->
                    <a href="/">Acceuil</a>
                    <a href="/add">Rajouter un post</a>
                    <a href="/category">Category</a>
                </nav>

                <!--<form action="/search" method="get"> 
                    <label>Search :
                        <input type="text" name="keyword">
                    </label>
                    <button>Go</button>
                </form> -->
            </header>
        <?php
    }
}

