<?php
session_start();
require_once '../config/Database.php';
require_once '../classes/User.php';

$db = new Database();
$conn = $db->getConnection();
$userClass = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $admin = $userClass->login($username, $password);

    if ($admin) {
        $_SESSION['admin'] = $admin;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font & CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="../src/output.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Assets/image/Fix Logo 14 busworkshop Hitam.png" sizes="100x10">
    <title>Login</title>
</head>

<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-20 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-16 w-auto" src="Assets/image/Fix Logo 14 busworkshop Hitam.png" alt="Logo" />
            <h2 class="mt-5 text-center text-2xl font-bold tracking-tight text-gray-900">
                Masuk kedalam akun anda
            </h2>
            <?php if (isset($error)): ?>
                <p class="text-red-500 text-center mt-4"><?= $error ?></p>
            <?php endif; ?>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="" method="POST">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                    <div class="mt-2">
                        <input type="text" name="username" id="username" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>