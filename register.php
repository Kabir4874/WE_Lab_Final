<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <form action="register_logic.php" method="POST">
        <h3>Profile Details</h3>
        <label>Profile created by *</label>
        <select name="profile_created_by" required>
            <option value="">Select One</option>
            <option value="Self">Self</option>
            <option value="Parent">Parent</option>
        </select>

        <label>Looking For *</label>
        <select name="looking_for" required>
            <option value="">Select One</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label>First Name *</label>
        <input type="text" name="first_name" required>

        <label>Last Name *</label>
        <input type="text" name="last_name" required>

        <label>Community / Religion *</label>
        <select name="religion" required>
            <option value="">Select Religion</option>
            <option value="Hindu">Hindu</option>
            <option value="Muslim">Muslim</option>
            <option value="Christian">Christian</option>
        </select>

        <label>Caste / Social Order *</label>
        <input type="text" name="caste" required>

        <label>Date of Birth *</label>
        <input type="date" name="dob" required>

        <label>Marital Status *</label>
        <select name="marital_status" required>
            <option value="">Select Marital Status</option>
            <option value="Single">Single</option>
            <option value="Divorced">Divorced</option>
        </select>

        <label>Education *</label>
        <input type="text" name="education" required>

        <label>Profession *</label>
        <input type="text" name="profession" required>

        <h3>Account Information</h3>

        <label>Email Address *</label>
        <input type="email" name="email" required>

        <label>Confirm Email Address *</label>
        <input type="email" name="confirm_email" required>

        <label>Candidate Phone Number *</label>
        <input type="text" name="candidate_phone" required pattern="\d{10}">

        <label>Guardian Phone Number *</label>
        <input type="text" name="guardian_phone" required pattern="\d{10}">

        <label>Password *</label>
        <input type="password" name="password" required>

        <label>Confirm Password *</label>
        <input type="password" name="confirm_password" required>

        <br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
