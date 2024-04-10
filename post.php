<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Filmek</title>
</head>

<body>
    <h1>Filmek</h1>
    <table>
        <thead>
            <tr>
                <th>Cím</th>
                <th>Megjelenés éve</th>
                <th>Típus</th>
                <th>Leírás</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // táblázatot generál a filmek adataiból  kategóriákat a filmType.json fájlból tölti be, minden sorban lehetőség van a filmek frissítésére és törlésére, ha nincsenek elérhető filmek azt is kiírjuk
            $movies_json = file_get_contents('movies.json');

            $movies = json_decode($movies_json, true);

            $categories_json = file_get_contents('filmType.json');

            $categories = json_decode($categories_json, true);

            if (!empty($categories)) {
                $categories_json = file_get_contents('filmType.json');
                $categories = json_decode($categories_json, true);

                foreach ($movies as $movie) {
                    echo "<tr>";
                    echo "<td>" . $movie['title'] . "</td>";
                    echo "<td>" . $movie['year'] . "</td>";

                    if (array_key_exists('category_id', $movie)) {

                        foreach ($categories as $category) {
                            if ($category['cat_id'] === $movie['category_id']) {
                                echo "<td>" . $category['name'] . "</td>";
                                break;
                            }
                        }
                    } else {
                        echo "<td>N/A</td>";
                    }

                    echo "<td>" . $movie['description'] . "</td>";
                    echo "<td><button class='update-button'><a href='update.php?id=" . $movie['id'] . "'>Frissítés</a></button></td>";
                    echo "<td><button class='delete-button'><a href='delete.php?id=" . $movie['id'] . "'>Törlés</a></button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nincsenek elérhető filmek.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>