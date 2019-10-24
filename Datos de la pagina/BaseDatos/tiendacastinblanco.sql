-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2019 a las 00:34:39
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendacastinblanco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `ban_id` int(11) NOT NULL,
  `ban_nombre` varchar(45) DEFAULT NULL,
  `ban_imagen` text,
  `ban_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`ban_id`, `ban_nombre`, `ban_imagen`, `ban_estado`) VALUES
(3, 'banco provincial', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_compra`
--

CREATE TABLE `carrito_compra` (
  `car_id` int(11) NOT NULL,
  `car_cantidadproducto` int(11) DEFAULT NULL,
  `car_precioproductototal` float DEFAULT NULL,
  `com_idprincipal` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito_compra`
--

INSERT INTO `carrito_compra` (`car_id`, `car_cantidadproducto`, `car_precioproductototal`, `com_idprincipal`, `pro_id`) VALUES
(11, 35, 175000, 5, 13),
(18, 20, 100000, 10, 13),
(19, 15, 180000, 11, 17),
(20, 20, 400000, 11, 15),
(21, 15, 225000, 11, 18),
(22, 20, 240000, 12, 17),
(23, 15, 225000, 12, 18),
(24, 10, 200000, 13, 15);

--
-- Disparadores `carrito_compra`
--
DELIMITER $$
CREATE TRIGGER `actualizarproductocompra` AFTER INSERT ON `carrito_compra` FOR EACH ROW BEGIN
 UPDATE producto SET pro_cantidad = pro_cantidad - NEW.car_cantidadproducto 
 WHERE producto.pro_idproducto = NEW.pro_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `quitarproductocompra` AFTER DELETE ON `carrito_compra` FOR EACH ROW BEGIN
    UPDATE producto SET pro_cantidad = pro_cantidad + OLD.car_cantidadproducto 
    WHERE producto.pro_idproducto = OLD.pro_id;


      IF ((SELECT compra.com_cantidad - OLD.car_cantidadproducto FROM compra WHERE compra.com_id = OLD.com_idprincipal) <= 0) THEN
            DELETE FROM compra WHERE compra.com_id = OLD.com_idprincipal;
      ELSE
    	UPDATE compra SET com_precio = com_precio - OLD.car_precioproductototal, com_cantidad = com_cantidad - OLD.car_cantidadproducto WHERE compra.com_id = OLD.com_idprincipal;
      END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `com_id` int(11) NOT NULL,
  `com_precio` float DEFAULT NULL,
  `com_cantidad` int(11) DEFAULT NULL,
  `com_creado` datetime DEFAULT NULL,
  `com_actualizado` datetime DEFAULT NULL,
  `com_estado` enum('0','1','2') DEFAULT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`com_id`, `com_precio`, `com_cantidad`, `com_creado`, `com_actualizado`, `com_estado`, `usu_id`) VALUES
(5, 175000, 35, '2019-05-12 21:51:54', NULL, '1', 2),
(10, 100000, 20, '2019-05-16 22:15:25', NULL, '1', 4),
(11, 805000, 50, '2019-05-16 22:16:15', NULL, '1', 4),
(12, 465000, 35, '2019-05-18 16:09:21', NULL, '2', 2),
(13, 200000, 10, '2019-05-27 17:21:26', NULL, '1', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `com_id` int(11) NOT NULL,
  `com_tipo` varchar(45) DEFAULT NULL,
  `com_referencia` varchar(45) DEFAULT NULL,
  `com_archivo` text,
  `uba_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`com_id`, `com_tipo`, `com_referencia`, `com_archivo`, `uba_id`) VALUES
(6, NULL, '4654654', 'c429abee-1d10-462f-83ac-5dc8db5ec976/1.jpg', 3),
(7, NULL, '44234234', '5464f002-e434-446c-a12f-b0be054c3c9d/1.jpg', 3),
(8, NULL, '423423443', 'a7192116-16ab-45c3-bd2e-406a88a35c72/corte de pelo.png', 3),
(9, NULL, '23324234', 'cb0091f4-af0e-402d-859f-77c99d1c8b61/19397017_2566884363450453_4357082880042825818_n.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `men_id` int(11) NOT NULL,
  `men_asunto` text,
  `men_descripcion` text,
  `men_archivo` text,
  `men_creado` datetime DEFAULT NULL,
  `men_actualizado` datetime DEFAULT NULL,
  `men_estado` enum('0','1') DEFAULT NULL,
  `men_tipo` enum('0','1') NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`men_id`, `men_asunto`, `men_descripcion`, `men_archivo`, `men_creado`, `men_actualizado`, `men_estado`, `men_tipo`, `usu_id`) VALUES
