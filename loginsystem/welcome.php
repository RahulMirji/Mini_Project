<?php
session_start();
include_once('includes/config.php');

// Check if user is logged in
if (strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
    exit();
} else {
    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle file upload for profile photo
        $photo = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $photo = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
        }

        // Handle file upload for Aadhar card
        $aadhar = '';
        if (isset($_FILES['aadhar']) && $_FILES['aadhar']['error'] == 0) {
            $aadhar = $_FILES['aadhar']['name'];
            move_uploaded_file($_FILES['aadhar']['tmp_name'], $aadhar);
        }

        // Handle file upload for 12th result sheet
        $puc_sheet = '';
        if (isset($_FILES['puc_sheet']) && $_FILES['puc_sheet']['error'] == 0) {
            $puc_sheet = $_FILES['puc_sheet']['name'];
            move_uploaded_file($_FILES['puc_sheet']['tmp_name'], $puc_sheet);
        }

        // Handle PDF upload for CET admission letter
        $cet_application = '';
        if (isset($_FILES['cet_application']) && $_FILES['cet_application']['error'] == 0) {
            $cet_application = $_FILES['cet_application']['name'];
            move_uploaded_file($_FILES['cet_application']['tmp_name'], $cet_application);
        }

        // Insert data into the database
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $dob = mysqli_real_escape_string($con, $_POST['dob']);
        $age = mysqli_real_escape_string($con, $_POST['age']);
        $address = mysqli_real_escape_string($con, $_POST['address']);

        $query = "INSERT INTO enrollment_details (name, dob, age, address, photo, aadhar, puc_sheet, cet_application) 
                  VALUES ('$name', '$dob', '$age', '$address', '$photo', '$aadhar', '$puc_sheet', '$cet_application')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo '<script>alert("Insert success"); window.location.href ="new.php";</script>';
            exit();
        } else {
            // Handle error
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and CSS links -->
</head>
<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Enrollment Form</h1>
                    <hr />
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Enrollment</li>
                    </ol>

                    <!-- Enrollment Form -->
                    <div class="row">
                        <div class="col-lg-6">
                            <form method="post" enctype="multipart/form-data">
                                <!-- Input fields for name, dob, age -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <!-- File uploads for profile photo, Aadhar card, result sheet, CET admission letter -->
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Profile Photo (JPG)</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept=".jpg" required>
                                </div>
                                <div class="mb-3">
                                    <label for="aadhar" class="form-label">Aadhar Card (PDF)</label>
                                    <input type="file" class="form-control" id="aadhar" name="aadhar" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label for="puc_sheet" class="form-label">12th Result Sheet (PDF)</label>
                                    <input type="file" class="form-control" id="puc_sheet" name="puc_sheet" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cet_application" class="form-label">CET Admission Letter (PDF)</label>
                                    <input type="file" class="form-control" id="cet_application" name="cet_application" accept=".pdf" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
