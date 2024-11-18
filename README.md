Frontend basico
Hice un frontend basico que lista todos los productos, pudiendo filtrar, ordenar.
URL de Ejemplo:
Tpe-web-p3/api/products

Endpoints:
Productos
GET Tpe-web-p3/api/products
Devuelve todos los productos disponibles en la base de datos, permitiendo opcionalmente aplicar filtrado y ordenamiento a los resultados.

Descripción: Esta endpoint permite a los usuarios recuperar una lista de productos disponibles, con opciones para filtrar y ordenar los resultados por diferentes campos.

Query Params:

Ordenamiento:

orderBy: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:

Nombre: Ordena los productos por nombre.
categoria: Ordena los productos por categoría.
cantidad: Ordena los productos por cantidad.
talle: Ordena los productos por talle.
valor: Ordena los productos por valor.
direccion: Dirección de orden para el campo especificado en orderBy:

USUARIO:
obtener token de autenticacion:
GET/ usuario/token
inciar sesion: email: webadmin@gmail.com contraseña: admin
genera un token jwt para autenticar. Formato base69(usuario:contraseña)

ASC: Orden ascendente (por defecto).
DESC: Orden descendente.
Ejemplo de Ordenamiento: Para obtener todos los productos ordenados por precio en orden descendente:

GET Tpe-web-p3/api/products?orderBy=valor&direccion=DESC

Filtrado:

filtro: Campo por el que se desea filtrar los resultados. Los campos válidos pueden incluir:
Nombre: Filtra los productos por nombre del producto.
id proveedor: Filtra los productos por el proveedor.
categoria: Filtra los productos por categoría.
cantidad: Filtra los productos por cantidad.
talle: Filtra los productos por talle.
valor: Valor que se utilizará para el filtrado. Debe ser el valor específico que se comparará con el campo filtrado.
Ejemplo de Filtrado: Para obtener todos los productos que contengan en el campo 'valor' un texto '3000':

GET Tpe-web-p3/api/products?filtro=valor&valor=3000

Campos requeridos:
nombre del producto
id_proveedor_fk
categoria
cantidad
talle
valor
Ejemplo de JSON a insertar:
json
Copiar código
{
  "Nombre_producto": "camisa de lino",
  "id_proveedor_fk": "18",
  "categoria": "hombres",
  "cantidad": "5",
  "talle": "L",
  "valor": "20000"
}
PUT /api/products/
Modifica el producto correspondiente al ID solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

Campos modificables:

Nombre_producto
id_proveedor_fk
categoria
cantidad
talle
valor
DELETE /api/products/
Elimina el producto correspondiente al ID solicitado.
