/* Bluehost database */
USE antkazak_tracker;

/*
========================================================================================================================
= Tables
========================================================================================================================
*/

DROP TABLE IF EXISTS Actions;
CREATE TABLE IF NOT EXISTS Actions
(
    /* Columns */
    id          INTEGER UNSIGNED    NOT NULL AUTO_INCREMENT,
    taskUrl     VARCHAR(255)        NOT NULL,
    date        DATE                NOT NULL,
    startTime   TIME                NOT NULL,
    endTime     TIME                NOT NULL,

    /* Constraints */
    CONSTRAINT pk_action PRIMARY KEY (id ASC)
);

DROP TABLE IF EXISTS Months;
CREATE TABLE IF NOT EXISTS Months
(
    /* Columns */
    year                INTEGER UNSIGNED    NOT NULL,
    month               INTEGER UNSIGNED    NOT NULL,
    salary              INTEGER UNSIGNED    NOT NULL,
    averageHoursGoal    INTEGER UNSIGNED    NOT NULL,

    /* Constraints */
    CONSTRAINT pk_months PRIMARY KEY (year ASC, month ASC)
);

DROP TABLE IF EXISTS Days;
CREATE TABLE IF NOT EXISTS Days
(
    /* Columns */
    year    INTEGER UNSIGNED    NOT NULL,
    month   INTEGER UNSIGNED    NOT NULL,
    day     INTEGER UNSIGNED    NOT NULL,
    type    INTEGER UNSIGNED    NOT NULL, /* 0 - working day, 1 - holiday, 2 - vacation, 3 - sick leave */

    /* Constraint */
    CONSTRAINT fk_days_months FOREIGN KEY (year, month)
        REFERENCES Months (year ASC, month ASC),
    CONSTRAINT pk_days PRIMARY KEY (year ASC, month ASC, day ASC)
);

/*
========================================================================================================================
= Storage procedures
========================================================================================================================
 */

DROP PROCEDURE IF EXISTS StrProc_AddAction;
DELIMITER //
CREATE PROCEDURE StrProc_AddAction
(
    IN taskUrl      VARCHAR(255),
    IN date         DATE,
    IN startTime    TIME,
    IN endTime      TIME
)
BEGIN
    INSERT INTO Actions (taskUrl, date, startTime, endTime)
        VALUES (taskUrl, date, startTime, endTime);
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS StrProc_DeleteAction;
DELIMITER //
CREATE PROCEDURE StrProc_DeleteAction
(
    IN id INTEGER UNSIGNED
)
BEGIN
    DELETE FROM Actions
        WHERE Actions.id = id;
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS StrProc_GetAllActions;
DELIMITER //
CREATE PROCEDURE StrProc_GetAllActions()
BEGIN
    SELECT Actions.id,
           Actions.taskUrl,
           Actions.date,
           Actions.startTime,
           Actions.endTime
    FROM Actions;
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS StrProc_GetActionsBetweenDates;
DELIMITER //
CREATE PROCEDURE StrProc_GetActionsBetweenDates
(
    IN startDate    DATE,
    IN endDate      DATE
)
BEGIN
    SELECT Actions.id,
           Actions.taskUrl,
           Actions.date,
           Actions.startTime,
           Actions.endTime
    FROM Actions
    WHERE Actions.date BETWEEN startDate AND endDate;
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS StrProc_GetActionsByMonth;
DELIMITER //
CREATE PROCEDURE StrProc_GetActionsByMonth
(
    IN  month   INTEGER,
    IN  year    INTEGER
)
BEGIN
    SELECT Actions.id,
           Actions.taskUrl,
           Actions.date,
           Actions.startTime,
           Actions.endTime
    FROM Actions
    WHERE YEAR(Actions.date) = year
      AND MONTH(Actions.date) = month;
END//
DELIMITER ;