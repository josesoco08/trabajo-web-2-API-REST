<?php
require_once 'config.php';

class Model {
    protected $db;

    function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function deploy() {
        
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
            $pass= '$2y$10$i96fWjKeg/YIBXjCungXRekGD2LoDjXCH6qGhTPnQtvnkd6h8L9dO';
            if (count($tables) == 0) {
                $sql =<<<END
           
                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;

                --
                -- Base de datos: `tpe_web_2`
                --

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `producto`
                --

                CREATE TABLE `producto` (
                `id_producto` int(11) NOT NULL,
                `Nombre_producto` varchar(50) NOT NULL,
                `id_proveedor_fk` int(11) NOT NULL,
                `categoria` varchar(100) NOT NULL,
                `cantidad` int(10) NOT NULL,
                `talle` varchar(10) NOT NULL,
                `valor` decimal(20,0) NOT NULL,
                `imagen` varchar(255) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                --
                -- Volcado de datos para la tabla `producto`
                --

                INSERT INTO `producto` (`id_producto`, `Nombre_producto`, `id_proveedor_fk`, `categoria`, `cantidad`, `talle`, `valor`, `imagen`) VALUES
                (49, 'remera manga larga', 13, 'Remera de hombre', 6, 'XL', 8000, 'img/245N48607_b.jpg'),
                (51, 'short lula', 16, 'shorts nueva temporada', 13, 'M', 20000, 'img/images.jpeg'),
                (52, 'campera rio', 16, 'camperas de jean', 10, 's-xll', 40000, 'img/images (1).jpeg'),
                (56, 'short lula', 16, 'eee', 1, 'l', 0, NULL),
                (57, 'short ', 13, 'sgh', 1, 'XL', 0, NULL),
                (58, 'short nuevo', 16, 'shorts verano', 10, 'M', 15000, NULL);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `proveedor`
                --

                CREATE TABLE `proveedor` (
                `id_proveedor` int(11) NOT NULL,
                `Nombre_proveedor` varchar(100) NOT NULL,
                `medio_de_pago` varchar(100) NOT NULL,
                `telefono` varchar(30) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                --
                -- Volcado de datos para la tabla `proveedor`
                --

                INSERT INTO `proveedor` (`id_proveedor`, `Nombre_proveedor`, `medio_de_pago`, `telefono`) VALUES
                (13, 'embrujo', 'efectivo', '2983341632'),
                (16, 'st. marie', 'efectivo', '2494111111');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `usuario`
                --

                CREATE TABLE `usuario` (
                `id` int(11) NOT NULL,
                `username` varchar(250) NOT NULL,
                `password` varchar(250) NOT NULL,
                `is_admin` tinyint(1) DEFAULT 0
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                --
                -- Volcado de datos para la tabla `usuario`
                --

                INSERT INTO `usuario` (`id`, `username`, `password`, `is_admin`) VALUES
                (4, 'webadmin', '$pass');

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `producto`
                --
                ALTER TABLE `producto`
                ADD PRIMARY KEY (`id_producto`),
                ADD KEY `id_proveedor_fk` (`id_proveedor_fk`);

                --
                -- Indices de la tabla `proveedor`
                --
                ALTER TABLE `proveedor`
                ADD PRIMARY KEY (`id_proveedor`);

                --
                -- Indices de la tabla `usuario`
                --
                ALTER TABLE `usuario`
                ADD PRIMARY KEY (`id`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `producto`
                --
                ALTER TABLE `producto`
                MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

                --
                -- AUTO_INCREMENT de la tabla `proveedor`
                --
                ALTER TABLE `proveedor`
                MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

                --
                -- AUTO_INCREMENT de la tabla `usuario`
                --
                ALTER TABLE `usuario`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `producto`
                --
                ALTER TABLE `producto`
                ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor_fk`) REFERENCES `proveedor` (`id_proveedor`);
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

                END;
                $this->db->exec($sql);
            }
       
    }
    
    }
    

?>
