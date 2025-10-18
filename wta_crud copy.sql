CREATE DATABASE IF NOT EXISTS `wda_catalog` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE `wda_catalog`;


CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` 		    varchar(100) NOT NULL,
  `cpf_cnpj` 	    varchar(14) NOT NULL,
  `birthdate`       datetime NOT NULL,
  `address` 	    varchar(255) NOT NULL,
  `hood` 		    varchar(100) NOT NULL,
  `zip_code` 	    varchar(8) NOT NULL,
  `city` 		    varchar(100) NOT NULL,
  `state` 		    varchar(2) NOT NULL,
  `phone` 		    varchar(13) NOT NULL,
  `ie` 			    varchar(15) NOT NULL,
  `created` 	    datetime NOT NULL,
  `modified` 	    datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `customers` (`name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `ie`, `created`, `modified`) 
VALUES
('Gabriel Rodrigues Neto', '44444444000', '2024-09-03 00:00:00', 'Antenor Maciel', 'Jardim Montreal', '18071410', 'Sorocaba', 'SP', '15991422976', '351234567', '2024-09-16 20:16:16', '2024-09-16 20:16:16'),
('Ana Beatriz Silva', '55555555000', '1990-03-15 00:00:00', 'Rua das Palmeiras', 'Centro', '18010010', 'Sorocaba', 'SP', '15998877665', '351234568', '2024-09-17 10:00:00', '2024-09-17 10:00:00'),
('João Pedro Souza', '66666666000', '1985-07-22 00:00:00', 'Av. Ipanema', 'Vila Progresso', '18010220', 'Sorocaba', 'SP', '15994455678', '351234569', '2024-09-18 14:30:00', '2024-09-18 14:30:00'),
('Maria Clara Oliveira', '77777777000', '2000-11-30 00:00:00', 'Rua dos Jasmins', 'Jardim Sônia Maria', '18070300', 'Sorocaba', 'SP', '15992233445', '351234570', '2024-09-19 09:00:00', '2024-09-19 09:00:00'),
('Pedro Henrique Costa', '88888888000', '1992-05-18 00:00:00', 'Rua Afonso Pena', 'Jardim Nova Esperança', '18060210', 'Sorocaba', 'SP', '15991122334', '351234571', '2024-09-20 15:20:00', '2024-09-20 15:20:00'),
('Fernanda Lima', '99999999000', '1998-12-10 00:00:00', 'Rua das Acácias', 'Vila das Flores', '18050120', 'Sorocaba', 'SP', '15990011223', '351234572', '2024-09-21 18:40:00', '2024-09-21 18:40:00'),
('Lucas Gomes Pereira', '11111111000', '1987-01-25 00:00:00', 'Rua dos Girassóis', 'Vila Vitória', '18040550', 'Sorocaba', 'SP', '15987766554', '351234573', '2024-09-22 11:50:00', '2024-09-22 11:50:00'),
('Sofia Martins', '22222222000', '2003-10-30 00:00:00', 'Av. São Paulo', 'Vila Brasilândia', '18030330', 'Sorocaba', 'SP', '15985544321', '351234574', '2024-09-23 13:10:00', '2024-09-23 13:10:00'),
('Eduardo Lima', '33333333000', '1995-06-02 00:00:00', 'Rua do Sol', 'Vila São João', '18040240', 'Sorocaba', 'SP', '15984433210', '351234575', '2024-09-24 08:25:00', '2024-09-24 08:25:00'),
('Larissa Costa', '44444444000', '1993-09-14 00:00:00', 'Rua São Vicente', 'Vila Primavera', '18030110', 'Sorocaba', 'SP', '15983322109', '351234576', '2024-09-25 17:00:00', '2024-09-25 17:00:00');


CREATE TABLE IF NOT EXISTS `gerentes` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(50) NOT null,
  `depto` varchar(20) NOT NULL,
  `datanasc` datetime NOT NULL,
  `foto` varchar(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gerentes` (`id`, `nome`, `endereco`, `depto`, `datanasc`, `foto`)
VALUES(1, 'helena', 'rua da web, 123', 'Roupas', '2024-09-19 00:00:00', 'helena.png');

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id`              int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome`            varchar(50) NOT NULL,
  `username`        varchar(50) NOT NULL,
  `password`        varchar(100) NOT NULL,
  `foto`            varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`nome`, `username`, `password`, `foto`)
VALUES
('Admin Principal', 'admin', '$2b$08$wtenGlXHYCalC.woCQUjbu7cMA21eh1YeRkmptnVAVQIFgul8NPoq', 'admin.png'),
('Usuário 1', 'user1', '$2y$10$ZNx81ZPb89TAwJUpwPfWh.oNL/F98ysdSX448rBV.C2TJkKBefnQG', 'user-1.png'),
('Usuário 2', 'user2', '$2y$10$U2laA/2UajFdcnQr8P27ruPB/MrVfJd6ywUHnAOMTqT43qu1Ccbr6', 'user-2.png'),
('Usuário 3', 'user3', '$2y$10$sQ4gVzpB8BPBzhA4E.qtte0CuCFiNN/twfn7GSXfPryNJxgqTNIQO', 'user-3.png'),
('Usuário 4', 'user4', '$2y$10$CoTFi8sRytpUfbMRr0GmieG4lc4CkJtdkk50vYXoyIZYE7nMB8hVu', 'user-4.png');

-- Senha do user1: user123
-- Senha do user2: user456
-- Senha do user3: user789
-- Senha do user4: user000