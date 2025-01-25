<?php

namespace test;
use test\app\appClass;

//подключаем загрузчик
require_once('main_loader.php');


//запускаем приложение
$app = new appClass();
$app->run();

?>