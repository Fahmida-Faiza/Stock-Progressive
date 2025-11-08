<?php
$password_to_hash = '';

// The password_hash() function securely hashes the password.
// The PASSWORD_DEFAULT constant ensures the use of the strongest available algorithm (currently bcrypt)
// and handles salting automatically.
$hashed_password = password_hash($password_to_hash, PASSWORD_DEFAULT);

// $hashed_password is the value you store in your database column (e.g., 'password').
// It will look something like: $2y$10$tM2xK5P8rA3gGjQ7pY0eNuR.l4yIqTzC/sUvO.gXzHwE.n6D/pB
echo "The hashed password to store is: " . $hashed_password;

// You would then insert $hashed_password into your database:
// $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
// $stmt->execute([$username, $hashed_password]);
?>