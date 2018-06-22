-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 18-Jun-2018 às 02:07
-- Versão do servidor: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amparomaternal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanhas`
--

CREATE TABLE `campanhas` (
  `id_campanha` int(10) NOT NULL,
  `nomeCampanha` varchar(200) NOT NULL,
  `dataInicial` date NOT NULL,
  `dataFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastro das campanhas.';

--
-- Extraindo dados da tabela `campanhas`
--

INSERT INTO `campanhas` (`id_campanha`, `nomeCampanha`, `dataInicial`, `dataFinal`) VALUES
(1, 'Nenhuma', '0000-00-00', '0000-00-00'),
(7, 'Natal', '2018-03-12', '2018-03-21'),
(9, 'teste', '2018-05-31', '2018-06-02'),
(10, 'asdasdsa', '2018-05-30', '2018-06-22'),
(11, 'sadas', '2018-05-01', '2018-05-31'),
(14, 'Victor', '2018-05-01', '2018-05-31'),
(15, 'asdadasdasasd', '2018-05-02', '2018-05-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoriasdespesa`
--

CREATE TABLE `categoriasdespesa` (
  `id` int(10) NOT NULL,
  `nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoriasdespesa`
--

INSERT INTO `categoriasdespesa` (`id`, `nome`) VALUES
(2, 'teste'),
(3, 'refeiÃ§ao'),
(4, 'Roupas'),
(5, 'sei la'),
(6, 'Agasalhos'),
(7, 'moveis'),
(8, 'higiene');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `idDespesa` int(10) NOT NULL,
  `idCategoria` int(10) NOT NULL,
  `infoDespesa` varchar(250) NOT NULL,
  `reais` int(10) NOT NULL,
  `centavos` int(2) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`idDespesa`, `idCategoria`, `infoDespesa`, `reais`, `centavos`, `data`) VALUES
(1, 3, 'alimentacao', 123, 34, '2018-04-15'),
(2, 3, 'Ali', 234, 48, '2018-04-22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doacao`
--

CREATE TABLE `doacao` (
  `id_doacao` int(10) NOT NULL,
  `id_tipoDoacao` int(100) NOT NULL,
  `item_doacao` varchar(200) NOT NULL,
  `id_campanha` int(10) NOT NULL,
  `id_doador` int(10) NOT NULL,
  `dataDoacao` date NOT NULL,
  `quantidade` int(10) NOT NULL,
  `valorDinheiro` float NOT NULL,
  `valorCentavos` int(2) NOT NULL,
  `tipoDinheiro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cadastro de Doacoes';

--
-- Extraindo dados da tabela `doacao`
--

INSERT INTO `doacao` (`id_doacao`, `id_tipoDoacao`, `item_doacao`, `id_campanha`, `id_doador`, `dataDoacao`, `quantidade`, `valorDinheiro`, `valorCentavos`, `tipoDinheiro`) VALUES
(1, 8, 'Dinheiro', 7, 1, '2018-03-15', 0, 123, 50, 1),
(2, 7, 'Ropunhasd', 7, 1, '2018-03-15', 5, 0, 0, 5),
(3, 7, 'Comidads', 7, 1, '2018-03-15', 54, 0, 0, 5),
(4, 7, 'Ropunhasd', 7, 1, '2018-03-15', 5, 0, 0, 5),
(5, 7, 'Ropunhasd', 7, 1, '2018-03-15', 5, 0, 0, 5),
(6, 8, 'Dinheiro', 1, 1, '2018-04-22', 0, 145, 50, 2),
(7, 7, 'Roupas', 14, 7, '2018-06-17', 1, 0, 0, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doador`
--

CREATE TABLE `doador` (
  `id_doador` int(100) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `endereco` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefoneResidencial` varchar(20) NOT NULL,
  `celular1` varchar(20) NOT NULL,
  `celular2` varchar(20) NOT NULL,
  `nascimento` date NOT NULL,
  `dataCadastro` date NOT NULL,
  `tipoDoador` varchar(20) NOT NULL,
  `reaisADoar` int(20) NOT NULL,
  `centavosADoar` varchar(2) NOT NULL,
  `doaDia` float NOT NULL,
  `doaMes` varchar(50) NOT NULL,
  `documento` varchar(80) NOT NULL,
  `tipoPessoa` varchar(20) NOT NULL,
  `operadora` varchar(150) NOT NULL,
  `turma` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `doador`
--

INSERT INTO `doador` (`id_doador`, `nome`, `endereco`, `email`, `telefoneResidencial`, `celular1`, `celular2`, `nascimento`, `dataCadastro`, `tipoDoador`, `reaisADoar`, `centavosADoar`, `doaDia`, `doaMes`, `documento`, `tipoPessoa`, `operadora`, `turma`) VALUES
(1, 'Victor Assis', 'Zeca Preto 68', 'vitinhomx@outlook.com', '324234234', '325432343', '323534', '1994-12-05', '2018-03-08', 'Fidelizado', 0, '0', 10, 'nenhum', '', 'FÃ­sica', '*', '*'),
(2, 'Joao Paulo', 'Rua A, Bairro B, numero 22', 'jp@email.com', '38232332', '999999999', '999999999', '2018-05-16', '2018-05-15', 'Fidelizado', 0, '0', 10, 'nenhum', '', 'Física', '*', '*'),
(3, 'Joao Vitor Rodrigues', 'Rua A, numero 6, Bairro São Joao', 'asdas@asdasasd.com', '0 00 0000-0000', '0 00 0 0000-0000', '0 00 0 0000-0000', '1994-01-01', '2018-05-20', 'Exporádico', 0, '0', 0, 'Aleatório', '123.456.789-90', 'Física', 'S.I.', '3º período'),
(4, 'Teste', 'teste', 'teste@te.com', '424554543', '43534534543', '4353456', '1990-01-01', '2018-06-03', 'Fidelizado', 0, '0', 5, 'Não defini', '11456734590', 'Física', 'Joana', 'Terceiro periodo'),
(5, 'Marta', 'asqreqfcas asdasdas dasdas', 'dafadsads@asdasd.com', '3253455', '68588658', '9876679', '1990-01-01', '2018-06-03', 'Fidelizado', 150, '05', 14, 'Não definido', '46568687643', 'Física', '65756776', '45647889878'),
(6, 'Antonio', 'sadasdas', 'asdas@asdasd.coasc', '6666', '887897897', '898787897', '1990-01-01', '2018-06-03', 'Exporádico', 0, '0', 0, 'Agosto', '3654654645', 'Física', '*', '*'),
(7, 'Pedro Antonio', 'Rua asdasdlk kasdkads', 'asda@asddas.com', '435345345', '35534534', '345345345', '1986-03-31', '2018-06-13', 'Fidelizado', 120, '00', 15, 'Não definido', '12312312312', 'Física', 'n sei', 'n sei');

-- --------------------------------------------------------

--
-- Estrutura da tabela `numerorecibo`
--

CREATE TABLE `numerorecibo` (
  `id` int(11) NOT NULL,
  `numero` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `numerorecibo`
--

INSERT INTO `numerorecibo` (`id`, `numero`) VALUES
(1, '236');

-- --------------------------------------------------------

--
-- Estrutura da tabela `opcoesrelatorio`
--

CREATE TABLE `opcoesrelatorio` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `opcoesrelatorio`
--

INSERT INTO `opcoesrelatorio` (`id`, `nome`) VALUES
(1, 'DESPESAS'),
(2, 'DOACAO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recibos`
--

CREATE TABLE `recibos` (
  `idRecibo` int(11) NOT NULL,
  `idDoador` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `numero` varchar(250) NOT NULL,
  `data` date NOT NULL,
  `reais` varchar(255) NOT NULL,
  `centavos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `recibos`
--

INSERT INTO `recibos` (`idRecibo`, `idDoador`, `nome`, `numero`, `data`, `reais`, `centavos`) VALUES
(1, 5, 'Marta', '37', '0000-00-00', '150', '5'),
(2, 5, 'Marta', '38', '2018-06-09', '150', '5'),
(3, 5, 'Marta', '39', '2018-06-09', '150', '5'),
(4, 5, 'Marta', '42', '0000-00-00', '150', '5'),
(5, 7, 'Pedro Antonio', '145', '2018-06-16', '120', '0'),
(6, 7, 'Pedro Antonio', '146', '2018-06-16', '120', '00'),
(7, 6, 'Antonio', '147', '2018-06-16', '0', '0'),
(8, 7, 'Pedro Antonio', '150', '2018-06-16', '120', '00'),
(9, 7, 'Pedro Antonio', '156', '2018-06-16', '120', '00'),
(10, 7, 'Pedro Antonio', '157', '2018-06-16', '120', '00'),
(11, 7, 'Pedro Antonio', '171', '2018-06-16', '120', '00'),
(12, 7, 'Pedro Antonio', '172', '2018-06-16', '120', '00'),
(13, 7, 'Pedro Antonio', '180', '2018-06-16', '190', '00'),
(14, 7, 'Pedro Antonio', '182', '2018-06-16', '120', '00'),
(15, 3, 'Joao Vitor Rodrigues', '184', '2018-06-16', '0', '0'),
(16, 2, 'Joao Paulo', '186', '2018-06-16', '0', '0'),
(17, 5, 'Marta', '187', '2018-06-16', '150', '05'),
(18, 1, 'Victor Assis', '188', '0000-00-00', '0', '0'),
(19, 2, 'Joao Paulo', '189', '0000-00-00', '0', '0'),
(20, 1, 'Victor Assis', '190', '0000-00-00', '0', '0'),
(21, 2, 'Joao Paulo', '191', '0000-00-00', '0', '0'),
(22, 1, 'Victor Assis', '192', '0000-00-00', '0', '0'),
(23, 2, 'Joao Paulo', '193', '0000-00-00', '0', '0'),
(24, 1, 'Victor Assis', '194', '0000-00-00', '0', '0'),
(25, 2, 'Joao Paulo', '195', '0000-00-00', '0', '0'),
(26, 1, 'Victor Assis', '196', '0000-00-00', '0', '0'),
(27, 2, 'Joao Paulo', '197', '0000-00-00', '0', '0'),
(28, 1, 'Victor Assis', '198', '0000-00-00', '0', '0'),
(29, 2, 'Joao Paulo', '199', '0000-00-00', '0', '0'),
(30, 1, 'Victor Assis', '200', '0000-00-00', '0', '0'),
(31, 2, 'Joao Paulo', '201', '0000-00-00', '0', '0'),
(32, 1, 'Victor Assis', '202', '0000-00-00', '0', '0'),
(33, 2, 'Joao Paulo', '203', '0000-00-00', '0', '0'),
(34, 1, 'Victor Assis', '204', '0000-00-00', '0', '0'),
(35, 2, 'Joao Paulo', '205', '0000-00-00', '0', '0'),
(36, 1, 'Victor Assis', '206', '0000-00-00', '0', '0'),
(37, 2, 'Joao Paulo', '207', '0000-00-00', '0', '0'),
(38, 1, 'Victor Assis', '208', '0000-00-00', '0', '0'),
(39, 2, 'Joao Paulo', '209', '0000-00-00', '0', '0'),
(40, 1, 'Victor Assis', '210', '0000-00-00', '0', '0'),
(41, 2, 'Joao Paulo', '211', '0000-00-00', '0', '0'),
(42, 1, 'Victor Assis', '212', '0000-00-00', '0', '0'),
(43, 2, 'Joao Paulo', '213', '0000-00-00', '0', '0'),
(44, 1, 'Victor Assis', '214', '0000-00-00', '0', '0'),
(45, 2, 'Joao Paulo', '215', '0000-00-00', '0', '0'),
(46, 1, 'Victor Assis', '216', '0000-00-00', '0', '0'),
(47, 2, 'Joao Paulo', '217', '0000-00-00', '0', '0'),
(48, 1, 'Victor Assis', '218', '0000-00-00', '0', '0'),
(49, 2, 'Joao Paulo', '219', '0000-00-00', '0', '0'),
(50, 1, 'Victor Assis', '220', '0000-00-00', '0', '0'),
(51, 2, 'Joao Paulo', '221', '0000-00-00', '0', '0'),
(52, 1, 'Victor Assis', '222', '0000-00-00', '0', '0'),
(53, 2, 'Joao Paulo', '223', '0000-00-00', '0', '0'),
(54, 1, 'Victor Assis', '224', '0000-00-00', '0', '0'),
(55, 2, 'Joao Paulo', '225', '0000-00-00', '0', '0'),
(56, 1, 'Victor Assis', '226', '0000-00-00', '0', '0'),
(57, 2, 'Joao Paulo', '227', '0000-00-00', '0', '0'),
(58, 1, 'Victor Assis', '228', '0000-00-00', '0', '0'),
(59, 2, 'Joao Paulo', '229', '0000-00-00', '0', '0'),
(60, 1, 'Victor Assis', '230', '0000-00-00', '0', '0'),
(61, 2, 'Joao Paulo', '231', '0000-00-00', '0', '0'),
(62, 1, 'Victor Assis', '232', '0000-00-00', '0', '0'),
(63, 2, 'Joao Paulo', '233', '0000-00-00', '0', '0'),
(64, 6, 'Antonio', '234', '2018-06-17', '0', '0'),
(65, 7, 'Pedro Antonio', '236', '2018-06-17', '120', '00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipodoacao`
--

CREATE TABLE `tipodoacao` (
  `id_tipoDoacao` int(100) NOT NULL,
  `nome` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipodoacao`
--

INSERT INTO `tipodoacao` (`id_tipoDoacao`, `nome`) VALUES
(1, 'Nenhuma'),
(7, 'roupasinhas'),
(8, 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipodoacaodinheiro`
--

CREATE TABLE `tipodoacaodinheiro` (
  `idTipoDinheiro` int(100) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipodoacaodinheiro`
--

INSERT INTO `tipodoacaodinheiro` (`idTipoDinheiro`, `tipo`) VALUES
(1, 'deposito'),
(2, 'especie'),
(3, 'cheque'),
(4, 'cartao'),
(5, 'outro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposbusca`
--

CREATE TABLE `tiposbusca` (
  `idTipoBusca` int(5) NOT NULL,
  `tipoBusca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tiposbusca`
--

INSERT INTO `tiposbusca` (`idTipoBusca`, `tipoBusca`) VALUES
(1, 'DOADOR'),
(2, 'DOACAO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nivel` varchar(5) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `sobrenome`, `nome_usuario`, `senha`, `nivel`) VALUES
(1, 'Victor', 'Assis', 'victor', '123456', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campanhas`
--
ALTER TABLE `campanhas`
  ADD PRIMARY KEY (`id_campanha`);

--
-- Indexes for table `categoriasdespesa`
--
ALTER TABLE `categoriasdespesa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`idDespesa`);

--
-- Indexes for table `doacao`
--
ALTER TABLE `doacao`
  ADD PRIMARY KEY (`id_doacao`);

--
-- Indexes for table `doador`
--
ALTER TABLE `doador`
  ADD PRIMARY KEY (`id_doador`);

--
-- Indexes for table `numerorecibo`
--
ALTER TABLE `numerorecibo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opcoesrelatorio`
--
ALTER TABLE `opcoesrelatorio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`idRecibo`);

--
-- Indexes for table `tipodoacao`
--
ALTER TABLE `tipodoacao`
  ADD PRIMARY KEY (`id_tipoDoacao`);

--
-- Indexes for table `tipodoacaodinheiro`
--
ALTER TABLE `tipodoacaodinheiro`
  ADD PRIMARY KEY (`idTipoDinheiro`);

--
-- Indexes for table `tiposbusca`
--
ALTER TABLE `tiposbusca`
  ADD PRIMARY KEY (`idTipoBusca`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campanhas`
--
ALTER TABLE `campanhas`
  MODIFY `id_campanha` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `categoriasdespesa`
--
ALTER TABLE `categoriasdespesa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `despesas`
--
ALTER TABLE `despesas`
  MODIFY `idDespesa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `doacao`
--
ALTER TABLE `doacao`
  MODIFY `id_doacao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `doador`
--
ALTER TABLE `doador`
  MODIFY `id_doador` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `numerorecibo`
--
ALTER TABLE `numerorecibo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `opcoesrelatorio`
--
ALTER TABLE `opcoesrelatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `recibos`
--
ALTER TABLE `recibos`
  MODIFY `idRecibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tipodoacao`
--
ALTER TABLE `tipodoacao`
  MODIFY `id_tipoDoacao` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tipodoacaodinheiro`
--
ALTER TABLE `tipodoacaodinheiro`
  MODIFY `idTipoDinheiro` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tiposbusca`
--
ALTER TABLE `tiposbusca`
  MODIFY `idTipoBusca` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
