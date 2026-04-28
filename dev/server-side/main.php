<?php

header('Access-Control-Allow-Origin: http://localhost:5173');

$curPollConfig = json_decode(
  file_get_contents('data/curPollConfig.json'), true
);
$allTopics = json_decode(
  file_get_contents('data/topics.json'), true
);

$frontendData = [
  'topics' => $allTopics[$curPollConfig['topics']],
  'group' => $curPollConfig['group']
];

echo json_encode($frontendData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);