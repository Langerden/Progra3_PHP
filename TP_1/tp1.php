

INSERT INTO `productos`(`codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creación`, `fecha_de_modificación`)
VALUES (77900361,'Westmacott','liquido',33, 15.87,'2/9/2021','9/26/2020'),
(77900362,'Spirit','solido',45,69.74,'9/18/2020','4/14/2020'),
(77900363,'Newgrosh','polvo',14,68.19,'11/29/2020','2/11/2021'),
(77900364,'77900364','polvo',19,53.51,'11/28/2020','4/17/2020'),
(77900365,'Hudd','solido',68,26.56,'12/19/2020','6/19/2020'),
(77900366,'Schrader','polvo',17,96.54,'8/2/2020','4/18/2020'),
(77900367,'Bachellier','solido',59,69.17,'1/30/2021','6/7/2020'),
(77900368,'Fleming','solido',38,66.77,'10/26/2020','10/3/2020'),
(77900369,'Hurry','solido',44,43.01,'7/4/2020','5/30/2020'),
(77900310,'Krauss','polvo',73,35.73,'3/3/2021','8/30/2020');

INSERT INTO `usuarios`(`nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) 
VALUES ('Esteban','Madou', 2345,'dkantor0@example.com', '1/7/2021','Quilmes'),
('German','Gerram', 1234,'ggerram1@hud.gov', '5/8/2020','Berazategui'),
('Deloris','Fosis', 5678,'bsharpe2@wisc.edu', '11/28/2020','Avellaneda'),
('Brok','Neiner', 4567,'bblazic3@desdev.cn', '12/8/2020','Quilmes'),
('Garrick','Brent', 6789,'gbrent4@theguardian.com', '12/17/2020','Moron'),
('Bili','Baus', 0123,'bhoff5@addthis.com', '11/27/2020','Moreno');

INSERT INTO `ventas`(`id_producto`,`id_usuario`, `cantidad`, `fecha_de_venta`)
VALUES (1001,101,2,'2020/7/19'),
(1008,102,3,'2020/08/16'),
(1007,102,4,'2021/01/24'),
(1006,103,5,'2021/01/14'),
(1003,104,6,'2021/03/20'),
(1005,105,7,'2021/02/22'),
(1003,104,6,'2020/12/02'),
(1003,106,6,'2020/06/10'),
(1002,106,6,'2021/02/04'),
(1001,106,1,'2020/05/17');


-- 3.- Realizar las siguientes consultas.
-- 1. Obtener los detalles completos de todos los usuarios, ordenados alfabéticamente.
SELECT * FROM usuarios ORDER BY nombre;
-- 2. Obtener los detalles completos de todos los productos líquidos.
SELECT * FROM productos WHERE tipo = 'liquido';
-- 3. Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.
SELECT * FROM ventas WHERE cantidad >= 6 AND cantidad <= 10;
-- 4. Obtener la cantidad total de todos los productos vendidos.
SELECT SUM(cantidad) FROM ventas;
-- 5. Mostrar los primeros 3 números de productos que se han enviado.
SELECT * FROM productos ORDER BY productos.fecha_de_modificación LIMIT 3;
-- 6. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
SELECT usuarios.nombre, productos.nombre FROM usuarios, ventas, productos WHERE usuarios.id = ventas.id_usuario AND productos.id = ventas.id_producto;
-- 7. Indicar el monto (cantidad * precio) por cada una de las ventas.
SELECT usuarios.nombre, ventas.cantidad, productos.precio, ventas.cantidad * productos.precio AS total FROM usuarios, ventas, productos 
WHERE usuarios.id = ventas.id_usuario AND productos.id = ventas.id_producto;
-- 8. Obtener la cantidad total del producto 1003 vendido por el usuario 104.
SELECT SUM(cantidad) FROM ventas WHERE ventas.id_usuario = 104 AND ventas.id_producto = 1003;
-- 9. Obtener todos los números de los productos vendidos por algún usuario de ‘Avellaneda’.
SELECT ventas.id_producto FROM ventas, usuarios WHERE usuarios.localidad = 'Avellaneda' AND usuarios.id = ventas.id_usuario;
-- 10.Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’.
SELECT * FROM usuarios WHERE nombre LIKE '%u%';
-- 11. Traer las ventas entre junio del 2020 y febrero 2021.
SELECT * FROM ventas WHERE ventas.fecha_de_venta BETWEEN '2020-06-01' AND '2021-02-01';
-- 12. Obtener los usuarios registrados antes del 2021.
SELECT * FROM usuarios WHERE usuarios.fecha_de_registro < '2021-01-01';
-- 13.Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35.
INSERT INTO `productos`(`codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creación`, `fecha_de_modificación`)
VALUES (77900311,'Chocolate', 'solido', 10, 25.35, '09/10/2020', '09/10/2021');
-- 14.Insertar un nuevo usuario .
INSERT INTO `usuarios`(`nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`)
VALUES ('Denise','Langer', 5296,'langer@utn.com', '09/20/2021','Boedo');
-- 15.Cambiar los precios de los productos de tipo sólido a 66,60.
UPDATE `productos` SET `precio`=66.60 WHERE `tipo`='solido';
-- 16.Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores a 20 inclusive.
UPDATE productos SET stock = 0 WHERE stock <= 20;
-- 17.Eliminar el producto número 1010.
DELETE FROM `productos` WHERE productos.id = 1010;
-- 18.Eliminar a todos los usuarios que no han vendido productos.
DELETE FROM usuarios WHERE usuarios.id NOT IN (SELECT ventas.id_usuario FROM ventas);

-- Denise Langer
