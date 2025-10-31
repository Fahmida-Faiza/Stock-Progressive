<?php
$pages = [
    ["title" => "Receive Form Dhaka", "desc" => "Record all Dhaka deliveries efficiently.", "link" => "dhaka_receive.php", "color" => "primary"],
    ["title" => "Rangpur to Dhaka", "desc" => "Track shipments from Rangpur to Dhaka.", "link" => "rangpur_dhaka.php", "color" => "secondary"],
    ["title" => "Order", "desc" => "Add or manage all book orders easily.", "link" => "order.php", "color" => "accent"],
    ["title" => "Receiver", "desc" => "Record received orders from companies.", "link" => "receiver.php", "color" => "info"],
    ["title" => "Due List", "desc" => "Check all pending payments easily.", "link" => "due_list.php", "color" => "warning"],
    ["title" => "Contact", "desc" => "Get all company contacts in one place.", "link" => "contact.php", "color" => "success"]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Company Stock Manager</title>

<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/daisyui@2.50.0/dist/full.css" rel="stylesheet">

</head>

<body class="min-h-screen bg-gradient-to-b from-slate-100 to-white">

<!-- Header -->


<!-- Navbar -->
<div class="navbar bg-white shadow-md rounded-lg container mx-auto mb-6 px-4 py-2 border border-gray-100">
    <div class="flex-1">
        <a href="index.php" class="btn btn-ghost text-xl font-semibold text-indigo-600">Stock Manager</a>
    </div>
    <div class="flex gap-2">
        <a href="index.php" class="btn btn-outline btn-primary">🏠 Home</a>
        <a href="login.php" class="btn btn-primary">Login</a>
    </div>
</div>



<header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg py-8 mb-4">
    <div class="text-center">
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-wide">📦 Company Stock Manager</h1>
        <p class="text-lg opacity-80 mt-1">Manage Books, Payments & Deliveries With Ease</p>
    </div>
</header>





<!-- Cards Section -->
<div class="container mx-auto px-4 pb-20">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach($pages as $page): ?>
        <div 
          onclick="location.href='<?= $page['link'] ?>'" 
          class="card bg-white shadow-xl border border-gray-200 hover:shadow-2xl hover:-translate-y-1 transition-all cursor-pointer rounded-2xl"
        >
            <div class="card-body">
                <h2 class="card-title text-lg font-extrabold text-slate-700"><?= $page['title'] ?></h2>
                <p class="text-sm text-gray-500"><?= $page['desc'] ?></p>
                <div class="mt-4">
                    <button class="btn btn-<?= $page['color'] ?> w-full rounded-xl">Open</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->
<footer class="bg-slate-900 text-white py-5 mt-10 text-center text-sm">
    © 2025 BitBinaryIt — All Rights Reserved
</footer>

</body>
</html>
