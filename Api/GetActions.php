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

$actions = [];
try
{
    if (array_key_exists('id', $_GET))
    {
        $actions = $actionsHandler->getActionById($_GET['id']);
    }
    elseif ($_GET['year'] && $_GET['month'])
    {
        $actions = $actionsHandler->getActionsByMonth($_GET['year'], $_GET['month']);
    }
    else
    {
        $actions = $actionsHandler->getAllActions();
    }
}
catch (RuntimeException $exception)
{
    echo json_encode(['error' => $exception->getMessage()]);
    die();
}

echo json_encode(array_map(static fn ($action) => $action->getParamsArray(), $actions));