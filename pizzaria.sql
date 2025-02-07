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

CREATE TABLE `pedido` (
  `id_cliente` int(20) NOT NULL,
  `valor_total` double NOT NULL
);

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `quantidade` int(20) NOT NULL,
  `tamanho` enum('Média','Grande','Gigante') NOT NULL,
  `sabor` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` enum('Preparando','Assando','Entregue') NOT NULL
);

INSERT INTO `usuario` (`id`, `username`, `senha`) VALUES
(1, 'ademiro', '1234');
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
