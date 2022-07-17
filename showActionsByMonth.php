<?php

include_once 'Classes/Actions.php';
include_once 'Entities/Month.php';

$selectedMonth = (int)date("m");
$selectedYear = (int)date("Y");
if ($_GET['year'] && $_GET['month'])
{
  $selectedYear = (int)$_GET['month'];
  $selectedYear = (int)$_GET['year'];
}
if ($_GET['actions-month'])
{
  $date = date_parse($_GET['actions-month']);
    $selectedMonth = (int)$date['month'];
    $selectedYear = (int)$date['year'];
}
$actions = \Tracker\Classes\Actions::GetActionsByMonth($selectedMonth, $selectedYear);

$month = new \Tracker\Entities\Month($selectedMonth, $selectedYear, 5, 65000, $actions);

$ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Data/config.ini');

$dateFormatter = new IntlDateFormatter('ru_RU',
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    $ini['timezone'],
    IntlDateFormatter::GREGORIAN,
    'd MMMM y');

?>

<form id="show-actions-by-month" method="get" action="showActionsByMonth.php">
  <label for="actions-month">Месяц:</label>
  <input id="actions-month" name="actions-month" type="month" value="<?= $month->getYear() ?>-<?= $month->getFormattedMonth(); ?>" required>
  <input type="submit" value="Обновить">
</form>

<table>
  <tr>
    <td>Месяц:</td>
    <td><?= $month->getMonth() ?></td>
  </tr>
  <tr>
    <td>Норма часов:</td>
    <td><?= $month->getAverageWorkedHoursGoal() ?></td>
  </tr>
  <tr>
    <td>Ставка:</td>
    <td><?= $month->getSalary() ?></td>
  </tr>
  <tr>
    <td>Количество будних дней:</td>
    <td><?= $month->getWeekdaysCount() ?></td>
  </tr>
  <tr>
    <td>Будних дней отработано:</td>
    <td><?= $month->getWorkedWeekdaysCount() ?></td>
  </tr>
  <tr>
    <td>Количество часов необходимых для выполнения нормы:</td>
    <td><?= $month->getTotalWorkingHoursGoal() ?></td>
  </tr>
  <tr>
    <td>Количество часов в отработанных будних днях:</td>
    <td><?= $month->getWorkedWeekdaysCount() * $month->getAverageWorkedHoursGoal() ?></td>
  </tr>
</table>

<table>
    <tr>
        <th>ID</th>
        <th>Задача</th>
        <th>Дата</th>
        <th>Время начала</th>
        <th>Время окончания</th>
        <th>Затраченное время</th>
    </tr>
    <?php /** @var Tracker\Entities\Action $action */ ?>
    <?php foreach ($actions as $action): ?>
        <tr>
            <td><?= $action->getId() ?></td>
            <td><a href="<?= $action->getTaskUrl() ?>" target="_blank"><?= $action->getTaskUrl() ?></a></td>
            <td style="text-align: right"><?= $dateFormatter->format( new DateTime($action->getDate())) ?></td>
            <td style="text-align: right"><?= $action->getStartTime() ?></td>
            <td style="text-align: right"><?= $action->getEndTime() ?></td>
            <td style="text-align: right"><?= $action->getFormattedElapsedHours() ?> ч. <?= $action->getFormattedElapsedMinutes() ?> м.</td>
        </tr>
    <?php endforeach; ?>
</table>