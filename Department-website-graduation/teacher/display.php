<!DOCTYPE html>
<html>
  <head>
    <title>Image Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <style>
      .image-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
      }

      .image-container {
        width: calc(33.33% - 10px);
        margin-bottom: 20px;
      }

      .image-container img {
        width: 100%;
        height: auto;
        cursor: pointer;
      }

      #myModal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 20px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.9);
      }

      .modal-content {
        margin: auto;
        display: block;
        max-width: 70%;
        max-height: 100%;
      }

      #caption {
        color: #fff;
        text-align: center;
        margin-top: 20px;
      }

      .close {
        color: #fff;
        float: right;
        font-size: 28px;
        font-weight: bold;
        margin-right: 20px;
        margin-top: -10px;
        cursor: pointer;
      }
      

      @media only screen and (max-width: 767px) {
        .image-container {
          width: calc(50% - 10px);
        }
      }

      @media only screen and (max-width: 480px) {
        .image-container {
          width: calc(100% - 10px);
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
          <p>PUNE DISTRICT EDUCATION ASSOCIATION</p>
          <p>BABURAOJI GHOLAP COLLEGE</p>
          <p>DEPARTMENT OF COMPUTER SCIENCE</p>
        </div>
      </div>
    </header>
    <!-- header Ends -->
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
                    <li><a href="">Computer-Society-Of-India</a></li>
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
                <li><a href="admin/login.html">Admin Login</a></li>
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
        max-width: 1500px;
        padding: 40px;
        margin: 20px auto;
        box-sizing: border-box;
        box-shadow: 0px 3px 3px 1px rgba(0, 0, 0, 0.25);
        background: #fff;
      "
    >
    <div class="image-grid">
      <?php
        $dir = "uploads/";
        $files = scandir($dir);

        foreach ($files as $file) {
          if ($file !== "." && $file !== "..") {
            echo "<div class='image-container'>";
            echo "<img src='" . $dir . $file . "' alt='" . $file . "' onclick='openModal(this)'>";
            echo "</div>";
          }
        }
      ?>
    </div>
    

    <div id="myModal" class="modal">
      <span class="close" onclick="closeModal()">&times;</span>
      <img class="modal-content" id="modalImage">
      <div id="caption"></div>
    </div>
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
    <script>
      function openModal(image) {
        // Get the modal elements
        var modal = document.getElementById("myModal");
        var modalImage = document.getElementById("modalImage");
        var captionText = document.getElementById("caption");

        // Get the image source and alt text
        var src = image.src;
        var alt = image.alt;

        // Set the modal image source and caption text
        modalImage.src = src;
        captionText.innerHTML = alt;

        // Show the modal
        modal.style.display = "block";
      }

      function closeModal() {
        // Get the modal element
        var modal = document.getElementById("myModal");

        // Hide the modal
        modal.style.display = "none";
      }
    </script>
  </body>
</html>
