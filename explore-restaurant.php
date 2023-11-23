<?php include('partials-front\menu.php');
?>

<?php
if (isset($_GET["restaurant_id"])) {
  //GET the restaurant id and details of the selected restaurant.
  $restaurant_id = $_GET['restaurant_id'];
  //GET THE DETAILS IN THE SELECTED FOOD.
  $sql = "SELECT * FROM tbl_add_restaurant WHERE id=$restaurant_id";

  //Execute the query.
  $res = mysqli_query($conn, $sql);

  //count the rows.
  $count = mysqli_num_rows($res);

  //check if the data is available

  if ($count == 1) {
    $row = mysqli_fetch_assoc($res);
    $title = $row['title'];
    $description = $row['description'];
    $price = $row['price'];

    $image1 = $row['image1'];
    $image2 = $row['image2'];
    $image3 = $row['image3'];
    $image4 = $row['image4'];
    $image5 = $row['image5'];
  } else {
    //restaurant is not selected ,redirect to the home page.
    header('location: ' . SITEURL);

    exit; //Add an execute to stop the future exection.

  }
} else {
  //Redirect to the message if 'restaurant_id' is not set
  header('location: ' . SITEURL);
  exit; //add an exit to the future exection
}

?>

<div class="container">

  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner slider">
      <div class="carousel-item active images">
        <?php
        if (!empty($image1)) {
        ?>
          <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image1; ?>" class="d-block w-100" alt="...">
        <?php
        } else {
          echo "No Image Found";
        }
        ?>

      </div>
      <div class="carousel-item images">
        <?php
        if (!empty($image2)) {
        ?>
          <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image2; ?>" class="d-block w-100" alt="...">
        <?php
        } else {
          echo "No Image Found";
        }
        ?>
      </div>
      <div class="carousel-item images">
        <?php
        if (!empty($image3)) {
        ?>
          <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image3; ?>" class="d-block w-100" alt="...">
        <?php
        } else {
          echo "No Image Found";
        }
        ?>
      </div>

      <div class="carousel-item images">
        <?php
        if (!empty($image4)) {
        ?>
          <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image4; ?>" class="d-block w-100" alt="...">
        <?php
        } else {
          echo "No Image Found";
        }
        ?>
      </div>

      <div class="carousel-item images">
        <?php
        if (!empty($image5)) {
        ?>
          <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image5; ?>" class="d-block w-100" alt="...">
        <?php
        } else {
          echo "No Image Found";
        }
        ?>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div class="clearfix"></div>
</div>

<div class="container">
  <div class="grid">
    <div class="item">
      <h1><?php echo $title; ?></h1>
      <br>
    </div>

    <div class="item">

      <!-- <div class="menu_icon" >

        <i class="fa-solid fa-star fa-1x" style="color: darkgoldenrod;"></i>
        <i class="fa-solid fa-star fa-1.5x" style="color: darkgoldenrod;"></i>
        <i class="fa-solid fa-star fa-1.5x" style="color: darkgoldenrod;"></i>
        <i class="fa-solid fa-star fa-1.5x" style="color: darkgoldenrod;"></i>
        <i class="fa-solid fa-star-half-stroke fa-1.5x" style="color: darkgoldenrod;"></i>
      </div> -->
      <!-- <h5 style="display: contents;">Dining Reviews</h5> -->
    </div>
    <div class="item">
      <article><?php echo $description; ?></article>
      <br>
    </div>

    <div class="item">
      <div class="menu_icon">


      </div>
    </div>

    <div class="item">₹ <?php echo $price; ?>
      <br>
    </div>

    <div class="item"></div>

    <div class="item">
    </div>

    <div class="item">

    </div>

    <div class="item">
      <p>

        <button class=" btn-primary menu_btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="width: 10%;"><a href="<?php echo SITEURL; ?>restaurant_id=<?php echo $restaurant_id; ?>"> </a>Photos</button>



        <button class="btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample" style="width: 10%;"><a href="<?php echo SITEURL; ?>restaurant_id=<?php echo $restaurant_id; ?>"></a>
          menu
        </button>
      </p>
    </div>
    <div class="item"></div>

  </div>
</div>
<!-- photos -->

<?php
// Initialize variables with default values.
$restaurant_id = "";
$res5 = null;
$res2 = null; // Initialize $res2

// Check whether 'restaurant_id' is set in the URL.
if (isset($_GET['restaurant_id'])) {
  $restaurant_id = $_GET['restaurant_id'];

  // Query to fetch restaurant data based on the restaurant_id.
  $sql4 = "SELECT * FROM tbl_add_restaurant WHERE id = $restaurant_id";

  $res4 = mysqli_query($conn, $sql4);

  if ($res4) {
    $row1 = mysqli_fetch_assoc($res4);
    $restaurant = $row1['title'];
  }

  // Query to fetch restaurant images based on the selected restaurant_id.
  $sql6 = "SELECT * FROM tbl_restaurant_img WHERE restaurant_id = $restaurant_id";
  $res6 = mysqli_query($conn, $sql6);

  $sql2 = "SELECT id, image_name FROM tbl_menu WHERE restaurant_id = $restaurant_id";
  $res2 = mysqli_query($conn, $sql2); // Initialize $res2


}
?>


