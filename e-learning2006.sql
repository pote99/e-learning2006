-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mag 07, 2018 alle 10:16
-- Versione del server: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e-learning2006`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `comune`
--

CREATE TABLE IF NOT EXISTS `comune` (
  `cod_comune` varchar(4) NOT NULL DEFAULT '',
  `descrizione` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`cod_comune`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `comune`
--

INSERT INTO `comune` (`cod_comune`, `descrizione`) VALUES
('F205', 'Milano'),
('F704', 'Monza'),
('F797', 'Muggiò'),
('F944', 'Nova Milanese');

-- --------------------------------------------------------

--
-- Struttura della tabella `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(80) NOT NULL DEFAULT '',
  `descrizione` text NOT NULL,
  `data` date NOT NULL DEFAULT '0000-00-00',
  `id_tipo` int(11) NOT NULL DEFAULT '0',
  `id_modulo` int(11) NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_documento`),
  KEY `id_tipo` (`id_tipo`),
  KEY `id_modulo` (`id_modulo`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `documento`
--

INSERT INTO `documento` (`id_documento`, `titolo`, `descrizione`, `data`, `id_tipo`, `id_modulo`, `username`) VALUES
(1, 'Equazione caratteristica del motore in CC', 'Dalle grandezze elettriche e meccaniche caratteristiche di un motore in CC all''equazione differenziale cartteristica', '1985-01-13', 2, 0, 'doc2'),
(2, 'Il modello ER', 'Dalla realtà dell''informazione allo schema ER che ne descrive entità e relazioni', '1999-09-12', 1, 8, 'doc0');

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppo`
--

CREATE TABLE IF NOT EXISTS `gruppo` (
  `id_gruppo` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_gruppo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `gruppo`
--

INSERT INTO `gruppo` (`id_gruppo`, `descrizione`) VALUES
(0, 'studente'),
(1, 'docente'),
(2, 'amministratore');

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizione`
--

CREATE TABLE IF NOT EXISTS `iscrizione` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `id_modulo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`,`id_modulo`),
  KEY `id_modulo` (`id_modulo`),
  KEY `id_modulo_2` (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `iscrizione`
--

INSERT INTO `iscrizione` (`username`, `id_modulo`) VALUES
('stud0', 0),
('stud0', 1),
('doc2', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `istituto`
--

CREATE TABLE IF NOT EXISTS `istituto` (
  `cod_istituto` varchar(10) NOT NULL DEFAULT '',
  `descrizione` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`cod_istituto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `istituto`
--

INSERT INTO `istituto` (`cod_istituto`, `descrizione`) VALUES
('MIPS050002', 'Liceo Frisi'),
('MITD068014', 'IIS Mosè Bianchi'),
('MITF50001', 'ITIS P.Hensemberger');

-- --------------------------------------------------------

--
-- Struttura della tabella `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(80) NOT NULL DEFAULT '',
  `docente_studente` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `descrizione`, `docente_studente`) VALUES
(0, 'La trasformata Z e il controllo automatico digitale', 0),
(1, 'Azionamento del motore elettrico in CC', 0),
(2, 'Produzione di moduli', 1),
(6, 'Programmare router CISCO come firewall DMZ', 0),
(7, 'Le ACL estese', 0),
(8, 'Data Base relazionali', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `descrizione`) VALUES
(1, 'pdf'),
(2, 'docx'),
(3, 'mpeg'),
(4, 'jpeg'),
(5, 'ppt'),
(6, 'html');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `cognome` varchar(80) NOT NULL DEFAULT '',
  `nome` varchar(80) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `cod_comune` varchar(4) NOT NULL DEFAULT '',
  `cod_istituto` varchar(10) NOT NULL DEFAULT '',
  `id_gruppo` int(11) NOT NULL DEFAULT '0',
  `confermato` tinyint(1) NOT NULL DEFAULT '0',
  `codice_conferma` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`username`),
  KEY `cod_comune` (`cod_comune`),
  KEY `cod_istituto` (`cod_istituto`),
  KEY `id_gruppo` (`id_gruppo`),
  KEY `cod_comune_2` (`cod_comune`),
  KEY `cod_istituto_2` (`cod_istituto`),
  KEY `id_gruppo_2` (`id_gruppo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `password`, `cognome`, `nome`, `email`, `cod_comune`, `cod_istituto`, `id_gruppo`, `confermato`, `codice_conferma`) VALUES
('admin0', 'AdMiN0', 'Cantù', 'Giorgio', 'g.cantu@hensemberger.it', 'F704', 'MIPS050002', 2, 0, 'aDmIn0'),
('doc0', 'DoC0', 'Bassani', 'Claudia', 'c.bassani@hensemberger.it', 'F797', 'MITF50001', 1, 0, 'dOc0'),
('doc1', 'DoC1', 'Ferrari', 'Marco', 'm.ferrari@hensemberger.it', 'F797', 'MITD068014', 1, 0, 'dOc1'),
('doc2', 'AdMiN1', 'Castoldi', 'Giorgio', 'g.castoldi@hensemberger.it', 'F944', 'MITF50001', 1, 0, 'aDmIn1'),
('stud0', 'StUd0', 'Villa', 'Emanuele', 'e.villa@hensemberger.it', 'F205', 'MITF50001', 0, 0, 'sTuD0'),
('stud1', 'StUd1', 'Pirovano', 'Valter', 'v.pirovano@hensemberger.it', 'F944', 'MIPS050002', 0, 0, 'sTuD1');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_ibfk_3` FOREIGN KEY (`username`) REFERENCES `utente` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `iscrizione`
--
ALTER TABLE `iscrizione`
  ADD CONSTRAINT `iscrizione_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utente` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iscrizione_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`cod_comune`) REFERENCES `comune` (`cod_comune`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utente_ibfk_2` FOREIGN KEY (`cod_istituto`) REFERENCES `istituto` (`cod_istituto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utente_ibfk_3` FOREIGN KEY (`id_gruppo`) REFERENCES `gruppo` (`id_gruppo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
