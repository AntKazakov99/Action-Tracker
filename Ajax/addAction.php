<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/Classes/Actions.php";

\Tracker\Classes\Actions::AddAction($_POST["actionTask"], $_POST["actionDate"], $_POST["actionStartTime"], $_POST["actionEndTime"]);