<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirige al formulario de inicio de sesión si no ha iniciado sesión
    exit();
}

// Inicializa el carrito si no existe
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Funciones para manejar el carrito
function addToCart($bookId) {
    if (isset($_SESSION['cart'][$bookId])) {
        $_SESSION['cart'][$bookId]++;
    } else {
        $_SESSION['cart'][$bookId] = 1;
    }
}

function removeFromCart($bookId) {
    if (isset($_SESSION['cart'][$bookId])) {
        $_SESSION['cart'][$bookId]--;
        if ($_SESSION['cart'][$bookId] <= 0) {
            unset($_SESSION['cart'][$bookId]);
        }
    }
}

// Manejo de las acciones del carrito
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        addToCart($_POST['book_id']);
    } elseif (isset($_POST['remove'])) {
        removeFromCart($_POST['book_id']);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería - Página Principal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1 class="my-4">Librería en Línea</h1>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Librería</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Títulos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Novedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Carrito</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container mt-4">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['user']); ?></h2>
        <h3>Carrito de Compras</h3>
        <ul class="list-group">
            <?php foreach ($_SESSION['cart'] as $bookId => $quantity) { ?>
                <li class="list-group-item">
                    Libro ID: <?php echo $bookId; ?> - Cantidad: <?php echo $quantity; ?>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                        <button type="submit" name="remove" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </li>
            <?php } ?>
            <?php if (empty($_SESSION['cart'])) { ?>
                <li class="list-group-item">El carrito está vacío.</li>
            <?php } ?>
        </ul>
        <h3>Añadir Libro al Carrito</h3>
        <form method="post">
            <div class="form-group">
                <label for="book_id">ID del Libro:</label>
                <input type="number" class="form-control" id="book_id" name="book_id" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Añadir al Carrito</button>
        </form>
    </main>
    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Librería en Línea. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
