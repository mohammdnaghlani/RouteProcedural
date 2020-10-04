<?php

return array(
    '' => array(
        'target' => 'partials@index' ,
        'method' => 'get',
    ),
    '/panel' => array(
        'target' => 'admin@index',
        'method' => 'get',
    ),
    '/login' => array(
        'target' => 'login',
        'method' => 'get',
    ),
    '/panel/profile' =>array(
        'target' => 'admin@profile',
        'method' => 'get',
    ) ,

);