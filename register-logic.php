<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'matrimony';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data and sanitize
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$required_fields = [
    'profile_created_by', 'looking_for', 'first_name', 'last_name',
    'religion', 'caste', 'dob', 'marital_status', 'education', 'profession',
    'email', 'confirm_email', 'candidate_phone', 'guardian_phone',
    'password', 'confirm_password'
];

foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        die("Error: Field '$field' is required.");
    }
}

$email = clean_input($_POST['email']);
$confirm_email = clean_input($_POST['confirm_email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

if ($email !== $confirm_email) {
    die("Email and Confirm Email do not match.");
}

if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Password hashing
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Prepare SQL query
$stmt = $conn->prepare("INSERT INTO users (
    profile_created_by, looking_for, first_name, last_name,
    religion, caste, dob, marital_status, education, profession,
    email, candidate_phone, guardian_phone, password
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssssssss",
    $_POST['profile_created_by'], $_POST['looking_for'],
    $_POST['first_name'], $_POST['last_name'],
    $_POST['religion'], $_POST['caste'], $_POST['dob'],
    $_POST['marital_status'], $_POST['education'], $_POST['profession'],
    $email, $_POST['candidate_phone'], $_POST['guardian_phone'],
    $hashed_password
);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
