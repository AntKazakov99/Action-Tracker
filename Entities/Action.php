<?php

namespace Tracker\Entities;

class Action
{
    private int $id;
    private string $taskUrl;
    private string $date;
    private string $startTime;
    private string $endTime;

    /**
     * @todo Add date and time format check
     */
    public function __construct(int $id, string $taskUrl, string $date, string $startTime, string $endTime)
    {
        $this->id = $id;
        $this->taskUrl = $taskUrl;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTaskUrl(): string
    {
        return $this->taskUrl;
    }

    public function setTaskUrl(string $url): void
    {
        $this->taskUrl = $url;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @todo Add date format check
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * @todo Add time format check
     */
    public function setStartTime(string $time): void
    {
        $this->startTime = $time;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    /**
     * @todo Add time format check
     */
    public function setEndTime(string $time): void
    {
        $this->endTime = $time;
    }

    public function getElapsedSeconds(): int
    {
        $startTime = explode(":", $this->startTime);
        $endTime = explode(":", $this->endTime);
        return ($endTime[0] * 3600 + $endTime[1] * 60) - ($startTime[0] * 3600 + $startTime[1] * 60);
    }

    public function getElapsedHours(): int
    {
        return intdiv($this->getElapsedSeconds(), 3600);
    }

    public function getElapsedMinutes(): int
    {
        return intdiv(($this->getElapsedSeconds() % 3600), 60);
    }

    public function getFormattedElapsedHours(): string
    {
        return str_pad($this->getElapsedHours(), 2, "0", STR_PAD_LEFT);
    }

    public function getFormattedElapsedMinutes(): string
    {
        return str_pad($this->getElapsedMinutes(), 2, "0", STR_PAD_LEFT);
    }

    public function getYear(): int
    {
        return date_parse($this->date)['year'];
    }

    public function getMonth(): int
    {
        return date_parse($this->date)['month'];
    }

    public function getDay(): int
    {
        return date_parse($this->date)['day'];
    }
}