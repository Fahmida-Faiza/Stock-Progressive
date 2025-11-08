<?php
$servername= "localhost";
$username="root";
$password="";
$database="book";

// connect a connection
$conn= mysqli_connect($servername, $username, $password,$database);
if (!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}


// ====== DELETE LOGIC ======
if(isset($_GET['delete'])){
  $sno= $_GET['delete'];
  $sql= "DELETE FROM `book_contact` WHERE `sno`= $sno";
  $result = mysqli_query($conn, $sql);
  header("Location: contact.php");
  exit();
}

// ====== EDIT MODE ======
$editMode = false;
if(isset($_GET['id'])){
    $sno = $_GET['id'];
    $sql = "SELECT * FROM book_contact WHERE sno = $sno";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
        $editMode = true;
        $companyValue = $row['company'];
        $mobileValue = $row['mobile'];
    }
}

// ====== FORM SUBMIT ======
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['snoEdit'])){
        // Update existing record
        $sno= $_POST["snoEdit"];
        $company= $_POST["companyEdit"];
        $mobile= $_POST["mobileEdit"];

        $sql ="UPDATE `book_contact` SET `company` = '$company', `mobile`= '$mobile' WHERE `book_contact`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);

        $message = $result ? "Record updated successfully!" : "Could not update: " . mysqli_error($conn);
    } else {
        // Insert new record
        $company= $_POST["company"];
        $mobile= $_POST["mobile"];
       
        $sql ="INSERT INTO `book_contact` (`company`, `mobile`) VALUES ('$company', '$mobile')";
        $result = mysqli_query($conn, $sql);

        $message = $result ? "Record inserted successfully!" : "Problem: ". mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $editMode ? "Edit Contact" : "Add Contact"; ?></title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen p-5">

<!-- Navbar -->
<div class="navbar bg-gradient-to-r from-indigo-500 to-purple-500 shadow-xl rounded-2xl mb-6 px-4 py-3">
  <div class="flex-1">
    <a href="index.php" class="btn btn-ghost normal-case text-xl text-white flex items-center gap-2">
      📱 <span>Stock Manager</span>
    </a>
  </div>
  <div class="flex-none gap-2 flex items-center">
    <button onclick="location.href='index.php'" class="btn btn-outline btn-white rounded-full hover:bg-white hover:text-indigo-600 transition">🏠 Home</button>
     <?php 
        // Check if the user is logged in using the user_id session variable
        if (isset($_SESSION['user_id'])) { 
        ?>
            <a href="logout.php" class="btn btn-error">🚪 Logout</a>
        <?php 
        } else { 
        ?>
            <a href="login.php" class="btn btn-primary">Login</a>
        <?php 
        } 
        ?>
  </div>
</div>

<!-- Form Card -->
<div class="max-w-3xl mx-auto bg-white shadow-2xl rounded-3xl p-6 md:p-10">
  <h2 class="text-2xl md:text-3xl font-bold mb-6 text-indigo-600 text-center">
    <?php echo $editMode ? "Edit Contact" : "Add Contact"; ?>
  </h2>

  <?php if(isset($message)): ?>
    <div class="alert alert-success mb-6 text-center text-green-600 font-semibold">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="" class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <?php if($editMode): ?>
      <input type="hidden" name="snoEdit" value="<?php echo $sno; ?>">
    <?php endif; ?>

    <!-- Company Name -->
    <div class="form-control w-full md:col-span-2">
      <label class="label"><span class="label-text font-semibold">Company Name</span></label>
      <select 
        name="<?php echo $editMode ? 'companyEdit' : 'company'; ?>" 
        class="select select-bordered w-full bg-white"
        required>
        <option value="">Select Company</option>
        <option value="Provential pub" <?php echo ($editMode && $companyValue == "Provential pub") ? "selected" : ""; ?>>Provential pub</option>
        <option value="Uttoron pub" <?php echo ($editMode && $companyValue == "Uttoron pub") ? "selected" : ""; ?>>Uttoron pub</option>
        <option value="Mothers pub" <?php echo ($editMode && $companyValue == "Mothers pub") ? "selected" : ""; ?>>Mothers pub</option>
        <option value="Ahsan pub" <?php echo ($editMode && $companyValue == "Ahsan pub") ? "selected" : ""; ?>>Ahsan pub</option>
        <option value="Mohanogor pub" <?php echo ($editMode && $companyValue == "Mohanogor pub") ? "selected" : ""; ?>>Mohanogor pub</option>
      </select>
    </div>

    <!-- Mobile -->
    <div class="form-control w-full md:col-span-2">
      <label class="label"><span class="label-text font-semibold">Mobile</span></label>
      <input 
        type="number" 
        name="<?php echo $editMode ? 'mobileEdit' : 'mobile'; ?>" 
        value="<?php echo $editMode ? $mobileValue : ''; ?>" 
        placeholder="Mobile" 
        class="input input-bordered w-full bg-white" required>
    </div>

    <!-- Buttons -->
    <div class="md:col-span-2 flex justify-end gap-4 mt-4">
      <button type="submit" class="btn btn-primary rounded-full px-6 py-2">Save</button>
      <button type="reset" class="btn btn-outline rounded-full px-6 py-2">Clear</button>
    </div>
  </form>
</div>

<!-- Table -->
<div class="mt-8">
  <div class="overflow-x-auto w-full shadow-lg rounded-lg border">
    <table id="myTable" class="table table-compact w-full min-w-[400px]">
      <thead class="bg-blue-100 text-black">
        <tr>
          <th>SNo</th>
          <th>Company Name</th>
          <th>Mobile</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `book_contact`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $sno++;
          echo "<tr>
            <th scope='row'>" .$sno ."</th>
            <td>" . $row['company'] . "</td>
            <td>" . $row['mobile'] . "</td>
            <td class='flex gap-2'>
              <a class='btn btn-primary btn-sm' href='contact.php?id=".$row['sno']."'>Edit</a>
              <button class='btn btn-error btn-sm delete' id='d".$row['sno']."'>Delete</button>
            </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  let table = new DataTable('#myTable');

  document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('delete')){
      let sno = e.target.id.slice(1);
      if(confirm("Are you sure you want to delete this contact?")){
        window.location = `contact.php?delete=${sno}`;
      }
    }
  });
</script>

</body>
</html>
