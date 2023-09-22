<?php
include_once 'dbconn.php';


if (isset($_POST['loginadmin'])) {
    $admin_email = $_POST['adminEmail'];
    $admin_password = $_POST['adminPassword1'];

    // Sanitize user input
    $admin_email = filter_var($admin_email, FILTER_SANITIZE_EMAIL);
    $admin_password = htmlspecialchars($admin_password);

    $response = array(); // Initialize a response array

    // Form validation
    if (empty($admin_email) || empty($admin_password)) {
        $response = array(
            'status' => 'error',
            'message' => 'Please enter both your email and password.'
        );
    } else if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        $response = array(
            'status' => 'error',
            'message' => 'Please enter a valid email address.'
        );
    } else {
        // Attempt to retrieve the admin by email
        $admin = getAdminByEmail($admin_email);

        if ($admin && password_verify($admin_password, $admin['admin_password'])) {
            // Successful login
            $_SESSION['admin_id'] = $admin['admin_id']; // Store admin ID in session
            // You can also perform other actions like audit logs here

            $response = array(
                'status' => 'success',
                'message' => 'Login successful.'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid email or password. Please try again.'
            );
        }
    }

    // Output JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
  }



  function getAdminByEmail($admin_email) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=fitlife_db', 'root', '');

        
        $stmt = $db->prepare('SELECT * FROM tbl_admin WHERE admin_email = :email');
        $stmt->bindParam(':email', $admin_email);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $admin ? $admin : null;
    } catch (PDOException $e) {
     
        return null;
    }
}


if (isset($_POST['registeradmin'])) {
    $admin_name = $_POST['adminName'];
    $admin_email = $_POST['adminEmail'];
    $admin_password = $_POST['adminPassword'];

    // Validate the email
    if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../pages/register.php?error=invalidemail");
        exit();
    }

    // Validate the password
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $admin_password)) {
        header("Location: ../pages/register.php?error=invalidpassword");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($admin_password, PASSWORD_DEFAULT);

    // Perform the database insert
    // Update this SQL query to match your database schema
    $sql = "INSERT INTO tbl_admin (admin_name, admin_email, admin_password) 
            VALUES ('$admin_name', '$admin_email', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        header("Location: adminlogin.php");
        exit();
    } else {
        header("Location: ../pages/adminregister.php?error=databaseerror");
        exit();
    }
}


// sa cards
$sql = "SELECT COUNT(*) AS user_count FROM tbl_users"; // Replace 'tbl_users' with your actual table name

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Get the count of users
    $userCount = $row['user_count'];
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



// sa cards
$sql = "SELECT COUNT(*) AS coach_count FROM tbl_coach"; // Replace 'tbl_users' with your actual table name

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Get the count of users
    $coachCount = $row['coach_count'];
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}





















?>