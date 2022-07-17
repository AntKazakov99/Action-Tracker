<?php

include_once "Classes/Actions.php";

if ($_FILES['markdown-file'])
{
    $file = file($_FILES['markdown-file']['tmp_name']);
    $parsedData = [];

    $currentDate = null;
    $taskUrl = false;

    foreach ($file as $string)
    {
        if (preg_match('@^#\s@', $string))
        {
            $currentDate = substr($string, 2, 10);
            $taskUrl = false;
        }

        if (preg_match('@^##.*@', $string))
        {
            $taskUrl = trim(substr(explode('(', $string)[0], 3));
        }

        if ($taskUrl && preg_match('@^>.*@', trim($string)))
        {
            $parsedData[] = [
                'taskUrl' => $taskUrl,
                'date' => $currentDate,
                'startTime' => trim(substr(explode('-', $string)[0], 2)),
                'endTime' => trim(explode('-', $string)[1]),
            ];
            $taskUrl = false;
        }
    }

    var_dump($parsedData);

    foreach ($parsedData as $action)
    {
        \Tracker\Classes\Actions::AddAction($action['taskUrl'], $action['date'], $action['startTime'], $action['endTime']);
    }
}
?>

<form action="addActionsFromMarkdownFile.php" method="post" enctype="multipart/form-data">
    <input id="markdown-file" name="markdown-file" type="file" required>
    <input type="submit" value="Добавить">
</form>