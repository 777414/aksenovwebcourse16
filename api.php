<?php
$pdo = new PDO('mysql:host=localhost;dbname=aksenovwebcoursework16;charset=UTF-8', 'root', '');
//$query = $pdo->query("SELECT * FROM `music`");

if (($_POST["method_type"] == "getSomeMusic")) {
    $query = $pdo->query("SELECT * FROM `music`");
    $result_array = $query->fetchAll(PDO::FETCH_ASSOC);
    printRandomContent($result_array);
}

if ($_POST["method_type"] == "getSomeGenre") {
    $query = $pdo->query("SELECT genre FROM `music`");
    $result_array = $query->fetchAll(PDO::FETCH_ASSOC);
    printGenre($result_array);
}
if ($_POST["method_type"] == "getGenreMusic") {
    $query = $pdo->query("SELECT * FROM `music` WHERE `genre` = '" . $_POST['genre'] . "'");
    $result_array = $query->fetchAll(PDO::FETCH_ASSOC);
    printContent($result_array);
}
function printRandomContent($content)
{
    for ($i = 0; $i < 6; $i++) {
        $rnd = rand(0, count($content) - 1);
        print ('
        <div class="content-product">
        <div class="musician-name" data-title="' . $content[$rnd]['musician'] . '">' . $content[$rnd]['musician'] . '</div>
        <img src="' . $content[$rnd]['picture'] . '" alt="100x100" />
        <div class="album-name" data-title="' . $content[$rnd]['album'] . '">' . $content[$rnd]['album'] . '</div>
        <span class="error hidden">Ошибка</span>
        <span class="success hidden" >Добавлено</span>
        <button class="buttonAdd">Добавить</button>
        </div>
    ');
        array_splice($content, $rnd, 1);
    }
}

function printContent($content)
{
    for ($i = 0; $i < 6; $i++) {
        print ('
        <div class="content-product">
        <div class="musician-name" data-title="' . $content[$i]['musician'] . '">' . $content[$i]['musician'] . '</div>
        <img src="' . $content[$i]['picture'] . '" alt="100x100" />
        <div class="album-name" data-title="' . $content[$i]['album'] . '">' . $content[$i]['album'] . '</div>
        <span class="error hidden">Ошибка</span>
        <span class="success hidden">Добавлено</span>
        <button class="buttonAdd">Добавить</button>
        </div>
    ');
    }
}

function printGenre($content)
{
    $array_box = array();
    $q = 0;
    for ($i = 0; $i < count($content); $i++) {
        for ($j = 0; $j < count($array_box); $j++) {
            if ($array_box[$j] == $content[$i]['genre']) {
                $q++;
            }
        }
        if ($q == 0) {
            $array_box[] = $content[$i]['genre'];
        }
        $q = 0;
    }
    echo('<ul>');
    for ($i = 0; $i < count($array_box); $i++) {
        echo('
            <li>' . $array_box[$i] . '</li>
        ');

    }
    echo('</ul>');
}