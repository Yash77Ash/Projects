<!DOCTYPE html>
<html>
<head>
	<title>Teachers</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/style.css">
	<link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			max-width: 100%;
			margin-bottom: 20px;
			background-color: transparent;
			border-spacing: 0;
			border: none;
		}

		table thead tr th {
			font-weight: bold;
			background-color: #eee;
			color: black;
			text-align: left;
			padding: 8px;
			border: none;
		}

		table tbody tr td {
			text-align: left;
			padding: 8px;
			border: none;
			border-bottom: 1px solid #ddd;
		}

		table tbody tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		table tbody tr:last-child td {
			border-bottom: 0;
		}

		@media (max-width: 767px) {
			table {
				border: 0;
			}

			table caption {
				font-size: 1.3em;
			}

			table thead {
				border: none;
				display: none;
			}

			table tbody {
				display: block;
				width: 100%;
			}

			table tbody tr {
				display: block;
				margin-bottom: 15px;
				border: none;
			}

			table tbody tr:last-child {
				margin-bottom: 0;
			}

			table tbody tr td {
				display: block;
				text-align: right;
				font-size: 13px;
				border-bottom: 1px solid #ddd;
			}

			table tbody tr td:before {
				content: attr(data-label);
				float: left;
				font-weight: bold;
				text-transform: uppercase;
			}

			table tbody tr td:last-child {
				border-bottom: 0;
			}
		}
	</style>
</head>
<body>
	<!-- header starts -->
    <header>
      <div class="logo">
        <img
          src="images/bgc-logo.jpg"
          alt="your-image-alt"
          style="width: 120px; border-radius: 60px"
        />
      </div>
      <div class="header-text">
        <div class="line"></div>
        <div class="text">
          <p>PUNE DISTRIC EDUCATION ASSOCIATION</p>
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
            <li><a href="staff.php">Staff</a></li>
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
                <li><a href="Login.html">Admin Login</a></li>
                <li><a href="../teacher/login.php">Teachers Login</a></li>
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

	<?php
		// Establish database connection
		$conn = new mysqli("localhost", "root", "", "department");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Retrieve teacher information from database
		$sql = "SELECT * FROM teachersinfo";
		$result = $conn->query($sql);
	?>

	<table>
		<thead>
			<tr>
				<th>Teacher Photo</th>
				<th>Teacher Name</th>
				<th>Teacher Subject</th>
				<th>Teacher File</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if ($result->num_rows > 0) {
					// Output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td><img src='" . $row["teacher_photo"] . "' width='100'></td>";
						echo "<td data-label='Teacher Name'>" . $row["teacher_name"] . "</td>";
						echo "<td data-label='Teacher Subject'>" . $row["teacher_subject"] . "</td>";
						echo "<td data-label='Teacher File'><a href='" . $row["teacher_file"] . "' target='_blank'>View File</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No results found.</td></tr>";
                }
    
                // Close database connection
                $conn->close();
            ?>
        </tbody>
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
                ><li><a href="../teacher/feedback.html">Feedback</a></li></strong
              ><br />
              <li><a href="../teacher/display.php">Gallery</a></li>
              <br />
              <li><a href="../teacher/notice_view.php">Notice</a></li>
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
