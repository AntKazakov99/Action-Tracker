<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/Handlers/SqlActionsHandler.php';

$configData = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Data/config.ini', true);
if (!$configData)
{
    echo json_encode(['success' => false, 'error' => 'Cannot read config file']);
    die();
}

$actionsHandler = new \Tracker\Classes\SqlActionsHandler(
    $configData['DatabaseConnectionData']['hostname'],
    $configData['DatabaseConnectionData']['username'],
    $configData['DatabaseConnectionData']['password'],
    $configData['DatabaseConnectionData']['database']
);

if (!array_key_exists('taskUrl', $_POST)
    && !array_key_exists('date', $_POST)
    && !array_key_exists('startTime', $_POST)
    && !array_key_exists('endTime', $_POST))
{
    echo json_encode(['success' => false, 'error' => 'Failed to get POST parameters']);
    die();
}
try
{
    $actionsHandler->addAction($_POST['taskUrl'], $_POST['date'], $_POST['startTime'], $_POST['endTime']);
    echo json_encode(['success' => true]);
}
catch (RuntimeException $exception)
{
    echo json_encode(['success' => false, 'error' => $exception->getMessage()]);
    die();
}
