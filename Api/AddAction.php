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

// TODO: Add parameters check

$actionsHandler->AddAction($_POST['taskUrl'], $_POST['date'], $_POST['startDate'], $_POST['endDate']);