(1, 'mensaje enviado al admin', 'fsdalkj sadflkj sdaf jlsakdf', '19d0e5e5-8edd-492e-ac83-fb68162bc93b/logo1024solo.gif', '2019-05-20 22:41:26', NULL, '1', '0', 2),
(3, 'respuesta admin', 'lkjasdf lsakdfj sadlfkj asd', 'bcac06f1-9ec4-4504-be45-e322312ad70b/1.jpg', '2019-05-20 22:48:42', NULL, '1', '1', 2),
(4, 'segunda respuesta del admin', 'lkjsadfl sakdj flsdf jlaskdfj', '21455c8c-d114-4829-b681-5e93aa428659/Firma de juan.png', '2019-05-20 22:49:36', NULL, '1', '1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `pro_idproducto` int(11) NOT NULL,
  `pro_nombre` text,
  `pro_precio` float DEFAULT NULL,
  `pro_cantidad` int(11) DEFAULT NULL,
  `pro_imagen` text NOT NULL,
  `pro_creado` datetime DEFAULT NULL,
  `pro_actualizado` datetime DEFAULT NULL,
  `tip_id` int(11) NOT NULL,
  `pro_estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`pro_idproducto`, `pro_nombre`, `pro_precio`, `pro_cantidad`, `pro_imagen`, `pro_creado`, `pro_actualizado`, `tip_id`, `pro_estado`) VALUES
(13, 'Leche', 5000, 30, '4780d955-aae1-4f51-949a-f50fe76e885f/leche.jpg', '2019-05-04 12:37:04', NULL, 8, '1'),
(14, 'Queso de Mano', 25000, 50, 'e1c23fa4-3a3e-4b74-92ff-709d8caa1527/queso de mano.jpg', '2019-05-04 12:37:40', NULL, 7, '1'),
(15, 'Queso Duro', 20000, 20, '8f6658ba-a7d5-4bb5-8f1c-8826031c1e6f/queso duro.jpg', '2019-05-04 12:40:02', '2019-05-14 23:31:33', 7, '1'),
(16, 'Queso Mozzarella', 30000, 30, 'd986cd7f-674d-4062-9cae-a62e9c2e699e/Queso mozzarella.jpg', '2019-05-04 12:41:21', NULL, 7, '0'),
(17, 'Queso Ricota', 12000, 5, 'df1b118f-a769-48f7-9fe8-58086f824265/queso-ricota.jpg', '2019-05-04 12:42:39', NULL, 7, '1'),
(18, 'Crema de Leche', 15000, 25, 'b3d171cb-c769-42b9-b510-ab515c25e990/crema de leche.jpg', '2019-05-04 12:44:23', NULL, 7, '1'),
(19, 'producto nuevo', 4566, 125, 'a28bf1f3-1954-4058-a786-5df4d0d82688/nuevo.png', '2019-05-05 17:39:21', '2019-05-14 22:56:11', 7, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `tip_id` int(11) NOT NULL,
  `tip_nombre` varchar(45) DEFAULT NULL COMMENT 'Aqui van a ir el tipo de producto, si es liquido se pone en litros y si es solido se pone en kg',
  `tip_peso` varchar(45) DEFAULT NULL COMMENT 'aqui va a ir si es en kg o lt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`tip_id`, `tip_nombre`, `tip_peso`) VALUES
(7, 'Solido', 'Kg'),
(8, 'liquido', 'Lts');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `tra_id` int(11) NOT NULL,
  `tra_creado` datetime DEFAULT NULL,
  `tra_estado` enum('0','1') DEFAULT NULL,
  `com_idcompra` int(11) NOT NULL,
  `com_idcomprobante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`tra_id`, `tra_creado`, `tra_estado`, `com_idcompra`, `com_idcomprobante`) VALUES
(6, '2019-05-16 22:16:40', '0', 11, 6),
(7, '2019-05-18 16:22:31', '0', 12, 7),
(8, '2019-05-18 16:24:48', '0', 12, 8),
(9, '2019-05-27 17:21:51', '0', 13, 9);

--
-- Disparadores `transaccion`
--
DELIMITER $$
CREATE TRIGGER `quitarcomprobantecompra` AFTER DELETE ON `transaccion` FOR EACH ROW BEGIN
    DELETE FROM comprobante WHERE comprobante.com_id = OLD.com_idcomprobante;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nombre` text,
  `usu_correo` text,
  `usu_telefono` int(11) DEFAULT NULL,
  `usu_password` text,
  `usu_olvido_password` text,
  `usu_imagen` text,
  `usu_creado` datetime DEFAULT NULL,
  `usu_actualizado` datetime DEFAULT NULL,
  `usu_estado` enum('0','1') DEFAULT NULL,
  `usu_permiso` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_correo`, `usu_telefono`, `usu_password`, `usu_olvido_password`, `usu_imagen`, `usu_creado`, `usu_actualizado`, `usu_estado`, `usu_permiso`) VALUES
