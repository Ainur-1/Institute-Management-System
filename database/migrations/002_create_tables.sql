-- 002_create_tables.sql

USE ims;

CREATE TABLE IF NOT EXISTS Roles (
	role_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	role_name VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Users (
	user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	first_name VARCHAR(50),
	last_name VARCHAR(50),
	email VARCHAR(50),
	password VARCHAR(100),
	registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	role_id INTEGER,
	FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

CREATE TABLE IF NOT EXISTS StudentGroups (
	group_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	group_name VARCHAR(50),
	course INTEGER
);

CREATE TABLE IF NOT EXISTS Students (
	student_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	user_id INTEGER,
	group_id INTEGER,
	FOREIGN KEY (user_id) REFERENCES Users(user_id),
	FOREIGN KEY (group_id) REFERENCES StudentGroups(group_id)
);

CREATE TABLE IF NOT EXISTS Teachers (
	teacher_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	user_id INTEGER,
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE IF NOT EXISTS Subjects (
	subject_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	subject_name VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS TeacherSubjects (
    teacher_id INTEGER,
    subject_id INTEGER,
    PRIMARY KEY (teacher_id, subject_id),
    FOREIGN KEY (teacher_id) REFERENCES Teachers(teacher_id),
    FOREIGN KEY (subject_id) REFERENCES Subjects(subject_id)
);

CREATE TABLE IF NOT EXISTS ClassTimes (
	class_time_id  INTEGER PRIMARY KEY AUTO_INCREMENT,
	start_time TIME NOT NULL,
	end_time TIME NOT NULL
);

CREATE TABLE IF NOT EXISTS Schedule (
	schedule_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	subject_id INTEGER,
	group_id INTEGER,
	teacher_id INTEGER,
	day_of_week INTEGER,
	class_time_id  INTEGER,
	FOREIGN KEY (subject_id) REFERENCES Subjects(subject_id),
	FOREIGN KEY (group_id) REFERENCES StudentGroups(group_id),
	FOREIGN KEY (teacher_id) REFERENCES Teachers(teacher_id),
	FOREIGN KEY (class_time_id) REFERENCES ClassTimes(class_time_id)
);

CREATE TABLE IF NOT EXISTS Tasks (
    task_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    task_name VARCHAR(50),
    task_text VARCHAR(500),
    task_status VARCHAR(20),
    deadline TIMESTAMP,
    task_owner INTEGER,
    task_assignee INTEGER,
    creation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_updated_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (task_owner) REFERENCES Users(user_id),
    FOREIGN KEY (task_assignee) REFERENCES Users(user_id)
);
