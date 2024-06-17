<?php
session_start();

// Connect to MySQL database
$mysqli = new mysqli("localhost", "root", "", "department");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to check if the user exists
    $stmt = $mysqli->prepare("SELECT * FROM adminlogin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User exists, store user information in session variable
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_username"] = $user["username"];

        // Redirect to dashboard page
        header("Location: index.php");
        exit();
    } else {
        // User does not exist, display error message
        $error = "Invalid username or password.";
    }
}
?>

<!-- Login form HTML -->



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
	<title>Teacher Login</title>
	<style>
    /* form {
        display: flex;
        flex-direction: column;
        align-items: center;
		justify-content: center;
    }
    
    label {
        margin-bottom: 5px;
    }
    
    input[type="text"], input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        box-sizing: border-box;
    }
    
    input[type="submit"] {
        padding: 10px;
        background-color: #000;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        box-sizing: border-box;
    }
    
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    
    .error {
        color: red;
        margin-top: 10px;
    }
	.login-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 350px;
        margin: 0 auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
    }
    
    .login-form img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 20px;
    }
    
    label {
        margin-bottom: 5px;
    }
    
    input[type="text"], input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        box-sizing: border-box;
    }
    
    input[type="submit"] {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        box-sizing: border-box;
    }
    
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    
    .error {
        color: red;
        margin-top: 10px;
    } */
    .card {
  position: absolute;
  top: 45%;
  left: 50%;
  transform: translate(-50%, -18%);
  background-color: #fff;
  padding: 30px;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  max-width: 381px;
  width: 30%;
  height:500px;
}

.profile-image {
  width: 138px;
  height: 138px;
  border-radius: 50%;
  margin: 0 auto;
  background-color: #ddd;
  background-image: url("../images/teacher-2.png");
  background-size: cover;
  background-position: center;
}

.card h2 {
  text-align: center;
  font-size: 28px;
  margin-top: 20px;
  margin-bottom: 30px;
}

.card label {
  display: block;
  text-align: center;
  font-weight: bold;
  margin-bottom: 10px;
}

.card input[type="text"],
.card input[type="password"]
 {
  width: 100%;
  padding: 16px;
  margin-bottom: 20px;
  border-radius: 6px;
  border: 1px solid #5c5c5c;
}

.card .password-container {
  position: relative;
}

.card .password-container .password-toggle {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 20px;
}

.card input[type="submit"] {
  display: block;
  margin: 0 auto;
  background-color: #050505;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  transition: background-color 0.2s ease;
  height: 71%;
  width: 100%;
  border: none;
  font-size: 21px;
  font-weight: 400;
  border-radius: 6px;
}

.card input[type="submit"]:hover {
  background-color: #828382;
}


