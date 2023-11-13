CREATE TABLE Users (
	user_id INTEGER PRIMARY KEY,
	email VARCHAR(50),
	password_hash VARCHAR(100),
	session_token VARCHAR(100),
	session_expiration TIMESTAMP,
	registration_date TIMESTAMP,
	role_id INTEGER,
	FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

CREATE TABLE Roles (
	role_id INTEGER PRIMARY KEY,
	role_name VARCHAR(50)
);

CREATE TABLE Students (
	student_id INTEGER PRIMARY KEY,
	first_name VARCHAR(50),
	last_name VARCHAR(50),
	group_id INTEGER,
	FOREIGN KEY (group_id) REFERENCES Groups(group_id)
);

CREATE TABLE Teachers (
	teacher_id INTEGER PRIMARY KEY,
	first_name VARCHAR(50),
	last_name VARCHAR(50),
);

CREATE TABLE Groups (
	group_id INTEGER PRIMARY KEY,
	group_name VARCHAR(50),
	course INTEGER
);

CREATE TABLE Subjects (
	subject_id INTEGER PRIMARY KEY,
	subject_name VARCHAR(50)
);

CREATE TABLE Schedule (
	schedule_id INTEGER PRIMARY KEY,
	subject_id INTEGER,
	group_id INTEGER,
	day_of_week INTEGER,
	start_time TIME,
	end_time TIME,
	FOREIGN KEY (subject_id) REFERENCES Subjects(subject_id),
	FOREIGN KEY (group_id) REFERENCES Groups(group_id)
);

CREATE TABLE Attendance (
    attendance_id INTEGER PRIMARY KEY,
    schedule_id INTEGER,
    student_id INTEGER,
    attendance_date DATE,
    attended BOOLEAN,
    FOREIGN KEY (schedule_id) REFERENCES Schedule(schedule_id),
    FOREIGN KEY (student_id) REFERENCES Students(student_id)
);

CREATE TABLE Task (
	task_id INTEGER PRIMARY KEY,
	task_name VARCHAR(50),
	task_text VARCHAR(500),
	task_status VARCHAR(20),
	deadline TIMESTAMP,
	task_owner INTEGER,
	task_assignee INTEGER,
	creation_time TIMESTAMP,
	last_updated_time TIMESTAMP,
	FOREIGN KEY (task_owner) REFERENCES Users(user_id),
	FOREIGN KEY (task_assignee) REFERENCES Users(user_id)
);