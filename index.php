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
<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
<!-- Tailwind CSS & DaisyUI CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/daisyui@2.50.0/dist/full.css" rel="stylesheet">

<style>
/* CSS Grid with 3 columns */
.grid-3col {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

/* Responsive breakpoints */
@media (max-width: 1024px) {
    .grid-3col {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 640px) {
    .grid-3col {
        grid-template-columns: 1fr;
    }
}

/* Add border to cards */
.card-border {
    border: 1px solid #d1d5db; /* Tailwind gray-300 */
}
</style>
</head>
<body class="bg-white">

<!-- Header -->
<header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md py-6">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold">Company Stock Manager</h1>
    </div>
</header>

<!-- Cards Grid -->
<section class="py-12">
    <div class="container mx-auto px-4 grid-3col justify-items-center">
        <?php foreach($pages as $page): ?>
        <div class="card card-border w-96 bg-base-100 card-xl shadow-lg cursor-pointer hover:scale-105 transition-transform duration-300" onclick="location.href='<?= $page['link'] ?>'">
            <div class="card-body">
                <h2 class="card-title"><?= $page['title'] ?></h2>
                <p><?= $page['desc'] ?></p>
                <div class="justify-end card-actions mt-4">
                    <button class="btn btn-<?= $page['color'] ?> w-full">Go</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-6 mt-12">
    <div class="container mx-auto text-center">
        <p>© 2025 BitBinaryIt. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