(1, 'administrador', 'queseraylacteos@gmail.com', 2147483647, '$2y$12$Tu3OAC/o73OQNjR0rwkwP.E4oiF8o940DX/NW5XQizaJ0nGrDze3a', '', '17913818-51d1-49e9-8670-a55aa9dd6a26/roadmap.png', '2019-04-20 22:11:22', '2019-05-27 16:56:45', '1', '1'),
(2, 'juan david', '97juandcm11@gmail.com', 465654654, '$2y$12$0Y85QYAIRtED/COSeT4yz.CoGblXCB2rSaIk9siYjM2dVBbOBVkmy', '', '5703d585-2c29-491c-9850-dfa2bd10f4a9/Sin título.png', '2019-04-20 22:14:36', '2019-05-12 22:35:45', '1', '0'),
(3, 'asdf', 'aasdf@asdkl.co', 564546, '$2y$12$3VB1ysESQ/SIDMQdqHFQDuem8oYjU.FrM.Nu6L.7/qq2OZjXhRts2', '', '', '2019-04-20 22:16:42', NULL, '0', '0'),
(4, 'nuevo', 'correo@nuevo.com', 40934, '$2y$12$Ne4I2NUJFfOy4Jc7p4bFQuTNyWCM6QwWGahdXe5eO4Vx/jiIGvaLa', '', '5c5f9d88-b52e-4834-95cd-b695bfd4d1c9/fotoperfil.png', '2019-05-16 21:37:28', NULL, '1', '0'),
(5, 'davidc', 'uno@dos.com', 28974987, '$2y$12$MOPx5WnH4h4Qwz/Xyhabj.ZjhIEL3hUaYOUBMUw7oRej6.M1wJB1.', '', '', '2019-05-19 00:27:00', NULL, '0', '0'),
(6, 'Eduardo', 'vanjalen01@gmail.com', 2147483647, '$2y$12$nBq.q5vEFGYBfEBHpC5jt.R9xdn70LB4cg9.aCv6DZ0EzGTQ/eq3a', '', '', '2019-05-27 16:15:31', NULL, '1', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_banco`
--

CREATE TABLE `usuario_banco` (
  `uba_id` int(11) NOT NULL,
  `uba_nombre` varchar(45) DEFAULT NULL,
  `uba_cedula` int(11) DEFAULT NULL,
  `uba_cuenta` varchar(20) DEFAULT NULL,
  `uba_tipocuenta` int(11) DEFAULT NULL,
  `ban_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_banco`
--

INSERT INTO `usuario_banco` (`uba_id`, `uba_nombre`, `uba_cedula`, `uba_cuenta`, `uba_tipocuenta`, `ban_id`) VALUES
(3, 'juan', 892372, '9348430983049843', 1, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`ban_id`);

--
-- Indices de la tabla `carrito_compra`
--
ALTER TABLE `carrito_compra`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_carrito_compra_compra1_idx` (`com_idprincipal`),
  ADD KEY `fk_carrito_compra_producto1_idx` (`pro_id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `fk_compra_usuario1_idx` (`usu_id`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `fk_comprobante_usuario_banco1_idx` (`uba_id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`men_id`),
  ADD KEY `fk_mensaje_usuario_idx` (`usu_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`pro_idproducto`),
  ADD KEY `fk_producto_tipo_producto1_idx` (`tip_id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`tra_id`),
  ADD KEY `fk_transaccion_compra1_idx` (`com_idcompra`),
  ADD KEY `fk_transaccion_comprobante1_idx` (`com_idcomprobante`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`);

--
-- Indices de la tabla `usuario_banco`
--
ALTER TABLE `usuario_banco`
  ADD PRIMARY KEY (`uba_id`),
  ADD KEY `fk_usuario_banco_banco1_idx` (`ban_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `carrito_compra`
--
ALTER TABLE `carrito_compra`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `men_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `pro_idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `tra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario_banco`
--
ALTER TABLE `usuario_banco`
  MODIFY `uba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_compra`
--
ALTER TABLE `carrito_compra`
  ADD CONSTRAINT `fk_carrito_compra_compra1` FOREIGN KEY (`com_idprincipal`) REFERENCES `compra` (`com_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carrito_compra_producto1` FOREIGN KEY (`pro_id`) REFERENCES `producto` (`pro_idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD CONSTRAINT `fk_comprobante_usuario_banco1` FOREIGN KEY (`uba_id`) REFERENCES `usuario_banco` (`uba_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_usuario` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_tipo_producto1` FOREIGN KEY (`tip_id`) REFERENCES `tipo_producto` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_transaccion_compra1` FOREIGN KEY (`com_idcompra`) REFERENCES `compra` (`com_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaccion_comprobante1` FOREIGN KEY (`com_idcomprobante`) REFERENCES `comprobante` (`com_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_banco`
--
ALTER TABLE `usuario_banco`
  ADD CONSTRAINT `fk_usuario_banco_banco1` FOREIGN KEY (`ban_id`) REFERENCES `banco` (`ban_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
