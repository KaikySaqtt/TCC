DROP DATABASE IF EXISTS km_catalog;
CREATE DATABASE km_catalog CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE km_catalog;

-- TABELA DE USUÁRIOS
CREATE TABLE tab_usuarios (
  id_user INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  cpf_cnpj VARCHAR(14) NOT NULL,
  password VARCHAR(100) NOT NULL,
  telefone varchar(11) not null,
  UNIQUE KEY uq_usuarios_cpf_cnpj (cpf_cnpj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tab_usuarios (name, cpf_cnpj, password, telefone) VALUES
('Admin Principal', '12345678911', '$2b$08$wtenGlXHYCalC.woCQUjbu7cMA21eh1YeRkmptnVAVQIFgul8NPoq', '15655538459'),
('Usuário 4', '12121212121', '$2y$10$CoTFi8sRytpUfbMRr0GmieG4lc4CkJtdkk50vYXoyIZYE7nMB8hVu', '15655538939');

-- TABELA DE ORÇAMENTO JANTAR
CREATE TABLE tab_orcamento_jantar (
  id_jan INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  endereco VARCHAR(50) NOT NULL,
  quantidade_pessoas INT NOT NULL,
  data_do_evento DATETIME NOT NULL,
  jantar_ou_almoco VARCHAR(8) NOT NULL,
  drinks BOOLEAN NOT NULL,
  sobremesas BOOLEAN NOT NULL,
  detalhes_jan VARCHAR(1500) NOT NULL,
  data_do_orcamento_jan DATETIME NOT NULL,
  cpf_cnpj_usuario VARCHAR(14) NOT NULL,
  CONSTRAINT fk_orcamento_jantar_usuario 
    FOREIGN KEY (cpf_cnpj_usuario) REFERENCES tab_usuarios(cpf_cnpj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tab_orcamento_jantar
(endereco, quantidade_pessoas, data_do_evento, jantar_ou_almoco, drinks, sobremesas, detalhes_jan, cpf_cnpj_usuario, data_do_orcamento_jan)
VALUES 
('rua monteiro lobato 21', 45, '2024-09-19 00:00:00', 'almoço', 1, 0, 'eu quero um teste...', '12121212121', '2024-08-19 00:00:00');

-- TABELA DE ORÇAMENTO MARMITA
CREATE TABLE tab_orcamento_marmita (
  id_mar INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  quantidade_marmitas INT NOT NULL,
  fit_ou_normal VARCHAR(6) NOT NULL,
  dieta_ou_nao VARCHAR(6) NOT NULL,
  detalhes_mar VARCHAR(1500) NOT NULL,
  data_do_orcamento_mar DATETIME NOT NULL,
  cpf_cnpj_usuario VARCHAR(14) NOT NULL,
  CONSTRAINT fk_orcamento_marmita_usuario 
    FOREIGN KEY (cpf_cnpj_usuario) REFERENCES tab_usuarios(cpf_cnpj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tab_orcamento_marmita 
(quantidade_marmitas, fit_ou_normal, dieta_ou_nao, detalhes_mar, cpf_cnpj_usuario, data_do_orcamento_mar)
VALUES 
(14, 'fit', 'dieta', 'eu quero um teste...', '12121212121', '2024-09-18 00:00:00');
