<?php

namespace Tracker\Interfaces;

use Tracker\Entities\Action;

include_once $_SERVER["DOCUMENT_ROOT"] . "/Entities/Action.php";

interface ActionsHandler
{
//    // GET ACTIONS
//
//    /**
//     * @param int $id
//     * @return Action
//     */
//    public function getActionById(int $id): Action|null;
//
//    /**
//     * @param int $year
//     * @param int $month
//     * @return array<Action>
//     */
//    public function getActionsByMonth(int $year, int $month): array;
//
//    /**
//     * @return array<Action>
//     */
//    public function getAllActions(): array;
//
//    // ADD / DELETE
//
//    public function addAction(string $taskUrl, string $date, string $startTime, string $endTime): void;
//
//    public function deleteAction(int $id): void;
//
//    // UPDATE ACTION
//
//    public function updateAction(int $id, string $taskUrl, string $date, string $startTime, string $endTime): void;
}