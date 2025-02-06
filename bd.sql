CREATE DATABASE Pizzaria;
USE Pizzaria;

CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE Cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL
);


CREATE TABLE Atendente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    funcao VARCHAR(50) NOT NULL
);


CREATE TABLE Pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dataPedido DATETIME NOT NULL,
    status ENUM('Em andamento', 'Finalizado', 'Cancelado') NOT NULL,
    precoTotal DECIMAL(10,2) NOT NULL,
    cliente_id INT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES Cliente(id)
);


CREATE TABLE Pizza (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tamanho ENUM('Média', 'Grande', 'Gigante') NOT NULL,
    sabor VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    status ENUM('Preparando', 'Assando', 'Entregue') NOT NULL
);


CREATE TABLE Pedido_Pizza (
    pedido_id INT NOT NULL,
    pizza_id INT NOT NULL,
    PRIMARY KEY (pedido_id, pizza_id),
    FOREIGN KEY (pedido_id) REFERENCES Pedido(id),
    FOREIGN KEY (pizza_id) REFERENCES Pizza(id)
);

INSERT INTO `Usuario`(`username`, `senha`) VALUES (`ademiro`, `1234`)