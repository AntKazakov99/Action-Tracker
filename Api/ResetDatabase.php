<?php

$configData = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Data/config.ini', true);
if (!$configData)
{
    echo json_encode(['success' => false, 'error' => 'Cannot read config file']);
    die();
}

$mysqli = new mysqli(
    $configData['DatabaseConnectionData']['hostname'],
    $configData['DatabaseConnectionData']['username'],
    $configData['DatabaseConnectionData']['password'],
    $configData['DatabaseConnectionData']['database']
);

$query = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/SQL Requests/Init.sql');

$queryStatus = $mysqli->multi_query($query);

$results = []; // Results of each query
do
{
    $queryResult = $mysqli->store_result();
    $results[] = ['status' => $queryStatus, 'result' => $queryResult? $queryResult->fetch_all(): false];
}
while ($queryStatus = $mysqli->next_result());

echo json_encode(['success' => !$mysqli->error, 'error' => $mysqli->error]);