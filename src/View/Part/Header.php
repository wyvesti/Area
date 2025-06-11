<?php

namespace App\View\Part;

class Header {
    public static string $pageTitle = "";

    public function render() {
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

