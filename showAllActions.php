<?php

include_once 'Classes/Actions.php';

$actions = \Tracker\Classes\Actions::GetAllActions();
$ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Data/config.ini');

$dateFormatter = new IntlDateFormatter('ru_RU',
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    $ini['timezone'],
    IntlDateFormatter::GREGORIAN,
    'd MMMM y');
?>

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