<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ASimpleProject - D'Game Engineers Inc.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="?sec=home">ASimpleProject</a>
            <div class="navbar-nav">
                <a class="nav-link" href="?sec=home">Home</a>
                <a class="nav-link" href="?sec=nosotros">Nosotros</a>
                <a class="nav-link" href="?sec=eventos">Eventos</a>
                <a class="nav-link" href="?sec=proveedores">Proveedores</a>
                <a class="nav-link" href="?sec=clientes">Clientes</a>
                <a class="nav-link" href="?sec=inscribete">Inscríbete</a>
                <a class="nav-link" href="?sec=productos">Productos</a>
                <a class="nav-link" href="?sec=admin">Admin</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php
        // Conexión a la base de datos MariaDB
        $conn = new mysqli("localhost", "root", "", "asimpleproject");
        if ($conn->connect_error) {
            die("<div class='alert alert-danger'>Error de conexión: " . $conn->connect_error . "</div>");
        }

        $sec = isset($_GET['sec']) ? $_GET['sec'] : 'home';

        if ($sec == 'home') {
            echo "<h1>Bienvenido a ASimpleProject</h1><p>Solución moderna para D'Game Engineers Inc.</p>";
        } 
        // CONSULTA 1: PRODUCTOS
        elseif ($sec == 'productos') {
            echo "<h2>Nuestros Productos</h2>";
            $result = $conn->query("SELECT p.nombre, p.precio, p.stock, c.nombre as categoria FROM productos p JOIN categorias c ON p.categoria_id = c.id");
            echo "<table class='table table-striped'><tr><th>Producto</th><th>Precio</th><th>Stock</th><th>Categoría</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['nombre']}</td><td>\${$row['precio']}</td><td>{$row['stock']}</td><td>{$row['categoria']}</td></tr>";
            }
            echo "</table>";
        }
        // CONSULTA 2: CLIENTES
        elseif ($sec == 'clientes') {
            echo "<h2>Clientes Registrados</h2>";
            $result = $conn->query("SELECT nombre, email FROM clientes");
            echo "<table class='table table-bordered'><tr><th>Nombre</th><th>Email</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['nombre']}</td><td>{$row['email']}</td></tr>";
            }
            echo "</table>";
        }
        // CONSULTA 3: EVENTOS
        elseif ($sec == 'eventos') {
            echo "<h2>Próximos Eventos</h2>";
            $result = $conn->query("SELECT nombre, fecha FROM eventos");
            echo "<table class='table table-hover'><tr><th>Evento</th><th>Fecha</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['nombre']}</td><td>{$row['fecha']}</td></tr>";
            }
            echo "</table>";
        } 
        // Secciones estáticas básicas para cumplir el requisito
        else {
            echo "<h2>Sección: " . ucfirst($sec) . "</h2><p>Contenido en construcción...</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
