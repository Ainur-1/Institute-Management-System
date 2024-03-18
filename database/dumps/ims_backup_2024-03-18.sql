-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 18 2024 г., 16:36
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ims`
--
CREATE DATABASE IF NOT EXISTS `ims` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ims`;

-- --------------------------------------------------------

--
-- Структура таблицы `classtimes`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `classtimes`;
CREATE TABLE IF NOT EXISTS `classtimes` (
  `class_time_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`class_time_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `classtimes`:
--

--
-- Дамп данных таблицы `classtimes`
--

INSERT INTO `classtimes` (`class_time_id`, `start_time`, `end_time`) VALUES
(1, '08:00:00', '09:30:00'),
(2, '09:45:00', '11:15:00'),
(3, '11:30:00', '13:00:00'),
(4, '13:30:00', '15:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `roles`:
--

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `day_of_week` int(11) DEFAULT NULL,
  `class_time_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `subject_id` (`subject_id`),
  KEY `group_id` (`group_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `class_time_id` (`class_time_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `schedule`:
--   `subject_id`
--       `subjects` -> `subject_id`
--   `group_id`
--       `studentgroups` -> `group_id`
--   `teacher_id`
--       `teachers` -> `teacher_id`
--   `class_time_id`
--       `classtimes` -> `class_time_id`
--

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `subject_id`, `group_id`, `teacher_id`, `day_of_week`, `class_time_id`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 2, 3, 1, 2, 3),
(3, 3, 1, 1, 3, 1),
(4, 4, 2, 1, 4, 3),
(5, 1, 3, 1, 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `studentgroups`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `studentgroups`;
CREATE TABLE IF NOT EXISTS `studentgroups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `course` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `studentgroups`:
--

--
-- Дамп данных таблицы `studentgroups`
--

INSERT INTO `studentgroups` (`group_id`, `group_name`, `course`) VALUES
(1, 'Group A', 1),
(2, 'Group B', 2),
(3, 'Group C', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `students`:
--   `user_id`
--       `users` -> `user_id`
--   `group_id`
--       `studentgroups` -> `group_id`
--

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `group_id`) VALUES
(1, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `subjects`:
--

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Mathematics'),
(2, 'Physics'),
(3, 'Biology'),
(4, 'History');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(50) DEFAULT NULL,
  `task_text` varchar(500) DEFAULT NULL,
  `task_status` varchar(20) DEFAULT NULL,
  `deadline` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `task_owner` int(11) DEFAULT NULL,
  `task_assignee` int(11) DEFAULT NULL,
  `creation_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`task_id`),
  KEY `task_owner` (`task_owner`),
  KEY `task_assignee` (`task_assignee`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `tasks`:
--   `task_owner`
--       `users` -> `user_id`
--   `task_assignee`
--       `users` -> `user_id`
--

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_name`, `task_text`, `task_status`, `deadline`, `task_owner`, `task_assignee`, `creation_time`, `last_updated_time`) VALUES
(1, 'Math Homework', 'Complete exercises 1-5', 'Pending', '2024-01-10 20:59:59', 1, 3, '2024-03-18 15:19:54', '2024-03-18 15:19:54'),
(2, 'Physics Assignment', 'Write a report on topic XYZ', 'InProgress', '2024-01-15 20:59:59', 2, 2, '2024-03-18 15:19:54', '2024-03-18 15:19:54');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `teachers`:
--   `user_id`
--       `users` -> `user_id`
--

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `teachersubjects`
--
-- Создание: Мар 18 2024 г., 15:15
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `teachersubjects`;
CREATE TABLE IF NOT EXISTS `teachersubjects` (
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`teacher_id`,`subject_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `teachersubjects`:
--   `teacher_id`
--       `teachers` -> `teacher_id`
--   `subject_id`
--       `subjects` -> `subject_id`
--

--
-- Дамп данных таблицы `teachersubjects`
--

INSERT INTO `teachersubjects` (`teacher_id`, `subject_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--
-- Создание: Мар 18 2024 г., 15:19
-- Последнее обновление: Мар 18 2024 г., 15:19
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `users`:
--   `role_id`
--       `roles` -> `role_id`
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `registration_date`, `role_id`) VALUES
(1, 'Иван', 'Иванов', 'admin@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', '2024-03-18 15:19:54', 1),
(2, 'Генадий', 'Букин', 'teacher@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', '2024-03-18 15:19:54', 2),
(3, 'Владимир', 'Ленин', 'student@example.com', '$2y$10$TURls5Z01/fUvnWT4RwCH.8GRf9HTTqlYIAcuvT4JCQoH5Mzw4tvq', '2024-03-18 15:19:54', 3);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `studentgroups` (`group_id`),
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`class_time_id`) REFERENCES `classtimes` (`class_time_id`);

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `studentgroups` (`group_id`);

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`task_owner`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`task_assignee`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `teachersubjects`
--
ALTER TABLE `teachersubjects`
  ADD CONSTRAINT `teachersubjects_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `teachersubjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);


--
-- Метаданные
--
USE `phpmyadmin`;

--
-- Метаданные для таблицы classtimes
--

--
-- Метаданные для таблицы roles
--

--
-- Метаданные для таблицы schedule
--

--
-- Метаданные для таблицы studentgroups
--

--
-- Метаданные для таблицы students
--

--
-- Метаданные для таблицы subjects
--

--
-- Метаданные для таблицы tasks
--

--
-- Метаданные для таблицы teachers
--

--
-- Метаданные для таблицы teachersubjects
--

--
-- Метаданные для таблицы users
--

--
-- Метаданные для базы данных ims
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
