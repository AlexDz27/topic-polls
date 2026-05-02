<?php

require 'lib/PhpArrDbWriter.php';

header('Access-Control-Allow-Origin: https://rainlab.by');
header("Access-Control-Allow-Headers: Content-Type");

$pollJson = file_get_contents('php://input');
$poll = json_decode($pollJson, true);

$confJson = file_get_contents('data/curPollConfig.json');
$conf = json_decode($confJson, true);
$part = $conf['group'];
$db = require 'data/polls/' . $part . '.php';

$db[] = $poll;

$dbWriter = new PhpArrDbWriter();
$dbWriter->write($db, 'data/polls/' . $part . '.php');