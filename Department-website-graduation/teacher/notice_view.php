<!DOCTYPE html>
<html>
<head>
  <title>Uploaded Files</title> <br> </hr>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      text-align: left;
      padding: 8px;
    }
    th {
      background-color: #f2f2f2;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
  <link rel="stylesheet" href="../css/style.css">
  <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body>
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
            <li><a href="index.html">HOME</a></li>
            <li><a href="vision.html">Vision & Mission </a></li>
            <li><a href="CoursesOffer.html">Courses-Offer</a></li>
            <li><a href="SkilledBased.html">Skilled-based</a></li>
            <li><a href="HodProfile.html">Hod-Profile</a></li>
            <li><a href="staff.html">Staff</a></li>
            <li><a href="#">Infrastrucure</a></li>
            <li><a href="moodle.html">Moodle</a></li>
            <li><a href="RDX.html">RDX</a></li>
            <li>
              <a href="#">More</a>
              <i class="bx bxs-chevron-down htmlcss-arrow arrow"></i>
              <ul class="htmlCss-sub-menu sub-menu">
                <li><a href="Seesionplan.html">Session-Plans</a></li>
                <li><a href="classtimetable.html">Class-Time-Tables</a></li>
                <li><a href="Guestlectures.html">Guest-Lectures</a></li>

                <li class="more">
                  <span
                    ><a href="#">More</a>
                    <i class="bx bxs-chevron-right arrow more-arrow"></i>
                  </span>
                  <ul class="more-sub-menu sub-menu">
                    <li><a href="StaffAchievment.html">Staff-Achivement</a></li>
                    <li><a href="StudentAchiev.html">Student-Achivement</a></li>
                    <li><a href="CSI.html">Computer-Society-Of-India</a></li>
                    <li><a href="MOOC.html">Mooc-Courses</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <a href="#">E-resources</a>
              <i class="bx bxs-chevron-down htmlcss-arrow arrow"></i>
              <ul class="htmlCss-sub-menu sub-menu">
                <li><a href="ppt.html">PPT'S</a></li>
                <li><a href="QuestionBank.html">Question-Bank</a></li>
                <li><a href="NPTELRes.html">NPTEL-Messege</a></li>

                <li class="more">
                  <span
                    ><a href="#">More</a>
                    <i class="bx bxs-chevron-right arrow more-arrow"></i>
                  </span>
                  <ul class="more-sub-menu sub-menu">
                    <li><a href="WorkBooks.html">WorkBooks</a></li>
                    <li><a href="VideoLecture.html">Video-Lecture</a></li>
                    <li><a href="Ebook.html">E-books</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <li>
              <a href="#">LOGIN</a>
              <i class="bx bxs-chevron-down js-arrow arrow"></i>
              <ul class="js-sub-menu sub-menu">
                <li><a href="admin/login.php">Admin Login</a></li>
                <li><a href="teacher/login.php">Teachers Login</a></li>
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
    <div
      class="wrapper"
      style="
        max-width: 1400px;
        padding: 40px;
        margin: 20px auto;
        box-sizing: border-box;
        box-shadow: 0px 3px 3px 1px rgba(0, 0, 0, 0.25);
        background: #fff;
      "
    >
  <h2>Notices</h2><br>
  <table>
    <tr>
      <th>File Name</th>
      <th>Preview</th>
      <th>Download</th>
    </tr>
    <?php
      // connect to the database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "department";
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // fetch files from the database
      $sql = "SELECT * FROM files";
      $result = $conn->query($sql);

      // display each file in a table row
      while($row = $result->fetch_assoc()) {
        $file_path = "Notices/" . $row["filename"];
        $file_type = strtolower(pathinfo($file_path,PATHINFO_EXTENSION));
        echo "<tr>";
        echo "<td>" . $row["filename"] . "</td>";
        echo "<td>";
        if($file_type == "jpg" || $file_type == "jpeg" || $file_type == "png" || $file_type == "gif") {
          echo "<img src='" . $file_path . "' width='100'>";
        } else if($file_type == "pdf") {
          echo "<embed src='" . $file_path . "' type='application/pdf' width='500' height='500'>";
        } else if($file_type == "mp4" || $file_type == "webm" || $file_type == "ogg") {
          echo "<video width='100' controls>";
          echo "<source src='" . $file_path . "' type='video/" . $file_type . "'>";
          echo "Your browser does not support the video tag.";
          echo "</video>";
        } else if($file_type == "mp3" || $file_type == "wav") {
          echo "<audio controls>";
          echo "<source src='" . $file_path . "' type='audio/" . $file_type . "'>";
          echo "Your browser does not support the audio tag.";
          echo "</audio>";
        } else {
          echo "Preview not available.";
        }
        echo "</td>";
        echo "<td><a href='" . $file_path . "' download>Download</a></td>";
        
        echo "</tr>";
      }

      // close the database connection
      $conn->close();
    ?>
  </table>
    </div>
    <!-- footer starts -->
    <footer class="footer">
      <div class="container1">
        <div class="row">
          <div class="footer-col">
            <h4>College</h4>
            <ul>
              <strong
                ><li><a href="feedback.html">Feedback</a></li></strong
              ><br />
              <li><a href="display.php">Gallery</a></li>
              <br />
              <li><a href="notice_view.php">Notice</a></li>
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
    </footer>
    <!-- footer Ends -->
</body>
</html>
