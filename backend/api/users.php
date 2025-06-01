<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once './db_connection.php';

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Get all users
        $sql = "SELECT id, name, email FROM users";
        $result = $conn->query($sql);
        $users = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        echo json_encode($users);
        break;

    case 'POST':
        // Create new user
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            break;
        }

        $name = $conn->real_escape_string($data['name']);
        $email = $conn->real_escape_string($data['email']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql)) {
            echo json_encode(['message' => 'User created successfully', 'id' => $conn->insert_id]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error creating user']);
        }
        break;

    case 'PUT':
        // Update user
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['id']) || !isset($data['name']) || !isset($data['email'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            break;
        }

        $id = (int)$data['id'];
        $name = $conn->real_escape_string($data['name']);
        $email = $conn->real_escape_string($data['email']);

        $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";

        if ($conn->query($sql)) {
            echo json_encode(['message' => 'User updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error updating user']);
        }
        break;

    case 'DELETE':
        // Delete user
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id === 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid user ID']);
            break;
        }

        $sql = "DELETE FROM users WHERE id = $id";

        if ($conn->query($sql)) {
            echo json_encode(['message' => 'User deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error deleting user']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}

$conn->close();
?>
