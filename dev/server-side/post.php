<?php

require 'lib/PhpArrDbWriter.php';

header('Access-Control-Allow-Origin: http://localhost:5173');
header("Access-Control-Allow-Headers: Content-Type");

$pollJson = file_get_contents('php://input');
$poll = json_decode($pollJson, true);

$confJson = file_get_contents('data/curPollConfig.json');
$conf = json_decode($confJson, true);
$part = $conf['group'];
$db = require 'data/polls/' . $part . '.php';

$db[$poll['place']] = [
  'topic' => $poll['topic'],
  'comments' => $poll['comments'],
];

$dbWriter = new PhpArrDbWriter();
$dbWriter->write($db, 'data/polls/' . $part . '.php');

$badDb = require 'data/polls/' . $part . '.php';
ksort($badDb);
$dbWriter->write($badDb, 'data/polls/' . $part . '.php');