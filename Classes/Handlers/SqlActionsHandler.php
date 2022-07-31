<?php

namespace Tracker\Classes;

include_once $_SERVER['DOCUMENT_ROOT'] . '/Interfaces/ActionsHandler.php';

class SqlActionsHandler implements \Tracker\Interfaces\ActionsHandler
{

    private \mysqli $mysqli;

    public function __construct(string $hostname, string $username, string $password, string $database)
    {
        $this->mysqli = new \mysqli($hostname, $username, $password, $database);
    }

    // GET

    public function getActionById(int $id): array
    {
        $query = "CALL StrProc_GetActionById(\"{$id}\");";

        if ($queryResult = $this->mysqli->query($query))
        {
            $result = [];
            while ($row = $queryResult->fetch_assoc())
            {
                $result[] = new \Tracker\Entities\Action(
                    $row['id'],
                    $row['taskUrl'],
                    $row['date'],
                    $row['startTime'],
                    $row['endTime']
                );
            }
            return $result;
        }
        throw new \RuntimeException('Failed to get action');
    }

    public function getActionsByMonth(int $year, int $month): array
    {
        $query = "CALL StrProc_GetActionsByMonth(\"{$year}\", \"{$month}\")";

        if ($queryResult = $this->mysqli->query($query))
        {
            $result = [];
            while ($row = $queryResult->fetch_assoc())
            {
                $result[] = new \Tracker\Entities\Action(
                    $row['id'],
                    $row['taskUrl'],
                    $row['date'],
                    $row['startTime'],
                    $row['endTime']
                );
            }
            return $result;
        }
        throw new \RuntimeException('Failed to get actions');
    }

    public function getAllActions(): array
    {
        $query = 'CALL StrProc_GetAllActions();';

        if ($queryResult = $this->mysqli->query($query))
        {
            $result = [];
            while ($row = $queryResult->fetch_assoc())
            {
                $result[] = new \Tracker\Entities\Action(
                    $row['id'],
                    $row['taskUrl'],
                    $row['date'],
                    $row['startTime'],
                    $row['endTime']
                );
            }
            return $result;
        }
        throw new \RuntimeException('Failed to get action');
    }

    // ADD / DELETE

    public function addAction(string $taskUrl, string $date, string $startTime, string $endTime): void
    {
        $query = "CALL StrProc_AddAction(\"{$taskUrl}\", \"{$date}\", \"{$startTime}\", \"{$endTime}\");";
        // TODO: Change on mysqli->prepare
        // TODO: Add exception if query failed
        $this->mysqli->query($query);
    }

    public function deleteAction(int $id): void
    {
        $query = "CALL StrProc_DeleteAction(\"{$id}\");";
        // TODO: Implement deleteAction() method.
    }

    // UPDATE

    public function updateAction(int $id, string $taskUrl, string $date, string $startTime, string $endTime): void
    {
        $query = "CALL StrProc_UpdateAction(\"{$id}\", \"{$taskUrl}\", \"{$date}\", \"{$startTime}\", \"{$endTime}\")";
        // TODO: Implement updateAction() method.
    }
}