<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- hoja de estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <!-- título de página -->
    <title>Cartelera Cine</title>
    <!-- ícono de pàgina -->
    <!-- fuentes -->
    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if (file_exists('xml/encartelera.xml')) {
            $films = simplexml_load_file('xml/encartelera.xml');

        } else {
            exit('Error abriendo encartelera.xml.');
            die();
        }
    ?>

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href=".">Cartelera</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <?php
                        $cines = [];

                        foreach($films as $film) {
                            if (!in_array((string)$film['cine'], $cines)) {
                                $active = isset($_GET['cine']) ? (string)$film['cine'] == $_GET['cine'] ? 'active' : '' : '';
                                echo "<li class='nav-item'>";
                                echo "<a class='nav-link $active' aria-current='page' href='?cine={$film['cine']}'>{$film['cine']}</a>";
                                echo "</li>";
                                array_push($cines, (string)$film['cine']);
                            }
                        }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="./img/sonic.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="./img/parasitos.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="./img/adu.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <div class="rows">
        <div class="column-1">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Película</th>
                        <th class="description" scope="col">Descripción</th>
                        <th scope="col">Tema</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                    if (isset($_GET['cine'])) {
                        foreach($films as $film) {
                            if ($film['cine'] == $_GET['cine']) {
                                echo '<tr>';
                                echo '<td>'.$film->title.'</td>';
                                echo '<td class="description">'.$film->description.'</td>';
                                echo '<td>'.$film->description['tema'].'</td>';
                                echo '</tr>';
                            }
                        }
                    } else {
                        foreach($films as $film) {
                            echo '<tr>';
                            echo '<td>'.$film->title.'</td>';
                            echo '<td class="description">'.$film->description.'</td>';
                            echo '<td>'.$film->description['tema'].'</td>';
                            echo '</tr>';
                        }
                    }

                ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>