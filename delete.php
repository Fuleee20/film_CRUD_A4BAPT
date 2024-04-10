<?php
// a delete.php az url-ben kapott azonosító alapján először betölti a filmeket tartalmazó json fájlt, majd megkeresi és törli a megfelelő filmet az azonosító alapján végül átirányítja az oldalt
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $movies_json = file_get_contents('movies.json');
    $movies = json_decode($movies_json, true);

    if (!empty($movies)) {
        foreach ($movies as $key => $movie) {
            if ($movie['id'] == $id) {
                unset($movies[$key]);

                file_put_contents('movies.json', json_encode($movies, JSON_PRETTY_PRINT));

                header('Location: show_movies.php');
                exit;
            }
        }
        die("Nem található film az adott azonosítóval.");
    } else {
        die("A filmek tömb üres.");
    }
} else {
    die("Hiányzik az 'id' paraméter az URL-ből.");
}
