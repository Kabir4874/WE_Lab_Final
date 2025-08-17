<?php
session_start();

$host = 'localhost';
$user = 'kabir';
$pass = 'admin';
$db = 'test';
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    die("User not logged in.");
}

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $userId);
    if ($stmt->execute()) {
        session_destroy();
        header("Location: logout.php");
        exit();
    } else {
        echo "Error deleting user.";
    }
}

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("User not found.");
}

function isSelected($value, $current) {
    return $value === $current ? "selected" : "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css" />
    <script>
        function toggleEdit() {
            const form = document.querySelector('.register-form');
            const inputs = form.querySelectorAll('input, select');
            const editBtn = document.getElementById('editBtn');

            inputs.forEach(input => {
                if (input.hasAttribute('readonly')) {
                    input.removeAttribute('readonly');
                } else {
                    input.setAttribute('readonly', true);
                }

                if (input.tagName === 'SELECT') {
                    input.disabled = !input.disabled;
                }
            });

            if(editBtn.innerText === 'Edit'){
                editBtn.innerText = 'Save';
            } else {
                editBtn.innerText = 'Edit';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div>
            <img src="avatar.png" alt="User Avatar" width="200px" />
        </div>

        <div class="table-container" style="width: 100%;">
            <button id="editBtn" onclick="toggleEdit()" type="button">Edit</button>

            <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete your profile?');">
                <button type="submit" name="delete" style="color:red; background:none; border:none; cursor:pointer;">Delete</button>
            </form>

            <form action="register-logic.php" method="POST" class="register-form" style="margin-top:20px;">
                <h3>Profile Details</h3>

                <label>Profile created by *</label>
                <select name="profile_created_by" required disabled>
                    <option value="">Select One</option>
                    <option value="Self" <?= isSelected("Self", $data['profile_created_by'] ?? "") ?>>Self</option>
                    <option value="Parent" <?= isSelected("Parent", $data['profile_created_by'] ?? "") ?>>Parent</option>
                </select>

                <label>Looking For *</label>
                <select name="looking_for" required disabled>
                    <option value="">Select One</option>
                    <option value="Male" <?= isSelected("Male", $data['looking_for'] ?? "") ?>>Male</option>
                    <option value="Female" <?= isSelected("Female", $data['looking_for'] ?? "") ?>>Female</option>
                </select>

                <label>First Name *</label>
                <input type="text" name="first_name" required readonly value="<?= htmlspecialchars($data['first_name']) ?>" />

                <label>Last Name *</label>
                <input type="text" name="last_name" required readonly value="<?= htmlspecialchars($data['last_name']) ?>" />

                <label>Community / Religion *</label>
                <select name="religion" required disabled>
                    <option value="">Select Religion</option>
                    <option value="Hindu" <?= isSelected("Hindu", $data['religion'] ?? "") ?>>Hindu</option>
                    <option value="Muslim" <?= isSelected("Muslim", $data['religion'] ?? "") ?>>Muslim</option>
                    <option value="Christian" <?= isSelected("Christian", $data['religion'] ?? "") ?>>Christian</option>
                </select>

                <label>Caste / Social Order *</label>
                <input type="text" name="caste" required readonly value="<?= htmlspecialchars($data['caste']) ?>" />

                <label>Date of Birth *</label>
                <input type="date" name="dob" required readonly value="<?= htmlspecialchars($data['dob']) ?>" />

                <label>Marital Status *</label>
                <select name="marital_status" required disabled>
                    <option value="">Select Marital Status</option>
                    <option value="Single" <?= isSelected("Single", $data['marital_status'] ?? "") ?>>Single</option>
                    <option value="Divorced" <?= isSelected("Divorced", $data['marital_status'] ?? "") ?>>Divorced</option>
                </select>

                <label>Education *</label>
                <input type="text" name="education" required readonly value="<?= htmlspecialchars($data['education']) ?>" />

                <label>Profession *</label>
                <input type="text" name="profession" required readonly value="<?= htmlspecialchars($data['profession']) ?>" />

                <h3>Account Information</h3>

                <label>Email Address *</label>
                <input type="email" name="email" required readonly value="<?= htmlspecialchars($data['email']) ?>" />

                <label>Candidate Phone Number *</label>
                <input type="text" name="candidate_phone" required pattern="\d{10}" readonly value="<?= htmlspecialchars($data['candidate_phone']) ?>" />

                <label>Guardian Phone Number *</label>
                <input type="text" name="guardian_phone" required pattern="\d{10}" readonly value="<?= htmlspecialchars($data['guardian_phone']) ?>" />
            </form>
        </div>
    </div>
</body>
</html>
