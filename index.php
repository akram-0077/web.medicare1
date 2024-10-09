<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Functions for database operations
function registerPatient($name, $age, $gender, $history) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO patients (name, age, gender, history) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $name, $age, $gender, $history);
    $stmt->execute();
    $stmt->close();
}

function getPatients() {
    global $conn;
    $result = $conn->query("SELECT * FROM patients");
    $patients = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $patients[] = $row;
        }
    }
    return $patients;
}

function deletePatient($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        
        if (($username == "petugas1" && $password == "password1" && $role == "petugas") ||
            ($username == "dokter1" && $password == "password2" && $role == "dokter")) {
            $_SESSION['user'] = ['username' => $username, 'role' => $role];
        } else {
            $login_error = "Invalid credentials";
        }
    } elseif (isset($_POST['register_patient'])) {
        registerPatient($_POST['patientName'], $_POST['patientAge'], $_POST['patientGender'], $_POST['patientHistory']);
    } elseif (isset($_POST['delete_patient'])) {
        deletePatient($_POST['patient_id']);
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare - Rumah Sakit Sehat Sentosa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://sticare.id/wp-content/uploads/2022/09/31.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        header {
            background-color: #ffffff;
            color: #333;
            padding: 10px 0;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }
        .contact-info {
            display: flex;
        }
        .contact-info div {
            margin-left: 20px;
        }
        nav {
            background-color: #4CAF50;
            padding: 10px;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
        }
        .hero {
            background-color: #008080;
            color: white;
            padding: 50px 0;
            text-align: left;
        }
        .hero h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .cta-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .features {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .feature-box {
            background-color: #fff;
            padding: 20px;
            width: 22%;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .login-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }
        .login-form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, button, select {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }
        #dashboardContainer {
            display: none;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">MEDICARE</div>
            <div class="contact-info">
                <div>
                    <i class="fas fa-phone"></i>
                    <span>0812345678</span>
                </div>
                <div>
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Bandar Lampung</span>
                </div>
            </div>
        </div>
    </header>

    <nav>
        <div class="container">
            <a href="?page=home">HOME</a>
            <a href="?page=doctors">DOCTORS</a>
            <a href="?page=services">SERVICES</a>
            <a href="?page=departments">DEPARTMENTS</a>
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="#" onclick="showLoginForm()" class="cta-button">Login / Appointment</a>
            <?php else: ?>
                <a href="?logout=true" class="cta-button">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <div id="mainContent" class="container">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        switch($page) {
            case 'home':
                include 'pages/home.php';
                break;
            case 'doctors':
                include 'pages/doctors.php';
                break;
            case 'services':
                include 'pages/services.php';
                break;
            case 'departments':
                include 'pages/departments.php';
                break;
            default:
                include 'pages/home.php';
        }
        ?>
    </div>

    <?php if (!isset($_SESSION['user'])): ?>
    <div id="loginContainer" class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form method="post" action="">
                <select name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="petugas">Petugas</option>
                    <option value="dokter">Dokter</option>
                </select>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
            <button onclick="hideLoginForm()">Kembali ke Beranda</button>
            <?php if (isset($login_error)): ?>
                <p style="color: red;"><?php echo $login_error; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['user'])): ?>
    <div id="dashboardContainer">
        <nav id="dashboardNav">
            <?php if ($_SESSION['user']['role'] == 'petugas'): ?>
                <a href="?page=register_patient">Daftar Pasien</a>
                <a href="?page=patient_list">Lihat Data Pasien</a>
            <?php elseif ($_SESSION['user']['role'] == 'dokter'): ?>
                <a href="?page=patient_list">Lihat Data Pasien</a>
                <a href="?page=consultation_schedule">Jadwal Konsultasi</a>
                <a href="?page=examination_results">Unggah Hasil Pemeriksaan</a>
            <?php endif; ?>
        </nav>
        <div id="dashboardContent" class="container">
            <?php
            if (isset($_GET['page'])) {
                switch($_GET['page']) {
                    case 'register_patient':
                        include 'pages/register_patient.php';
                        break;
                    case 'patient_list':
                        include 'pages/patient_list.php';
                        break;
                    case 'consultation_schedule':
                        include 'pages/consultation_schedule.php';
                        break;
                    case 'examination_results':
                        include 'pages/examination_results.php';
                        break;
                }
            }
            ?>
        </div>
    </div>
    <?php endif; ?>

    <footer>
        &copy; 2024 Medicare - Rumah Sakit Sehat Sentosa. All Rights Reserved.
    </footer>

    <script>
        function showLoginForm() {
            document.getElementById('loginContainer').style.display = 'flex';
        }

        function hideLoginForm() {
            document.getElementById('loginContainer').style.display = 'none';
        }
    </script>
</body>
</html>