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

/*
========================================================================================================================
= Storage procedures
========================================================================================================================
 */

DROP PROCEDURE IF EXISTS StrProc_AddAction;
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
END;

DROP PROCEDURE IF EXISTS StrProc_DeleteAction;
CREATE PROCEDURE StrProc_DeleteAction
(
    IN id INTEGER UNSIGNED
)
BEGIN
    DELETE FROM Actions
    WHERE Actions.id = id;
END;

DROP PROCEDURE IF EXISTS StrProc_GetAllActions;
CREATE PROCEDURE StrProc_GetAllActions()
BEGIN
    SELECT Actions.id,
           Actions.taskUrl,
           Actions.date,
           Actions.startTime,
           Actions.endTime
    FROM Actions;
END;

DROP PROCEDURE IF EXISTS StrProc_GetActionsBetweenDates;
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
END;

DROP PROCEDURE IF EXISTS StrProc_GetActionsByMonth;
CREATE PROCEDURE StrProc_GetActionsByMonth
(
    IN  year    INTEGER,
    IN  month   INTEGER
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
END;