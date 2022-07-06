<?php

namespace Tracker\Classes;

include_once $_SERVER['DOCUMENT_ROOT'] . '/Entities/Action.php';

class Actions
{
    static public function GetAllActions(): array
    {
        $query = 'CALL StrProc_GetAllActions()';

        $ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Data/config.ini');
        $mysqli = new \mysqli($ini['hostname'], $ini['username'], $ini['password'], $ini['database']);
        $queryResult = $mysqli->query($query);

        $actions = [];
        while ($row = $queryResult->fetch_assoc())
        {
            $actions[] = new \Tracker\Entities\Action(
                (int) $row['id'],
                $row['taskUrl'],
                $row['date'],
                $row['startTime'],
                $row['endTime']
            );
        }

        return $actions;
    }

    /**
     * @todo Add date and time format check
     * @todo Add SQL injection check
     * @todo Add query result check
     */
    static public function AddAction(string $taskUrl, string $date, string $startTime, string $endTime): void
    {
        $query = "CALL StrProc_AddAction(\"{$taskUrl}\", \"{$date}\", \"{$startTime}\", \"{$endTime}\")";

        $ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Data/config.ini');
        $mysqli = new \mysqli($ini['hostname'], $ini['username'], $ini['password'], $ini['database']);
        $queryResult = $mysqli->query($query);
    }

    static public function ResetDatabase()
    {
        $query = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/SQL Requests/Init.sql");

        $ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Data/config.ini');
        $mysqli = new \mysqli($ini['hostname'], $ini['username'], $ini['password'], $ini['database']);
        $queryResult = $mysqli->multi_query($query);
    }
}