<?php

namespace Tracker\Entities;

include_once "Action.php";

class Month
{
    /** @var int  */
    private int $month;
    /** @var int */
    private int $year;
    /** @var int  */
    private int $averageWorkedHoursGoal;
    /** @var int  */
    private int $salary;
    /** @var array<Action> */
    private array $actions = [];

    /**
     * @param int $month
     * @param int $year
     * @param int $averageWorkedHoursGoal
     * @param int $salary
     * @param array<Action> $actions
     */
    public function __construct(int $month, int $year, int $averageWorkedHoursGoal, int $salary, array $actions)
    {
        $this->month = $month;
        $this->year = $year;
        $this->averageWorkedHoursGoal = $averageWorkedHoursGoal;
        $this->salary = $salary;
        $this->actions = $actions;
    }

    // Getters and setters

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getAverageWorkedHoursGoal(): int
    {
        return $this->averageWorkedHoursGoal;
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * @return array<Action>
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    // Formatting

    public function getFormattedMonth(): string
    {
        return str_pad($this->month, 2, "0", STR_PAD_LEFT);
    }

    // Days

    public function getTotalDaysCountInMonth(): int
    {
        return cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }

    public function getWeekdays(): array
    {
        $workingDays = [];
        for ($currentDay = 1; $currentDay <= $this->getTotalDaysCountInMonth(); $currentDay++)
        {
            $date = new \DateTime();
            $date->setDate($this->year, $this->month, $currentDay);
            if ((int)$date->format("N") < 6)
            {
                $workingDays[] = $currentDay;
            }
        }

        return $workingDays;
    }

    public function getWeekdaysCount(): int
    {
        return count($this->getWeekdays());
    }

    public function getWorkedDays(): array
    {
        return array_unique(array_map(fn($action) => $action->getDay(), $this->actions));
    }

    // Worked weekdays

    public function getWorkedWeekdays(): array
    {
        return array_filter($this->getWorkedDays(), fn($dayNumber) => in_array($dayNumber, $this->getWeekdays()));
    }

    public function getWorkedWeekdaysCount(): int
    {
        return count($this->getWorkedWeekdays());
    }

    // Time

    public function getTotalWorkingHoursGoal(): int
    {
        return $this->getWeekdaysCount() * $this->averageWorkedHoursGoal;
    }
}