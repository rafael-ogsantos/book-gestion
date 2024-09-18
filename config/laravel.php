<?php

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

$container = new Container();
Facade::setFacadeApplication($container);

return $container;