</style>
</head>
<body style="background-image: url(../images/bkc.jpg); background-size: contain">
   <!-- header starts -->
   <header>
      <div class="logo">
        <img
          src="../images/bgc-logo.jpg"
          alt="your-image-alt"
          style="width: 120px; border-radius: 60px"
        />
      </div>
      <div class="header-text">
        <div class="line"></div>
        <div class="text">
          <p>PUNE DISTRICT EDUCATION ASSOCIATION</p>
          <p>BABURAOJI GHOLAP COLLEGE</p>
          <p>DEPARTMENT OF COMPUTER SCIENCE</p>
        </div>
      </div>
    </header>
    <!-- header Ends -->
    <!-- Navbar Stats -->
    <nav>
      <div class="navbar">
        <i class="bx bx-menu"></i>

        <div class="nav-links">
          <div class="sidebar-logo">
            <i class="bx bx-x"></i>
          </div>
          <ul class="links">
            <li><a href="../index.html">HOME</a></li>
            <li><a href="../vision.html">Vision & Mission </a></li>
            <li><a href="../CoursesOffer.html">Courses-Offer</a></li>
            <li><a href="../SkilledBased.html">Skilled-based</a></li>
            <li><a href="../HodProfile.html">Hod-Profile</a></li>
            <li><a href="admin/staff.php">Staff</a></li>
            <li><a href="#">Infrastrucure</a></li>
            <li><a href="../moodle.html">Moodle</a></li>
            <li><a href="../RDX.html">RDX</a></li>
            
            <li>
              <a href="#">More</a>
              <i class="bx bxs-chevron-down htmlcss-arrow arrow"></i>
              <ul class="htmlCss-sub-menu sub-menu">
                <li><a href="../Seesionplan.html">Session-Plans</a></li>
                <li><a href="../classtimetable.html">Class-Time-Tables</a></li>
                <li><a href="../Guestlectures.html">Guest-Lectures</a></li>

                <li class="more">
                  <span
                    ><a href="#">More</a>
                    <i class="bx bxs-chevron-right arrow more-arrow"></i>
                  </span>
                  <ul class="more-sub-menu sub-menu">
                    <li><a href="../StaffAchievment.html">Staff-Achivement</a></li>
                    <li><a href="../StudentAchiev.html">Student-Achivement</a></li>
                    <li><a href="">Computer-Society-Of-India</a></li>
                    <li><a href="../MOOC.html">Mooc-Courses</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <a href="#">E-resources</a>
              <i class="bx bxs-chevron-down htmlcss-arrow arrow"></i>
              <ul class="htmlCss-sub-menu sub-menu">
                <li><a href="../ppt.html">PPT'S</a></li>
                <li><a href="../QuestionBank.html">Question-Bank</a></li>
                <li><a href="../NPTELRes.html">NPTEL-Messege</a></li>

                <li class="more">
                  <span
                    ><a href="#">More</a>
                    <i class="bx bxs-chevron-right arrow more-arrow"></i>
                  </span>
                  <ul class="more-sub-menu sub-menu">
                    <li><a href="../WorkBooks.html">WorkBooks</a></li>
                    <li><a href="../VideoLecture.html">Video-Lecture</a></li>
                    <li><a href="../Ebook.html">E-books</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <li>
              <a href="#">LOGIN</a>
              <i class="bx bxs-chevron-down js-arrow arrow"></i>
              <ul class="js-sub-menu sub-menu">
                <li><a href="../admin/login.php">Admin Login</a></li>
                <li><a href="login.php">Teachers Login</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- <div class="search-box">
                    <i class='bx bx-search'></i>
                    <div class="input-box">
                      <input type="text" placeholder="Search...">
                    </div>
                  </div> -->
      </div>
    </nav>
   
<!-- <div class="login-form"> 
<img src="images/t1.png" alt="Profile Picture">
<form method="post">
<label for="username">Username:</label>
<input type="text" name="username" required minlength="3" maxlength="20">


<label for="password">Password:</label>
    <input type="password" name="password" required minlength="6" maxlength="20">

    <input type="submit" value="Login">
	</div>
    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
</form> -->


 <div class="card">
      <h2>Teachers Login </h2>
      <div class="profile-image"></div>
      <br /><br />

      <form method="post" >
        <input
          type="text"
          name="username"
          id="user"
          required
          placeholder="Username"
          maxlength="10"
          minlength="3"
        />
        <div class="password-container">
          <input
            type="password"
            name="password"
            id="pass"
            required
            placeholder="Password"
            maxlength="12"
            minlength="8"
          />
          <span class="password-toggle" onclick="togglePassword()"> </span>
        </div>
        <input type="submit" value="Login" />
      </form>
      <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
     


 


</body>
     <!-- footer starts -->
     <!-- <footer class="footer">
      <div class="container1">
        <div class="row">
          <div class="footer-col">
            <h4>College</h4>
            <ul>
              <strong
                ><li><a href="feedback.html">Feedback</a></li></strong
              ><br />
              <li><a href="display.php">Gallery</a></li><br>
              <li><a href="#">privacy policy</a></li>
              <li><a href="#">affiliate program</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>ContactUs</h4>
            <ul>
              <li>
                <p style="color: white">Baburaoji Gholap College</p>
                <br />
              </li>
              <li>
                <p style="color: white">Sangvi,Pune 411027,Maharashtra</p>
              </li>
              <br />
              <li><p style="color: white">020-2728 0204</p></li>
              <br />
              <li><p style="color: white">020-2728 0204</p></li>
              <br />
              <li><p style="color: white">Fax: 020-2728 1722</p></li>
              <br />
              <li><p style="color: white">bgc_sangvi@pdeapune.org</p></li>
              <br />
            </ul>
          </div>
          <div class="footer-col">
            <h4>Campus Life</h4>
            <ul>
              <li><a href="#">Anti Haressement Policy </a></li>
              <li><a href="#"> National Service Scheme </a></li>
              <li><a href="#">PLacement Information for Web </a></li>
              <li><a href="#">Protection of Backward class students </a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>follow us</h4>
            <div class="social-links">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer> -->
    <!-- footer Ends -->
</html>