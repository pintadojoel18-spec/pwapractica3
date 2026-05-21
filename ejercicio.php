zz<?php
// Se crea un arreglo multidimensional que simula una base de datos de productos.
$productos = [
    [
        "id" => 1,
        "nombre" => "Auriculares Inalámbricos",
        "descripcion" => "Auriculares con cancelación de ruido.",
        "precio" => 59.99,
        "imagen" => "https://via.placeholder.com/150/0000FF/808080?text=Auriculares"
    ],
    [
        "id" => 2,
        "nombre" => "Teclado Mecánico",
        "descripcion" => "Teclado retroiluminado RGB.",
        "precio" => 89.50,
        "imagen" => "https://via.placeholder.com/150/FF0000/FFFFFF?text=Teclado"
    ],
    [
        "id" => 3,
        "nombre" => "Ratón Óptico",
        "descripcion" => "Ratón ergonómico de alta precisión.",
        "precio" => 25.00,
        "imagen" => "https://via.placeholder.com/150/008000/FFFFFF?text=Raton"
    ]
];
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tienda Virtual - Práctica 3</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f4f4f9;
            }
            
            h1,
            h2 {
                color: #333;
            }
            
            .contenedor {
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
            }
            
            .productos {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
                flex: 2;
                min-width: 300px;
            }
            
            .producto-card {
                background: #fff;
                border: 1px solid #ddd;
                padding: 15px;
                border-radius: 8px;
                width: calc(33.333% - 15px);
                min-width: 200px;
                text-align: center;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            
            .producto-card img {
                max-width: 100%;
                border-radius: 4px;
            }
            
            .precio {
                font-size: 1.2em;
                font-weight: bold;
                color: #27ae60;
            }
            
            button {
                background-color: #3498db;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                transition: background 0.3s;
            }
            
            button:hover {
                background-color: #2980b9;
            }
            
            .carrito {
                background: #fff;
                border: 1px solid #ddd;
                padding: 15px;
                border-radius: 8px;
                flex: 1;
                min-width: 250px;
                height: fit-content;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            
            #lista-carrito {
                list-style-type: none;
                padding: 0;
            }
            
            #lista-carrito li {
                border-bottom: 1px solid #eee;
                padding: 10px 0;
                display: flex;
                justify-content: space-between;
            }
        </style>
    </head>

    <body>

        <h1>Tienda Virtual</h1>

        <div class="contenedor">
            <div class="productos">
                <?php foreach ($productos as $producto): ?>
                <div class="producto-card">
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <h3>
                        <?php echo htmlspecialchars($producto['nombre']); ?>
                    </h3>
                    <p>
                        <?php echo htmlspecialchars($producto['descripcion']); ?>
                    </p>
                    <p class="precio">$
                        <?php echo number_format($producto['precio'], 2); ?>
                    </p>
                    <button onclick="agregarAlCarrito(<?php echo $producto['id']; ?>, '<?php echo addslashes($producto['nombre']); ?>', <?php echo $producto['precio']; ?>)">Agregar al carrito</button>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="carrito">
                <h2>Tu Carrito <span id="contador-carrito">(0)</span></h2>
                <ul id="lista-carrito">
                    <li>El carrito está vacío.</li>
                </ul>
                <h3>Total: $<span id="total-carrito">0.00</span></h3>
            </div>
        </div>

        <script>
            let carrito = [];
            let total = 0;

            function agregarAlCarrito(id, nombre, precio) {
                carrito.push({
                    id,
                    nombre,
                    precio
                });
                total += precio;
                actualizarCarritoUI();
            }

            function actualizarCarritoUI() {
                const listaCarrito = document.getElementById('lista-carrito');
                const contadorCarrito = document.getElementById('contador-carrito');
                const totalCarrito = document.getElementById('total-carrito');

                listaCarrito.innerHTML = '';

                if (carrito.length === 0) {
                    listaCarrito.innerHTML = '<li>El carrito está vacío.</li>';
                } else {
                    carrito.forEach((item) => {
                        const li = document.createElement('li');
                        li.innerHTML = `<span>${item.nombre}</span> <span>$${item.precio.toFixed(2)}</span>`;
                        listaCarrito.appendChild(li);
                    });
                }

                contadorCarrito.textContent = `(${carrito.length})`;
                totalCarrito.textContent = total.toFixed(2);
            }
        </script>
    </body>

    </html>