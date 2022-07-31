<?php

namespace Tracker\Entities;

class Action
{
    private int $id;
    private string $taskUrl;
    private string $date;
    private string $startTime;
    private string $endTime;

    public function __construct(int $id, string $taskUrl, string $date, string $startTime, string $endTime)
    {
        // TODO: Add parameter validation
        $this->id = $id;
        $this->taskUrl = $taskUrl;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    // Getters / Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function getTaskUrl(): string
    {
        return $this->taskUrl;
    }

    public function setTaskUrl(string $taskUrl): void
    {
        // TODO: Add parameter validation
        $this->taskUrl = $taskUrl;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        // TODO: Add parameter validation
        $this->date = $date;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function setStartTime(string $startTime): void
    {
        // TODO: Add parameter validation
        $this->startTime = $startTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    public function setEndTime(string $endTime): void
    {
        // TODO: Add parameter validation
        $this->endTime = $endTime;
    }

    // Other functions

    public function getParamsArray(): array
    {
        return [$this->id, $this->taskUrl, $this->date, $this->startTime, $this->endTime];
    }
}