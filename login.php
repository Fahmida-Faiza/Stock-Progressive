<?php
session_start();

// --- Database Connection Setup (MySQLi) ---
$servername= "localhost";
$username="root";
$password="";
$database="book";

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login'])){
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // --- Using MySQLi Prepared Statement for Security ---
    // 1. Prepare the statement
    // Note: We select the username and the *hashed* password column
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");

    // 2. Bind the user's input username to the placeholder
    // 's' means the parameter is a string
    $stmt->bind_param("s", $input_username);

    // 3. Execute the statement
    $stmt->execute();

    // 4. Get the result
    $result = $stmt->get_result();
    
    // 5. Fetch the user row
    $user = $result->fetch_assoc();
    
    // 6. Close the statement
    $stmt->close();
    
    // 7. Verify the user and the password
    if($user && password_verify($input_password, $user['password'])){
        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        // Login failed
        $error = "Invalid username or password!";
    }
}
// --- End of PHP Login Logic ---
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Stock Management</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-purple-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm p-6 bg-white rounded-3xl shadow-2xl">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">🔐 Login</h2>

        <?php if(isset($error)) { ?>
            <p class="text-red-600 text-center mb-4"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST" class="space-y-4">
            <div class="form-control">
                <label class="label font-medium text-gray-700">Username</label>
                <input type="text" name="username" placeholder="Enter your username" class="input input-bordered w-full" required>
            </div>

            <div class="form-control">
                <label class="label font-medium text-gray-700">Password</label>
                <input type="password" name="password" placeholder="Enter your password" class="input input-bordered w-full" required>
            </div>

            <div class="form-control mt-4">
                <button type="submit" name="login" class="btn btn-primary w-full text-white font-semibold bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-purple-500 hover:to-indigo-500 transition-all">
                    Login
                </button>
            </div>
        </form>

        <p class="text-center text-gray-500 text-sm mt-8">© <?php echo date('Y'); ?> Powered by <a href="https://bitbinaryit.com/" target="_blank"><b>BitBinary IT</b></a></p>
    </div>

</body>
</html>