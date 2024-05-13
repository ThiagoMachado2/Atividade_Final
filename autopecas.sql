CREATE DATABASE autopecas;

USE autopecas;

-- Tabela para o cadastro de peças
CREATE TABLE IF NOT EXISTS Pecas (
    Cod_Peca INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Peca VARCHAR(100),
    Fornecedor VARCHAR(100),
    Valor_Compra DECIMAL(10, 2),
    Valor_Venda DECIMAL(10, 2),
    Quantidade INT,
    Imagem VARCHAR(255)
);

-- Tabela para o registro de vendas concluídas
CREATE TABLE IF NOT EXISTS Vendas (
    Cod_Venda INT AUTO_INCREMENT PRIMARY KEY,
    Data_Venda DATE,
    Total DECIMAL(10, 2)
);

-- Tabela para o registro dos itens vendidos
CREATE TABLE IF NOT EXISTS Itens_Venda (
    Cod_Item INT AUTO_INCREMENT PRIMARY KEY,
    Cod_Venda INT,
    Cod_Peca INT,
    Nome_Peca VARCHAR(100),
    Valor_Venda DECIMAL(10, 2),
    Quantidade INT,
    Total_Item DECIMAL(10, 2),
    FOREIGN KEY (Cod_Venda) REFERENCES Vendas(Cod_Venda),
    FOREIGN KEY (Cod_Peca) REFERENCES Pecas(Cod_Peca)
);

CREATE TABLE IF NOT EXISTS Events(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    color VARCHAR(45),
    start DATETIME,
    end DATETIME
)