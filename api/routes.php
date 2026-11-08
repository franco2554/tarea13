<?php
// api/routes.php
// Acá se anota: "cuando pidan ESTA url, ejecutá ESTE controlador@método"

$router->get('/estado', 'EstadoController@ver');

// Vehiculos
$router->get('/vehiculos', 'VehiculoController@listar');
$router->get('/vehiculos/:id', 'VehiculoController@ver');
