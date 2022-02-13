
-- ESTA CONSULTA TRAE EL STOCK MAXIMO DE UN PRODUCTO --
SELECT nombre, MAX(stock) AS "CANTIDAD MAXIMA" FROM productos;

-- ESTA CONSULTA TRAE LA CANTIDAD MAXIMA QUE UN PRODUCTO APARECE REGISTRADO EN LAS VENTAS--
SELECT p.id as "Codigo Producto", p.nombre AS "Nombre", count(v.producto_id) AS "cantidad" FROM ventas v JOIN productos p ON v.producto_id=p.id group by v.producto_id ORDER BY cantidad DESC limit 1;

-- ESTA CONSULTA TRAE LA SUMATORIA MAXIMA DE CUANTAS UNIDADES SE HAN VENDIDO --
SELECT p.id as "Codigo Producto", p.nombre AS "Nombre", SUM(v.cantidad) AS "cantidad_vendida" FROM ventas v JOIN productos p ON v.producto_id=p.id  GROUP BY v.producto_id ORDER BY cantidad_vendida DESC LIMIT 1;