<?php
session_start();
include_once('includes/config.php');

// Check if user is logged in
if (strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
    exit();
} else {
    // Fetch user details from the database
    $query = "SELECT * FROM enrollment_details ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($con);
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and CSS links -->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">User Details</h1>
                    <hr />
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">User Details</li>
                    </ol>

                    <!-- User Details Display -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" value="<?php echo $user['name']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="text" class="form-control" id="dob" value="<?php echo $user['dob']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" class="form-control" id="age" value="<?php echo $user['age']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" value="<?php echo $user['address']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Profile Photo</label><br>
                                <img src="<?php echo $user['photo']; ?>" alt="Profile Photo" style="width: 150px; height: 150px;">
                            </div>
                            <button class="btn btn-primary" onclick="window.location.href='welcome.php'">Back Home</button>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
