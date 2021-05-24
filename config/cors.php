<?php
return [
  'access' => [
      'origin'  => '*',
      'methods' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept'],
      'headers' => ['GET', 'POST', 'PUT'],
  ]
];

/*
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: GET, POST, PUT');

echo 'content view ...';
*/