/*
Navicat MySQL Data Transfer

Source Server         : conex
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : sistema_nota

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-01-19 23:37:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for competencia
-- ----------------------------
DROP TABLE IF EXISTS `competencia`;
CREATE TABLE `competencia` (
  `id_competencias` int(11) NOT NULL AUTO_INCREMENT,
  `competencia` text NOT NULL,
  `curso` int(11) NOT NULL,
  `año` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_competencias`),
  KEY `fk8` (`curso`),
  CONSTRAINT `fk8` FOREIGN KEY (`curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of competencia
-- ----------------------------

-- ----------------------------
-- Table structure for curso
-- ----------------------------
DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `docente` bigint(20) NOT NULL,
  `id_grado` int(11) NOT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `fk7_idx` (`id_grado`),
  KEY `fk16_idx` (`docente`),
  CONSTRAINT `fk16` FOREIGN KEY (`docente`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk7` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of curso
-- ----------------------------
INSERT INTO `curso` VALUES ('37', 'ARTE', '58', '37');
INSERT INTO `curso` VALUES ('38', 'COMUNICACION', '49', '37');
INSERT INTO `curso` VALUES ('39', 'ARTE', '48', '1');
INSERT INTO `curso` VALUES ('40', 'MATEMATICA', '49', '17');
INSERT INTO `curso` VALUES ('41', 'COMUNICACION', '58', '1');
INSERT INTO `curso` VALUES ('43', 'INGLES', '60', '37');
INSERT INTO `curso` VALUES ('44', 'CIENCIA TECNOLOGIA Y AMBIENTE', '58', '1');
INSERT INTO `curso` VALUES ('45', 'CIENCIA TECNOLOGIA Y AMBIENTE', '66', '27');
INSERT INTO `curso` VALUES ('46', 'FORMACION CIUDADANA Y CIVICA', '71', '17');
INSERT INTO `curso` VALUES ('47', 'HISTORIA', '49', '30');
INSERT INTO `curso` VALUES ('48', 'INGLES', '60', '23');
INSERT INTO `curso` VALUES ('49', 'FORMACION CIUDADANA Y CIVICA', '60', '30');
INSERT INTO `curso` VALUES ('50', 'ARTE', '60', '18');
INSERT INTO `curso` VALUES ('51', 'MATEMATICA', '58', '37');
INSERT INTO `curso` VALUES ('52', 'FISICA', '48', '1');
INSERT INTO `curso` VALUES ('53', 'IDIOMA', '58', '37');
INSERT INTO `curso` VALUES ('54', 'FORMACION CIUDADANA Y CIVICA', '48', '37');
INSERT INTO `curso` VALUES ('56', 'COMUNICACION', '49', '2');
INSERT INTO `curso` VALUES ('57', 'ARTE', '58', '21');
INSERT INTO `curso` VALUES ('60', 'COMPUTACION', '66', '40');

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `ruc` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES ('1', 'Maria Parado', null, null, null);

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `curso` int(11) NOT NULL,
  `grado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grado` (`grado`),
  KEY `materia` (`curso`) USING BTREE,
  CONSTRAINT `grado` FOREIGN KEY (`grado`) REFERENCES `grado` (`id_grado`),
  CONSTRAINT `materia` FOREIGN KEY (`curso`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES ('91', null, '#FF8C00', '2021-01-05 07:45:00', '2021-01-05 09:15:00', '6', '1');
INSERT INTO `events` VALUES ('92', null, '#008000', '2021-01-06 07:45:00', '2021-01-06 08:45:00', '7', '1');
INSERT INTO `events` VALUES ('94', null, '#008000', '2021-01-07 07:00:00', '2021-01-07 09:15:00', '7', '1');
INSERT INTO `events` VALUES ('95', null, '#FF8C00', '2021-01-04 07:15:00', '2021-01-04 08:15:00', '10', '14');
INSERT INTO `events` VALUES ('96', null, '#FFD700', '2021-01-07 08:00:00', '2021-01-07 09:15:00', '7', '14');
INSERT INTO `events` VALUES ('97', null, '#FF8C00', '2021-01-04 07:15:00', '2021-01-04 08:30:00', '8', '2');
INSERT INTO `events` VALUES ('98', null, '#40E0D0', '2021-01-05 07:30:00', '2021-01-05 08:45:00', '6', '2');
INSERT INTO `events` VALUES ('99', null, null, '2021-01-04 07:00:00', '2021-01-04 08:30:00', '9', '16');
INSERT INTO `events` VALUES ('100', null, null, '2021-01-06 08:00:00', '2021-01-06 08:45:00', '14', '16');
INSERT INTO `events` VALUES ('101', null, '#008000', '2021-01-04 07:00:00', '2021-01-04 08:45:00', '8', '37');
INSERT INTO `events` VALUES ('102', null, null, '2021-01-05 07:45:00', '2021-01-05 08:45:00', '9', '37');
INSERT INTO `events` VALUES ('103', null, '#0071c5', '2021-01-07 08:00:00', '2021-01-07 09:15:00', '9', '37');
INSERT INTO `events` VALUES ('104', null, '#FF0000', '2021-01-04 09:30:00', '2021-01-04 10:30:00', '15', '1');
INSERT INTO `events` VALUES ('105', null, '#008000', '2021-01-04 07:15:00', '2021-01-04 08:00:00', '11', '1');

-- ----------------------------
-- Table structure for grado
-- ----------------------------
DROP TABLE IF EXISTS `grado`;
CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL AUTO_INCREMENT,
  `grado` varchar(255) NOT NULL,
  `seccion` int(11) NOT NULL,
  PRIMARY KEY (`id_grado`),
  KEY `fk` (`seccion`),
  CONSTRAINT `fk` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`id_seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grado
-- ----------------------------
INSERT INTO `grado` VALUES ('1', '1°', '1');
INSERT INTO `grado` VALUES ('2', '1°', '2');
INSERT INTO `grado` VALUES ('3', '1°', '3');
INSERT INTO `grado` VALUES ('4', '1°', '4');
INSERT INTO `grado` VALUES ('5', '1°', '5');
INSERT INTO `grado` VALUES ('10', '1°', '6');
INSERT INTO `grado` VALUES ('11', '1°', '7');
INSERT INTO `grado` VALUES ('14', '2°', '1');
INSERT INTO `grado` VALUES ('15', '2°', '2');
INSERT INTO `grado` VALUES ('16', '2°', '3');
INSERT INTO `grado` VALUES ('17', '2°', '4');
INSERT INTO `grado` VALUES ('18', '2°', '5');
INSERT INTO `grado` VALUES ('19', '2°', '6');
INSERT INTO `grado` VALUES ('20', '2°', '7');
INSERT INTO `grado` VALUES ('21', '3°', '1');
INSERT INTO `grado` VALUES ('22', '3°', '2');
INSERT INTO `grado` VALUES ('23', '3°', '3');
INSERT INTO `grado` VALUES ('24', '3°', '4');
INSERT INTO `grado` VALUES ('25', '3°', '5');
INSERT INTO `grado` VALUES ('26', '3°', '6');
INSERT INTO `grado` VALUES ('27', '3°', '7');
INSERT INTO `grado` VALUES ('28', '4°', '1');
INSERT INTO `grado` VALUES ('29', '4°', '2');
INSERT INTO `grado` VALUES ('30', '4°', '3');
INSERT INTO `grado` VALUES ('31', '4°', '4');
INSERT INTO `grado` VALUES ('32', '4°', '5');
INSERT INTO `grado` VALUES ('33', '4°', '6');
INSERT INTO `grado` VALUES ('34', '4°', '7');
INSERT INTO `grado` VALUES ('35', '5°', '1');
INSERT INTO `grado` VALUES ('36', '5°', '2');
INSERT INTO `grado` VALUES ('37', '5°', '3');
INSERT INTO `grado` VALUES ('38', '5°', '4');
INSERT INTO `grado` VALUES ('39', '5°', '5');
INSERT INTO `grado` VALUES ('40', '5°', '6');
INSERT INTO `grado` VALUES ('41', '5°', '7');

-- ----------------------------
-- Table structure for horario
-- ----------------------------
DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `archivo` longblob DEFAULT NULL,
  `grado` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `link` longtext DEFAULT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `horario` (`grado`),
  CONSTRAINT `horario` FOREIGN KEY (`grado`) REFERENCES `grado` (`id_grado`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of horario
-- ----------------------------
INSERT INTO `horario` VALUES ('50', '', '1', '', 'gggggggggg');
INSERT INTO `horario` VALUES ('51', '', '2', '', 'gggggggggg');
INSERT INTO `horario` VALUES ('52', '', '3', '', 'gggggggggg');
INSERT INTO `horario` VALUES ('53', '', '4', '', 'gggggggggg');
INSERT INTO `horario` VALUES ('54', '', '5', '', 'ddd');

-- ----------------------------
-- Table structure for institucion
-- ----------------------------
DROP TABLE IF EXISTS `institucion`;
CREATE TABLE `institucion` (
  `id_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of institucion
-- ----------------------------
INSERT INTO `institucion` VALUES ('1', 'José Galvez', 'Somos la mejor institucion en el vraem', 'av. el ejercito', '978456321');

-- ----------------------------
-- Table structure for materia
-- ----------------------------
DROP TABLE IF EXISTS `materia`;
CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of materia
-- ----------------------------
INSERT INTO `materia` VALUES ('6', 'COMUNICACION');
INSERT INTO `materia` VALUES ('7', 'ARTE');
INSERT INTO `materia` VALUES ('8', 'MATEMATICA');
INSERT INTO `materia` VALUES ('9', 'INGLES');
INSERT INTO `materia` VALUES ('10', 'IDIOMA');
INSERT INTO `materia` VALUES ('11', 'COMPUTACION');
INSERT INTO `materia` VALUES ('12', 'PERSONA FAMILIA Y RELACION HUMANAS');
INSERT INTO `materia` VALUES ('13', 'FORMACION CIUDADANA Y CIVICA');
INSERT INTO `materia` VALUES ('14', 'FISICA');
INSERT INTO `materia` VALUES ('15', 'CIENCIA TECNOLOGIA Y AMBIENTE');
INSERT INTO `materia` VALUES ('16', 'HISTORIA');
INSERT INTO `materia` VALUES ('17', 'QUIMICA');
INSERT INTO `materia` VALUES ('18', 'PROGRAMACION');
INSERT INTO `materia` VALUES ('19', 'TALLER DE BASE DE DATOS');

-- ----------------------------
-- Table structure for nota
-- ----------------------------
DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `estudiante` bigint(20) DEFAULT NULL,
  `curso` int(11) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `nota1` decimal(10,0) DEFAULT NULL,
  `nota2` decimal(10,0) DEFAULT NULL,
  `nota3` decimal(10,0) DEFAULT NULL,
  `promedio` tinyint(10) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `anio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `fk10` (`curso`),
  KEY `fk11` (`semestre`),
  KEY `fk15_idx` (`estudiante`),
  CONSTRAINT `fk10` FOREIGN KEY (`curso`) REFERENCES `curso` (`id_curso`),
  CONSTRAINT `fk11` FOREIGN KEY (`semestre`) REFERENCES `semestre` (`id_semestre`),
  CONSTRAINT `fk15` FOREIGN KEY (`estudiante`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nota
-- ----------------------------
INSERT INTO `nota` VALUES ('43', '94', '41', '1', '14', '18', '19', '17', null, '2020');
INSERT INTO `nota` VALUES ('44', '84', '37', '1', '20', '20', '20', '20', null, '2020');
INSERT INTO `nota` VALUES ('45', '85', '37', '1', '17', '13', '11', '14', null, '2020');
INSERT INTO `nota` VALUES ('46', '90', '37', '1', '15', '15', '15', '15', null, '2020');
INSERT INTO `nota` VALUES ('47', '91', '37', '1', '16', '17', '0', '11', null, '2020');
INSERT INTO `nota` VALUES ('51', '92', '41', '1', '11', '15', '10', '12', null, '2020');
INSERT INTO `nota` VALUES ('52', '92', '44', '1', '20', '20', '8', '16', null, '2020');
INSERT INTO `nota` VALUES ('53', '93', '41', '1', '14', '12', '16', '14', null, '2020');
INSERT INTO `nota` VALUES ('55', '98', '41', '1', '10', '11', '13', '11', null, '2020');
INSERT INTO `nota` VALUES ('56', '84', '51', '1', '20', '11', '14', '15', null, '2020');
INSERT INTO `nota` VALUES ('57', '91', '51', '1', '11', '15', '14', '13', null, '2020');
INSERT INTO `nota` VALUES ('58', '90', '38', '1', '14', '10', '15', '13', null, '2020');
INSERT INTO `nota` VALUES ('59', '84', '53', '1', '20', '20', '12', '17', null, '2020');
INSERT INTO `nota` VALUES ('60', '84', '43', '1', '10', '20', '20', '17', null, '2020');
INSERT INTO `nota` VALUES ('61', '85', '43', '1', '16', '15', '14', '15', null, '2020');
INSERT INTO `nota` VALUES ('62', '85', '53', '1', '20', '20', '20', '20', null, '2020');
INSERT INTO `nota` VALUES ('63', '90', '53', '1', '3', '0', '0', '1', null, '2020');
INSERT INTO `nota` VALUES ('69', '95', '37', '1', '18', '20', '15', '18', null, '2020');
INSERT INTO `nota` VALUES ('72', '84', '37', '2', '20', '20', '20', '20', null, '2020');
INSERT INTO `nota` VALUES ('73', '90', '37', '2', '9', '11', '12', '11', null, '2020');
INSERT INTO `nota` VALUES ('75', '84', '37', '3', '14', '11', '18', '14', null, '2020');
INSERT INTO `nota` VALUES ('76', '85', '37', '2', '20', '18', '17', '18', null, '2020');
INSERT INTO `nota` VALUES ('77', '85', '37', '3', '17', '12', '20', '16', null, '2020');
INSERT INTO `nota` VALUES ('78', '97', '37', '3', '0', '14', '13', '9', null, '2020');
INSERT INTO `nota` VALUES ('79', '84', '51', '3', '15', '14', '10', '13', null, '2020');
INSERT INTO `nota` VALUES ('80', '85', '51', '1', '10', '10', '10', '10', null, '2020');
INSERT INTO `nota` VALUES ('82', '96', '37', '1', '19', '19', '15', '18', null, '2020');
INSERT INTO `nota` VALUES ('86', '92', '44', '15', '14', '14', '13', '14', null, '2021');
INSERT INTO `nota` VALUES ('87', '93', '44', '15', '16', '20', '15', '17', null, '2021');
INSERT INTO `nota` VALUES ('88', '93', '44', '17', '14', '15', '20', '16', null, '2021');
INSERT INTO `nota` VALUES ('89', '93', '44', '16', '8', '7', '10', '8', null, '2021');
INSERT INTO `nota` VALUES ('90', '105', '45', '15', '13', '13', '8', '11', null, '2021');
INSERT INTO `nota` VALUES ('91', '105', '45', '1', '0', '0', '0', '0', null, '2020');

-- ----------------------------
-- Table structure for seccion
-- ----------------------------
DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL AUTO_INCREMENT,
  `seccion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seccion
-- ----------------------------
INSERT INTO `seccion` VALUES ('1', 'A');
INSERT INTO `seccion` VALUES ('2', 'B');
INSERT INTO `seccion` VALUES ('3', 'C');
INSERT INTO `seccion` VALUES ('4', 'D');
INSERT INTO `seccion` VALUES ('5', 'E');
INSERT INTO `seccion` VALUES ('6', 'F');
INSERT INTO `seccion` VALUES ('7', 'G');

-- ----------------------------
-- Table structure for semestre
-- ----------------------------
DROP TABLE IF EXISTS `semestre`;
CREATE TABLE `semestre` (
  `id_semestre` int(11) NOT NULL AUTO_INCREMENT,
  `semestre` varchar(255) NOT NULL,
  `año` varchar(50) NOT NULL,
  PRIMARY KEY (`id_semestre`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of semestre
-- ----------------------------
INSERT INTO `semestre` VALUES ('1', 'I', '2020');
INSERT INTO `semestre` VALUES ('2', 'II', '2020');
INSERT INTO `semestre` VALUES ('3', 'III', '2020');
INSERT INTO `semestre` VALUES ('15', 'I', '2021');
INSERT INTO `semestre` VALUES ('16', 'II', '2021');
INSERT INTO `semestre` VALUES ('17', 'III', '2021');

-- ----------------------------
-- Table structure for tipo_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_usuario
-- ----------------------------
INSERT INTO `tipo_usuario` VALUES ('1', 'Administrador');
INSERT INTO `tipo_usuario` VALUES ('2', 'Docente');
INSERT INTO `tipo_usuario` VALUES ('3', 'Estudiante');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grado` int(11) DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `foto` longblob DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk5` (`tipo`),
  KEY `fk6` (`grado`) USING BTREE,
  KEY `users` (`email`) USING BTREE,
  CONSTRAINT `fk14` FOREIGN KEY (`grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk5` FOREIGN KEY (`tipo`) REFERENCES `tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('28', '74433542', 'ISAI ISMAEL', 'SANDOVAL CCACCRO', 'isai.ismael1999@gmail.com', 'dd4b21e9ef71e1291183a46b913ae6f2', '1', null, null, null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('48', '77889922', 'JORGE ANDRÉ', 'TAPIA BELLEZA', 'jorge@gmail.com', 'e78caf56938df35dc210cca36f591e38', '2', '999555111', null, null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('49', '77889933', 'ANA CAROLINA', 'SALVADOR CARDENAS', 'ana@gmail.com', 'e78caf56938df35dc210cca36f591e38', '2', null, null, null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('58', '78774463', 'ARIANA VICTORIA', 'BERNARDO PACHAS', 'ariana2@gmail.com', 'e78caf56938df35dc210cca36f591e38', '2', '999999999', null, 'enace', '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('60', '78855120', 'VALENTINA', 'TORRES CRUZ', 'valentina@gmail.com', 'e78caf56938df35dc210cca36f591e38', '2', '989456120', null, 'olivos', '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('61', '78945620', 'MATHIAS MAURICIO ALEXANDER', 'SAYAN ESPINOZA', 'mathias@gmail.com', 'e78caf56938df35dc210cca36f591e38', '1', '999555000', null, 'tupac amaru', '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('62', '77002270', 'ABDUL URIEL', 'ODAR SILVA', 'abdul@gmail.com', 'e78caf56938df35dc210cca36f591e38', '1', '951357999', null, 'apurimac 155', '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('66', '74411256', 'FORTUNATO', 'OTINIANO MARTINEZ', 'fortunato@gmail.com', 'e78caf56938df35dc210cca36f591e38', '2', '987456987', null, 'enace', '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('71', '78977722', 'SAYURI ISABEL', 'ROJAS CHAJERI', 'sayuri@gmail.com', 'e78caf56938df35dc210cca36f591e38', '2', '999885522', null, 'los angeless', '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('84', '74433550', 'CLIN ROGER', 'LAPA DOMINGUEZ', 'clin@gmail.com', 'e78caf56938df35dc210cca36f591e38', '3', null, '37', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('85', '79988570', 'JHOSWELL JAZIEL', 'CHACCERE ACUÑA', 'jhoswell@gmail.com', 'e78caf56938df35dc210cca36f591e38', '3', null, '37', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('90', '74433552', 'THALIA ROSALIA', 'YARANGA ÑAHUI', 'talia@gmail.com', '58039862b980afb29cdc439a2ecb486c', '3', null, '37', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('91', '74433569', 'LISBET ARACELY', 'PARRILLA YANAYACO', 'lisbet@gmail.com', '58039862b980afb29cdc439a2ecb486c', '3', null, '37', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('92', '74433546', 'MILDRE', 'FERNANDEZ ANAYA', 'mildre@gmail.com', '58039862b980afb29cdc439a2ecb486c', '3', null, '1', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('93', '74433524', 'BRAYAN', 'AGUILAR GRANDEZ', 'brayan@gmail.com', '58039862b980afb29cdc439a2ecb486c', '3', null, '1', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('94', '74433570', 'DEYNER', 'MANCHAY LLACSAHUANGA', 'deyner@gmail.com', '58039862b980afb29cdc439a2ecb486c', '3', null, '1', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('95', '74433544', 'DENNIS ANTONY', 'BAEZ FERNANDEZ', 'dennis@gmail.com', 'e78caf56938df35dc210cca36f591e38', '3', null, '37', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('96', '79988588', 'CARMEN MARLENY', 'DE LA CRUZ GUTIERREZ', 'carmen@gmail.com', 'e78caf56938df35dc210cca36f591e38', '3', null, '37', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('97', '74433541', 'LUIS ANTONIO', 'GARCIA RIMACHI', 'luis@gmail.com', 'e78caf56938df35dc210cca36f591e38', '3', null, '37', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('98', '74433551', 'CHRISTIAN ALEX', 'ROJAS LECHE', 'cristian@gmail.com', 'e78caf56938df35dc210cca36f591e38', '3', null, '1', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('99', '74433558', 'MILAGROS', 'YANAYACO CHAMBA', 'milagros@gmail.com', 'dd4b21e9ef71e1291183a46b913ae6f2', '3', null, '16', null, '1', null, '', null, null, null);
INSERT INTO `usuario` VALUES ('105', '78945622', 'LUIS RODRIGO', 'LARICO CONDORI', 'luis2@gmail.com', 'e78caf56938df35dc210cca36f591e38', '3', null, '27', null, '1', null, '', null, null, null);
