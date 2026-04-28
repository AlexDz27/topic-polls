<?php

$curPollConfig = json_decode(
  file_get_contents('../curPollConfig.json'), true
);
$allTopics = json_decode(
  file_get_contents('../data/topics.json'), true
);

$frontendData = [
  'topics' => $allTopics[$curPollConfig['topics']],
  'group' => $curPollConfig['group']
];
