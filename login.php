<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to fetch user by email
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Verify password if user exists
    if ($user && password_verify($password, $user['password'])) {
        // Login successful, set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: index.php"); // Redirect to your admin page
        exit();
    } else {
        // Login failed
        echo "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta
      http-equiv="origin-trial"
      content="Az520Inasey3TAyqLyojQa8MnmCALSEU29yQFW8dePZ7xQTvSt73pHazLFTK5f7SyLUJSo2uKLesEtEa9aUYcgMAAACPeyJvcmlnaW4iOiJodHRwczovL2dvb2dsZS5jb206NDQzIiwiZmVhdHVyZSI6IkRpc2FibGVUaGlyZFBhcnR5U3RvcmFnZVBhcnRpdGlvbmluZyIsImV4cGlyeSI6MTcyNTQwNzk5OSwiaXNTdWJkb21haW4iOnRydWUsImlzVGhpcmRQYXJ0eSI6dHJ1ZX0="
    />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>God's Plan Logistics - Admin Login</title>

    <link
      rel="shortcut icon"
      type="image/png"
      href="https://script.viserlab.com/courierlab/demo/assets/images/logo_icon/favicon.png"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://script.viserlab.com/courierlab/demo/assets/global/css/bootstrap.min.css?v=3"
    />

    <link
      rel="stylesheet"
      href="https://script.viserlab.com/courierlab/demo/assets/viseradmin/css/vendor/bootstrap-toggle.min.css"
    />
    <link
      rel="stylesheet"
      href="https://script.viserlab.com/courierlab/demo/assets/global/css/all.min.css?v=3"
    />
    <link
      rel="stylesheet"
      href="https://script.viserlab.com/courierlab/demo/assets/global/css/line-awesome.min.css"
    />

    <link
      rel="stylesheet"
      href="https://script.viserlab.com/courierlab/demo/assets/global/css/select2.min.css"
    />
    <link
      rel="stylesheet"
      href="https://script.viserlab.com/courierlab/demo/assets/viseradmin/css/app.css?v=3"
    />

    <link rel="stylesheet" href="login.css" />
  </head>
  <body data-new-gr-c-s-check-loaded="14.1185.0" data-gr-ext-installed="">
    <div
      class="login-main"
      style="
        background-image: url('https://script.viserlab.com/courierlab/demo/assets/viseradmin/images/login.jpg');
      "
    >
      <div class="container custom-container">
        <div class="row justify-content-center">
          <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-8 col-sm-11">
            <div class="login-area">
              <div class="login-wrapper">
                <div class="login-wrapper__top">
                  <h3 class="title text-white">
                    Welcome
                    <!-- Welcome to <strong>God's Plan Logistics</strong> -->
                  </h3>
                  <p class="text-white">
                    Admin Login to God's Plan Logistics Dashboard
                  </p>
                </div>
                <div class="login-wrapper__body">
                <form action="login.php" method="POST" class="cmn-form mt-30 verify-gcaptcha login-form">
    <div class="form-group">
        <label for="email" class="required">Email</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="Email" required="">
    </div>
    <div class="form-group">
        <label for="password" class="required">Password</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required="">
    </div>
    <button type="submit" class="btn cmn-btn w-100">LOGIN</button>
</form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://script.viserlab.com/courierlab/demo/assets/global/js/jquery-3.7.1.min.js"></script>
    <script src="https://script.viserlab.com/courierlab/demo/assets/global/js/bootstrap.bundle.min.js"></script>
    <script src="https://script.viserlab.com/courierlab/demo/assets/viseradmin/js/vendor/bootstrap-toggle.min.js"></script>

    <link
      href="https://script.viserlab.com/courierlab/demo/assets/global/css/iziToast.min.css"
      rel="stylesheet"
    />
    <link
      href="https://script.viserlab.com/courierlab/demo/assets/global/css/iziToast_custom.css"
      rel="stylesheet"
    />
    <script src="https://script.viserlab.com/courierlab/demo/assets/global/js/iziToast.min.js"></script>

    <script>
      "use strict";
      const colors = {
        success: "#28c76f",
        error: "#eb2222",
        warning: "#ff9f43",
        info: "#1e9ff2",
      };

      const icons = {
        success: "fas fa-check-circle",
        error: "fas fa-times-circle",
        warning: "fas fa-exclamation-triangle",
        info: "fas fa-exclamation-circle",
      };

      const notifications = [];
      const errors = [];

      const triggerToaster = (status, message) => {
        iziToast[status]({
          title: status.charAt(0).toUpperCase() + status.slice(1),
          message: message,
          position: "topRight",
          backgroundColor: "#fff",
          icon: icons[status],
          iconColor: colors[status],
          progressBarColor: colors[status],
          titleSize: "1rem",
          messageSize: "1rem",
          titleColor: "#474747",
          messageColor: "#a2a2a2",
          transitionIn: "obunceInLeft",
        });
      };

      if (notifications.length) {
        notifications.forEach((element) => {
          triggerToaster(element[0], element[1]);
        });
      }

      if (errors.length) {
        errors.forEach((error) => {
          triggerToaster("error", error);
        });
      }

      function notify(status, message) {
        if (typeof message == "string") {
          triggerToaster(status, message);
        } else {
          $.each(message, (i, val) => triggerToaster(status, val));
        }
      }
    </script>

    <script src="https://script.viserlab.com/courierlab/demo/assets/global/js/nicEdit.js"></script>

    <script src="https://script.viserlab.com/courierlab/demo/assets/global/js/select2.min.js"></script>
    <script src="https://script.viserlab.com/courierlab/demo/assets/viseradmin/js/app.js?v=3"></script>

    <script>
      "use strict";
      bkLib.onDomLoaded(function () {
        $(".nicEdit").each(function (index) {
          $(this).attr("id", "nicEditor" + index);
          new nicEditor({
            fullPanel: true,
          }).panelInstance("nicEditor" + index, {
            hasPanel: true,
          });
        });
      });

      (function ($) {
        $(document).on(
          "mouseover ",
          ".nicEdit-main,.nicEdit-panelContain",
          function () {
            $(".nicEdit-main").focus();
          }
        );

        $(".breadcrumb-nav-open").on("click", function () {
          $(this).toggleClass("active");
          $(".breadcrumb-nav").toggleClass("active");
        });

        $(".breadcrumb-nav-close").on("click", function () {
          $(".breadcrumb-nav").removeClass("active");
        });

        if ($(".topTap").length) {
          $(".breadcrumb-nav-open").removeClass("d-none");
        }

        $(".table-responsive").on(
          "click",
          'button[data-bs-toggle="dropdown"]',
          function (e) {
            const { top, left } = $(this)
              .next(".dropdown-menu")[0]
              .getBoundingClientRect();
            $(this)
              .next(".dropdown-menu")
              .css({
                position: "fixed",
                inset: "unset",
                transform: "unset",
                top: top + "px",
                left: left + "px",
              });
          }
        );
      })(jQuery);
    </script>

    <script>
      (function ($) {
        "use strict";
        $(".verify-gcaptcha").on("submit", function () {
          var response = grecaptcha.getResponse();
          if (response.length == 0) {
            document.getElementById("g-recaptcha-error").innerHTML =
              '<span class="text--danger">Captcha field is required.</span>';
            return false;
          }
          return true;
        });

        window.verifyCaptcha = () => {
          document.getElementById("g-recaptcha-error").innerHTML = "";
        };
      })(jQuery);
    </script>

    <deepl-input-controller></deepl-input-controller>
    <div
      style="
        background-color: rgb(255, 255, 255);
        border: 1px solid rgb(204, 204, 204);
        box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 3px;
        position: absolute;
        transition: visibility 0s linear 0.3s, opacity 0.3s linear 0s;
        opacity: 0;
        visibility: hidden;
        z-index: 2000000000;
        left: 0px;
        top: -10000px;
      "
    >
      <div
        style="
          width: 100%;
          height: 100%;
          position: fixed;
          top: 0px;
          left: 0px;
          z-index: 2000000000;
          background-color: rgb(255, 255, 255);
          opacity: 0.05;
        "
      ></div>
      <div
        class="g-recaptcha-bubble-arrow"
        style="
          border: 11px solid transparent;
          width: 0px;
          height: 0px;
          position: absolute;
          pointer-events: none;
          margin-top: -11px;
          z-index: 2000000000;
        "
      ></div>
      <div
        class="g-recaptcha-bubble-arrow"
        style="
          border: 10px solid transparent;
          width: 0px;
          height: 0px;
          position: absolute;
          pointer-events: none;
          margin-top: -10px;
          z-index: 2000000000;
        "
      ></div>
      <div style="z-index: 2000000000; position: relative">
        <iframe
          title="recaptcha challenge expires in two minutes"
          name="c-yo3fc6ngy3kn"
          frameborder="0"
          scrolling="no"
          sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation"
          src="https://www.google.com/recaptcha/api2/bframe?hl=en&amp;v=rKbTvxTxwcw5VqzrtN-ICwWt&amp;k=6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV"
          style="width: 100%; height: 100%"
        ></iframe>
      </div>
    </div>
  </body>
</html>
