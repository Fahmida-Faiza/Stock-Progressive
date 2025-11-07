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

// ====== DELETE LOGIC ======
// MUST BE BEFORE HTML OUTPUT
if(isset($_GET['delete'])){
  $sno= $_GET['delete'];
  $sql= "DELETE FROM `book_receiver` WHERE `sno`= $sno";
  $result = mysqli_query($conn, $sql);
  // Redirect without alert
  header("Location: receiver.php");
  exit();
}

// Check if edit mode
$editMode = false;
if(isset($_GET['id'])){
    $sno = $_GET['id'];
    $sql = "SELECT * FROM book_receiver WHERE sno = $sno";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
        $editMode = true;
        $dateValue = date('Y-m-d', strtotime($row['date']));
        $companyValue = $row['company'];
        $priceValue = $row['price'];
        $quantityValue = $row['quantity'];
    }
}

// Handle POST requests
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['snoEdit'])){
        // Update existing record
        $sno= $_POST["snoEdit"];
        $date= $_POST["dateEdit"];
        $company= $_POST["companyEdit"];
        $price= $_POST["priceEdit"];
        $quantity= $_POST["quantityEdit"];

        $sql ="UPDATE `book_receiver` SET `date` = '$date', `company` = '$company', `price`= '$price', `quantity`= '$quantity' WHERE `book_receiver`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);

        if($result){
            $message = "Record updated successfully!";
        } else{
            $message = "Could not update: " . mysqli_error($conn);
        }
    } else {
        // Insert new record
        $date= $_POST["date"];
        $company= $_POST["company"];
        $book= $_POST["book"];
        $mobile= $_POST["mobile"];
       
        $price= $_POST["price"];
         $quantity= $_POST["quantity"];

        $sql ="INSERT INTO `book_receiver` (`date`,`price`, `company`, `book`, `mobile`, `quantity`) VALUES ('$date', '$price', '$company', '$book', '$mobile',  '$quantity')";
        $result = mysqli_query($conn, $sql);

        if($result){
            $message = "Record inserted successfully!";
        } else{
            $message = "Problem: ". mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $editMode ? "Edit Product" : "Add Product"; ?></title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">

<!-- datatable -->
<link rel="stylesheet" href="//cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css.css">
<script src="//cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
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
    <button onclick="location.href='login.php'" class="btn btn-outline btn-white rounded-full hover:bg-white hover:text-indigo-600 transition">Login</button>
  </div>
</div>

<!-- Form Card -->
<div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-3xl p-6 md:p-10">
  <h2 class="text-2xl md:text-3xl font-bold mb-6 text-indigo-600 text-center">
    <?php echo $editMode ? "Edit Product" : "Add Product"; ?>
  </h2>

  <?php if(isset($message)): ?>
    <div class="alert alert-success mb-6">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="" class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <?php if($editMode): ?>
      <input type="hidden" name="snoEdit" value="<?php echo $sno; ?>">
    <?php endif; ?>

    <!-- Date -->
    <div class="form-control w-full">
      <label class="label"><span class="label-text font-semibold">Date</span></label>
      <input type="date" name="<?php echo $editMode ? 'dateEdit' : 'date'; ?>" 
             value="<?php echo $editMode ? $dateValue : ''; ?>" 
             class="input input-bordered w-full bg-white" required>
    </div>

    <!-- company name -->

    <!-- <div class="form-control w-full">
      <label class="label"><span class="label-text font-semibold">company name</span></label>
      <input type="text" name="<?php echo $editMode ? 'companyEdit' : 'company'; ?>" 
             value="<?php echo $editMode ? $companyValue : ''; ?>" 
             placeholder="Company Name" class="input input-bordered w-full bg-white">
    </div> -->


<div class="form-control w-full">
  <label class="label">
    <span class="label-text font-semibold">Company Name</span>
  </label>

  <select 
    name="<?php echo $editMode ? 'companyEdit' : 'company'; ?>" 
    class="select select-bordered w-full bg-white"
  >
      <option value="">Select Company</option>

      <option value="Provential pub" <?php echo ($editMode && $companyValue == "Provential pub") ? "selected" : ""; ?>>
        Provential pub
      </option>

      <option value="Uttoron pub" <?php echo ($editMode && $companyValue == "Uttoron pub") ? "selected" : ""; ?>>
        Uttoron pub
      </option>

      <option value="Mothers pub" <?php echo ($editMode && $companyValue == "Mothers pub") ? "selected" : ""; ?>>
        Mothers pub
      </option>

      <option value="Ahsan pub" <?php echo ($editMode && $companyValue == "Ahsan pub") ? "selected" : ""; ?>>
        Ahsan pub
      </option>

      <option value="Mohanogor pub" <?php echo ($editMode && $companyValue == "Mohanogor pub") ? "selected" : ""; ?>>
        Mohanogor pub
      </option>
  </select>
</div>

   


  

    <!-- Price -->
    <div class="form-control w-full">
      <label class="label"><span class="label-text font-semibold"> Price</span></label>
      <input type="number" name="<?php echo $editMode ? 'priceEdit' : 'price'; ?>" 
             value="<?php echo $editMode ? $priceValue : ''; ?>" 
             placeholder="Buying Price" class="input input-bordered w-full bg-white">
    </div>
   
    <!--  Price -->
  <!-- quantity -->

 <div class="form-control w-full">
      <label class="label"><span class="label-text font-semibold"> Quantity</span></label>
      <input type="number" name="<?php echo $editMode ? 'quantityEdit' : 'quantity'; ?>" 
             value="<?php echo $editMode ? $quantityValue : ''; ?>" 
             placeholder="Quantity" class="input input-bordered w-full bg-white">
    </div>


  <!-- quantity end -->

    <!-- Action Buttons -->
    <div class="md:col-span-2 flex justify-end gap-4 mt-4">
      <button type="submit" class="btn btn-primary rounded-full px-6 py-2">Save</button>
      <button type="reset" class="btn btn-outline rounded-full px-6 py-2">Clear</button>
    </div>

  </form>
</div>







  <!-- Responsive Product Table -->
  <div class="mt-6">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

<!-- Responsive Table Wrapper -->
<div class="overflow-x-auto w-full shadow-lg rounded-lg border">
  <table id="myTable" class="table table-compact w-full min-w-[600px]">
    <thead class="bg-blue-100 text-black">
      <tr>
        <th>SNo</th>
        <th>Date</th>
        <th>Company Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM `book_receiver`";
      $result = mysqli_query($conn, $sql);
      $sno = 0;
      while($row = mysqli_fetch_assoc($result)){
        $sno= $sno + 1;
        echo "<tr>
          <th scope='row'>" .$sno ."</th>
          <td>" . $row['date'] . "</td>    
          <td>" . $row['company'] . "</td>
          <td>" . $row['price'] . "</td>
          <td>" . $row['quantity'] . "</td>
          <td>
            <button class='btn btn-primary'><a class='edit' href='receiver_edit.php?id=".$row['sno']."'>Edit</a></button>
            <button class='btn btn-error delete' id='d".$row['sno']."'>Delete</button>
          </td>
        </tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Optional: DataTable JS initialization -->
<script>
  let table = new DataTable('#myTable');
</script>


<script>
  // Edit buttons (existing)
  let edits = document.getElementsByClassName('edit');
  Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("Edit ");
      let tr = e.target.parentNode.parentNode;
      let date = tr.getElementsByTagName("td")[0].innerText;
      let company = tr.getElementsByTagName("td")[1].innerText;
      // let model = tr.getElementsByTagName("td")[2].innerText;
      // let ram = tr.getElementsByTagName("td")[3].innerText;
      
      let price = tr.getElementsByTagName("td")[2].innerText;
      let quantity = tr.getElementsByTagName("td")[3].innerText;
      console.log(date, comapny, model, ram, ime, price, quantity);

      dateEdit.value = date;
      companyEdit.value = company;
      // modelEdit.value = model;
      // ramEdit.value = ram;
      
      priceEdit.value = price;
      quantityEdit.value = quantity;
      snoEdit.value = e.target.id;
      console.log(e.target.id);
    });
  });

  // ===== DELETE BUTTON FIX =====
  document.addEventListener('click', function(e){
      if(e.target && e.target.classList.contains('delete')){
          let sno = e.target.id.slice(1); // remove 'd' prefix
          if(confirm("Are you sure you want to delete this?")){
              window.location = `/Stock%20Progressive/receiver.php?delete=${sno}`;
          }
      }
  });
</script>

    </div>
  </div>

</body>
</html>
