<?php
// a scipt.php feladata hogy egy kérést küld a szervernek majd beolvassa a json file adatait egyessével egy tömbbe majd ha hozzáadunk filmeket azokat beleteszi a json fileba

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newMovie = [
        'id' => uniqid(), //ez egy egyedi id amit ez a uniqid() generál
        'title' => $_POST['title'],
        'year' => $_POST['year'],
        'category_id' => $_POST['category_id'],
        'description' => $_POST['description']
    ];

    $movies = json_decode(file_get_contents('movies.json'), true);

    $movies[] = $newMovie;

    file_put_contents('movies.json', json_encode($movies));
}
