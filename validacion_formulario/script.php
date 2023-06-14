<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "validacion_formulario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];

// Validar el correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido.");
}

// Validar la longitud de la contraseña
if (strlen($password) < 4 || strlen($password) > 8) {
    die("La contraseña debe tener entre 4 y 8 caracteres.");
}

// Verificar si el correo electrónico ya existe en la base de datos
$sql = "SELECT * FROM clientes WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    die("El correo electrónico ya está registrado.");
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO clientes (nombre, apellido1, apellido2, email, login, password) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password')";
if ($conn->query($sql) === TRUE) {
    echo "Registro completado con éxito";
} else {
    echo "Error al registrar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

