const API_URL = 'http://localhost/Tpe-web-p3/api/product/';

async function getAllProducts(queryParams = '') {
    try {
        const response = await fetch(`${API_URL}?${queryParams}`);
        if (response.ok) {
            const products = await response.json();
            renderProducts(products);
        } else {
            console.error(`Error: ${response.status} - ${response.statusText}`);
        }
    } catch (error) {
        console.error("Error al obtener productos:", error);
    }
}

function renderProducts(products) {
    const productList = document.getElementById('product-list');
    productList.innerHTML = ''; 

    products.forEach(product => {
        const productItem = document.createElement('div');
        productItem.classList.add('product-item');
        productItem.innerHTML = `
            <p><strong>${product.Nombre_producto}</strong> - $${product.valor}</p>
            <p>Categoría: ${product.categoria}, Talle: ${product.talle}, Cantidad: ${product.cantidad}</p>
            <p>ID Proveedor: ${product.id_proveedor_fk}</p>
            <div class="actions">
                <button onclick="editProduct(${product.id_producto})">Editar</button>
                <button class="delete" onclick="deleteProduct(${product.id_producto})">Eliminar</button>
            </div>
        `;
        productList.appendChild(productItem);
    });
}

document.getElementById('formularioOrden').addEventListener('submit', function(e) {
    e.preventDefault(); 
    const orderBy = document.getElementById('orderBy').value;
    const direction = document.getElementById('direccion').value;
    
    const queryParams = `sort=${orderBy}&order=${direction}`;
    getAllProducts(queryParams);  
});

document.getElementById('formularioFiltro').addEventListener('submit', function(e) {
    e.preventDefault(); 
    const filtro = document.getElementById('filtro').value;
    const valor = document.getElementById('valor').value;
    
    const queryParams = `filtro=${filtro}&valor=${valor}`;
    getAllProducts(queryParams);  
});

getAllProducts();
