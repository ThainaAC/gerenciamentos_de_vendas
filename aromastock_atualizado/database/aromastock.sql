CREATE DATABASE IF NOT EXISTS aromastock CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE aromastock;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    endereco VARCHAR(150) NOT NULL
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    quantidade INT NOT NULL DEFAULT 0,
    preco_compra DECIMAL(10,2) NOT NULL DEFAULT 0,
    preco_venda DECIMAL(10,2) NOT NULL DEFAULT 0,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    data_venda DATE NOT NULL,
    total DECIMAL(10,2) NOT NULL DEFAULT 0,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE itens_venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venda_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (venda_id) REFERENCES vendas(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

CREATE TABLE movimentacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    tipo ENUM('ENTRADA','SAIDA') NOT NULL,
    quantidade INT NOT NULL,
    preco_compra DECIMAL(10,2),
    data_movimentacao DATE NOT NULL,
    observacao VARCHAR(255),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

INSERT INTO usuarios (nome, login, senha)
VALUES ('Administrador', 'admin', MD5('123'));

INSERT INTO categorias (nome) VALUES
('Perfume Feminino'),
('Perfume Masculino'),
('Body Splash'),
('Perfume Infantil');