<div class="container">
  <div class="collapse" id="collapseExample">
    <div class="card card-body row g-4">
      <h1 style="text-align: center;"><u>Photos</u></h1>

      <div class="full-img" id="fullimgbox">
        <img src="" alt="" id="fullimg" style="height: 80%;width: 70%;">

        <span onclick="closeFullImg()">X</span>

      </div>

      <div class="imgA-gallery">
        <?php
        if ($res6 && mysqli_num_rows($res6)) {
          while ($row6 = mysqli_fetch_assoc($res6)) {
            $id = $row6['id'];
            $image_name = $row6['image_name'];

            if ($image_name == "") {
              echo "<h2 style='color:red;'>No Image Available.</h2>";
            } else {
        ?>
              <img src="<?php echo SITEURL; ?>restaurant-img\restaurant_img/<?php echo $image_name; ?>" alt="image" onclick="openFullImg(this.src)">
        <?php
            }
          }
        }
        ?>
      </div>

    </div>
  </div>
</div>
<script>
  var fullimgbox = document.getElementById("fullimgbox");
  var fullimg = document.getElementById("fullimg");

  function openFullImg(pic) {
    fullimgbox.style.display = "flex";
    fullimg.src = pic;
  }

  function closeFullImg() {
    fullimgbox.style.display = "none";
    //   fullImg.src=pic;
  }
</script>
<!-- start php code in menu -->


<!-- end the code -->
<div class="container">
  <div class="collapse" id="collapseExample1">
    <div class="card card-body row g-4 ">
      <h1 style="text-align: center;"><u>Menu </u></h1>

      <div class="full-img" id="fullimgboxA">
        <img src="image/sandwich.jpg" alt="" id="fullimgA" style="height: 80%; width: 70%;">

        <span onclick="closeFullImgA()">X</span>
      </div>

      <div class="imgA-gallery">
        <?php
        if ($res2 && mysqli_num_rows($res2)) {
          while ($row2 = mysqli_fetch_assoc($res2)) {
            $id = $row2['id'];
            $image_name = $row2['image_name'];

            if ($image_name == "") {
              echo "<h2 style='color:red;'>No Image Available.</h2>";
            } else {
        ?>
              <img src="<?php echo SITEURL; ?>restaurant-img/restaurant_img/<?php echo $image_name; ?>" alt="image" onclick="openFullImgA(this.src)">
        <?php
            }
          }
        } 
        else {
          echo "No data found or an error occurred.";
        }
        ?>

      </div>
    </div>
  </div>
</div>

<script>
  var fullimgboxA = document.getElementById("fullimgboxA");
  var fullimgA = document.getElementById("fullimgA");

  function openFullImgA(pic) {
    fullimgboxA.style.display = "flex";
    fullimgA.src = pic;
  }

  function closeFullImgA() {
    fullimgboxA.style.display = "none";
  }
</script>




<!-- start book table body -->

<div class="container">
  <h1>Book a Table</h1>
  <hr>

  <form class="row g-4 needs-validation" style="background-color: burlywood;" novalidate>
    <div class="col-md-3">
      <label for="validationCustom01" class="form-label">Name</label>
      <input type="text" class="form-control" id="validationCustom01" value="" required>
    </div>

    <div class="col-md-3">
      <label for="validationCustom02" class="form-label">phone Number</label>

      <input type="number" class="form-control" id="validationCustom02" value="" required>
    </div>

    <div class="col-md-3">
      <label for="validationCustomUsername" class="form-label">Email</label>
      <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      </div>
    </div>

    <div class="col-md-3">
      <label for="validationCustom03" class="form-label">No of guests*</label>
      <input type="number" class="form-control" id="validationCustom01" value="" required>

    </div>

    <div class="col-md-3">
      <label for="validationCustom03" class="form-label"> Function Date*</label>
      <input type="date" class="form-control" id="validationCustom01" value="" required>

    </div>
    <div class="col-md-2">
      <label for="validationCustom04" class="form-label">Time-in</label>

      <input type="time" class="form-control" id="appt" name="time-in" min="09:00" max="18:00" required />

      </select>

    </div>
    <div class="col-md-2">
      <label for="validationCustom05" class="form-label">Time-out</label>
      <input type="time" class="form-control" id="appt" name="time-out" min="09:00" max="18:00" required />

    </div>

    <div class="col-md-2">
      <label for="validationCustom05" class="form-label">Additional requests</label>
      <textarea name="" id="" cols="35" rows="1"></textarea>

    </div>

    <div class="col-12">
      <button class="btn btn-primary" type="submit">Submit form</button>
    </div>
  </form>
</div>


<div class="container">



</div>


<?php include('partials-front\footer.php'); ?>