-- SHOW CREATE TABLE employee_id;
ALTER TABLE employee_id ADD INDEX (identification_num);
ALTER TABLE admin ADD CONSTRAINT fk_employee_id FOREIGN KEY (employee_id) REFERENCES employee_id (identification_num);

-- CREATE TABLE `employee_id` (
--   `id` int NOT NULL,
--   `identification_num` varchar(255) DEFAULT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

-- CREATE TABLE `admin` (
--   `id` int NOT NULL AUTO_INCREMENT,
--   `user_type` varchar(50) DEFAULT NULL,
--   `first_name` varchar(255) DEFAULT NULL,
--   `last_name` varchar(255) DEFAULT NULL,
--   `email` varchar(255) DEFAULT NULL,
--   `phone_number` varchar(20) DEFAULT NULL,
--   `admin_password` varchar(255) DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
--   `employee_id` int DEFAULT NULL,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `email` (`email`),
--   KEY `fk_employee_id` (`employee_id`),
--   CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee_id` (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
