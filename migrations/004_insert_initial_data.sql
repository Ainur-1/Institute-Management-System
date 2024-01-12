-- 004_insert_initial_data.sql

USE ims;

INSERT INTO Roles (role_id, role_name) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student');

INSERT INTO Users (user_id, first_name, last_name, email, password, registration_date, role_id) VALUES
(1, 'Иван', 'Иванов', 'admin@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', NOW(), 1),
(2, 'Генадий', 'Букин', 'teacher@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', NOW(), 2),
(3, 'Владимир', 'Ленин', 'student@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', NOW(), 3);

INSERT INTO StudentGroups (group_id, group_name, course) VALUES
(1, 'Group A', 1),
(2, 'Group B', 2),
(3, 'Group C', 1);

INSERT INTO Students (student_id, user_id, group_id) VALUES
(1, 3, 1);

INSERT INTO Teachers (teacher_id, user_id) VALUES
(1, 2);

INSERT INTO Subjects (subject_id, subject_name) VALUES
(1, 'Mathematics'),
(2, 'Physics'),
(3, 'Biology'),
(4, 'History');

INSERT INTO TeacherSubjects (teacher_id, subject_id) VALUES 
(1, 1),
(1, 2),
(1, 3),
(1, 4);

INSERT INTO ClassTimes (start_time, end_time) VALUES
('08:00:00', '09:30:00'),
('09:45:00', '11:15:00'),
('11:30:00', '13:00:00'),
('13:30:00', '15:00:00');

INSERT INTO Schedule (subject_id, group_id, teacher_id, day_of_week, class_time_id) VALUES
(1, 1, 1, 1, 1),
(2, 3, 1, 2, 3),
(3, 1, 1, 3, 1),
(4, 2, 1, 4, 3),
(1, 3, 1, 5, 1);

INSERT INTO TaskStatuses (status_name) VALUES
('Не начата'),
('В процессе'),
('Завершена'),
('Отменена'),
('Просрочена');

INSERT INTO Tasks (task_id, task_name, task_text, task_status_id, deadline, task_owner, task_assignee, creation_time, last_updated_time) VALUES
(1, 'Math Homework', 'Complete exercises 1-5', 1, '2024-01-10 23:59:59', 1, 3, NOW(), NOW()),
(2, 'Physics Assignment', 'Write a report on topic XYZ', 1, '2024-01-15 23:59:59', 2, 2, NOW(), NOW());