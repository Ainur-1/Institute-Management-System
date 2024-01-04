-- 003_insert_initial_data.sql

USE ims;

INSERT INTO Roles (role_id, role_name) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student');

INSERT INTO Users (user_id, email, password, registration_date, role_id) VALUES
(1, 'admin@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', NOW(), 1),
(2, 'teacher@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', NOW(), 2),
(3, 'student@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', NOW(), 3);

INSERT INTO StudentGroups (group_id, group_name, course) VALUES
(1, 'Group A', 1),
(2, 'Group B', 2),
(3, 'Group C', 1);

INSERT INTO Students (student_id, first_name, last_name, group_id) VALUES
(1, 'John', 'Doe', 1),
(2, 'Jane', 'Smith', 2),
(3, 'Emily', 'Johnson', 3);

INSERT INTO Teachers (teacher_id, first_name, last_name) VALUES
(1, 'Michael', 'Brown'),
(2, 'Anna', 'Wilson');

INSERT INTO Subjects (subject_id, subject_name) VALUES
(1, 'Mathematics'),
(2, 'Physics'),
(3, 'Biology'),
(4, 'History');

INSERT INTO Schedule (schedule_id, subject_id, group_id, day_of_week, start_time, end_time) VALUES
(1, 1, 1, 1, '09:00:00', '10:30:00'),
(2, 2, 2, 2, '11:00:00', '12:30:00');

INSERT INTO Tasks (task_id, task_name, task_text, task_status, deadline, task_owner, task_assignee, creation_time, last_updated_time) VALUES
(1, 'Math Homework', 'Complete exercises 1-5', 'Pending', '2024-01-10 23:59:59', 1, 3, NOW(), NOW()),
(2, 'Physics Assignment', 'Write a report on topic XYZ', 'InProgress', '2024-01-15 23:59:59', 2, 2, NOW(), NOW());