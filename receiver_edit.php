<?php
$servername= "localhost";
$username="root";
$password="";
$database="book";
// connect a connection
$conn= mysqli_connect($servername, $username, $password,$database);
if (!$conn){
  die("sorry" . mysqli_connect_error());
}

$sno = $_GET['id'];
$sql = "SELECT * FROM book_receiver WHERE sno = $sno";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Convert full datetime to YYYY-MM-DD for the date input
$dateValue = date('Y-m-d', strtotime($row['date']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.2.0/dist/full.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen p-4 md:p-8">

  <!-- Navbar -->
  <div class="navbar bg-gradient-to-r from-indigo-500 to-purple-500 shadow-xl rounded-2xl flex flex-wrap justify-between px-4 py-3 mb-6">
    <div class="flex-1">
      <a href="index.php" class="btn btn-ghost normal-case text-xl text-white flex items-center gap-2">
        📱 <span>Stock Manager</span>
      </a>
    </div>
    <div class="flex-none flex flex-col md:flex-row items-end md:items-center gap-3 md:gap-4">
      <button onclick="location.href='index.php'" class="btn btn-outline btn-white btn-sm md:btn-md rounded-full hover:bg-white hover:text-indigo-600 transition">Back</button>
    </div>
  </div>

  <!-- Edit Form Card -->
  <div class="bg-white shadow-2xl rounded-3xl p-6 md:p-10 w-full max-w-4xl mx-auto">
    <h1 class="text-2xl md:text-3xl font-bold text-indigo-600 mb-6 text-center">Edit Product</h1>

    <form method="POST" action="/Stock%20Progressive/receiver.php?" class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <input type="hidden" name="snoEdit" id="snoEdit" value="<?php echo $sno; ?>">

      <!-- Date -->
      <div class="form-control w-full">
        <label class="label"><span class="label-text font-semibold">Date</span></label>
        <input type="date" name="dateEdit" id="dateEdit" value="<?php echo $dateValue; ?>" class="input input-bordered w-full bg-white" required>
      </div>

      <!-- compny name -->
      <!-- <div class="form-control w-full">
        <label class="label"><span class="label-text font-semibold">Company</span></label>
        <input type="text" name="companyEdit" id="companyEdit" value="<?php echo $row['company']; ?>" placeholder="Comapny Name" class="input input-bordered w-full bg-white">
      </div> -->

      <div class="form-control w-full">
  <label class="label">
    <span class="label-text font-semibold">Company</span>
  </label>

  <select 
    name="companyEdit" 
    id="companyEdit" 
    class="select select-bordered w-full bg-white"
  >
      <option value="">Select Company</option>

      <option value="Provential pub" <?php echo ($row['company'] == "Provential pub") ? "selected" : ""; ?>>
        Provential pub
      </option>

      <option value="Uttoron pub" <?php echo ($row['company'] == "Uttoron pub") ? "selected" : ""; ?>>
        Uttoron pub
      </option>

      <option value="Mothers pub" <?php echo ($row['company'] == "Mothers pub") ? "selected" : ""; ?>>
        Mothers pub
      </option>

      <option value="Ahsan pub" <?php echo ($row['company'] == "Ahsan pub") ? "selected" : ""; ?>>
        Ahsan pub
      </option>

      <option value="Mohanogor pub" <?php echo ($row['company'] == "Mohanogor pub") ? "selected" : ""; ?>>
        Mohanogor pub
      </option>
  </select>
</div>
<!--  -->

     

      <!-- Buying Price -->
      <div class="form-control w-full">
        <label class="label"><span class="label-text font-semibold">Price</span></label>
        <input type="number" name="priceEdit" id="priceEdit" value="<?php echo $row['price']; ?>" placeholder="Price" class="input input-bordered w-full bg-white">
      </div>
      <!-- quantity -->
      <div class="form-control w-full">
        <label class="label"><span class="label-text font-semibold">Quantity</span></label>
        <input type="number" name="quantityEdit" id="quantityEdit" value="<?php echo $row['quantity']; ?>" placeholder="quantity" class="input input-bordered w-full bg-white">
      </div>

      <!-- Action Buttons -->
      <div class="md:col-span-2 flex justify-end gap-4 mt-4">
        <button type="submit" class="btn btn-primary rounded-full px-6 py-2">Save</button>
        <button type="reset" class="btn btn-outline rounded-full px-6 py-2">Clear</button>
      </div>

    </form>
  </div>

</body>
</html>
