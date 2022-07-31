/* Bluehost database */
USE antkazak_tracker;

/* Tables */

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
    CONSTRAINT pk_actions PRIMARY KEY (id ASC)
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

    CONSTRAINT pk_days PRIMARY KEY (year ASC, month ASC, day ASC)

);

/* Storage procedures */

/* SELECT */

DROP PROCEDURE IF EXISTS StrProc_GetActionById;
CREATE PROCEDURE StrProc_GetActionById
(
    IN  id  INTEGER
)
BEGIN
    SELECT Actions.id,
           Actions.taskUrl,
           Actions.date,
           Actions.startTime,
           Actions.endTime
    FROM Actions
    WHERE Actions.id = id;
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

/* INSERT / DELETE */

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