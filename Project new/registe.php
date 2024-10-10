
<?php
$host = 'localhost'; // Your database host
$db = 'records'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function registerUser($conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        $fullName = $conn->real_escape_string($_POST['fullName']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Check if passwords match
        if ($_POST['password'] !== $_POST['confirmPassword']) {
            echo "Passwords do not match!";
            return;
        }

        $sql = "INSERT INTO users (full_name, email, password) VALUES ('$fullName', '$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect to homepage after successful registration
            header("Location: dashboard.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

function loginUser($conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $email = $conn->real_escape_string($_POST['loginEmail']);
        $password = $_POST['loginPassword'];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Start session and store user info
                session_start();
                $_SESSION['user_id'] = $user['id'];
                // Redirect to homepage after successful login
                header("Location: dashboard.html");
                exit();
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with this email!";
        }
    }
}

// Call the appropriate function based on the form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        registerUser($conn);
    } elseif (isset($_POST['login'])) {
        loginUser($conn);
    }
}

$conn->close();
?>
