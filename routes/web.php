<?php

$router->get('/forecast/{townName}[/{date}]', "ForecastController@get");
