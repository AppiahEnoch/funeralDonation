<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Funeral Donations</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
    <script
      src="https://kit.fontawesome.com/c1db89cf54.js"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://code.jquery.com/jquery-3.6.1.min.js"
      integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
      integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <style>
      html,
      body {
        background-color: #b0dbee;
        height: 100%;
        width: 100%;
        margin: auto auto;
      }

      #form {
        color: white;
        background-color: #009edf;
        border-radius: 0.3rem;
        margin: auto;
        padding: 2rem 2rem;

        -webkit-box-shadow: -1px 3px 18px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: -1px 3px 18px 0px rgba(0, 0, 0, 0.75);
        box-shadow: -1px 3px 18px 0px rgba(0, 0, 0, 0.75);
      }
    </style>

    <style>
      #sp {
        margin-left: -2rem;

        cursor: pointer;
        position: relative;
        z-index: 2000;
        float: right;

        margin-top: 0.5rem;
      }
    </style>

    <script>
      var username = "";
      var password = "";
      var email="";
      $(document).ready(function () {
        $("#loading").hide();
       // $("#ae_model_forgot").modal("show");

        $("#forgot_password").click(function () {
          $("#ae_model_forgot").modal("show");
        });

        $("#ae_model_forgot").on("click", "#bt_model_send", function (e) {
          email=$("#tf_email").val();
          $("#ae_model_forgot").modal("hide");

          if(!(validateEmail(email))){

            aeTitle = "INVALID EMAIL ADDRESS";
                aeBody = "YOUR EMAIL ADDRESS IS INVALID";
                $("#aeAlertTitle").text(aeTitle);
                $("#aeAlertBody").text(aeBody);
                $("#aeAlert").modal("show");
                return

          }


          select_email();





        });

        $("#show_hide_password a").on("click", function (event) {
          event.preventDefault();
          if ($("#show_hide_password input").attr("type") == "text") {
            $("#show_hide_password input").attr("type", "password");
            $("#show_hide_password i").addClass("fa-eye-slash");
            $("#show_hide_password i").removeClass("fa-eye");
          } else if (
            $("#show_hide_password input").attr("type") == "password"
          ) {
            $("#show_hide_password input").attr("type", "text");
            $("#show_hide_password i").removeClass("fa-eye-slash");
            $("#show_hide_password i").addClass("fa-eye");
          }
        });

        $("#bt_login").click(function () {
          username = $("#tf_username").val();
          password = $("#tf_password").val();
       

          username = username.trim();
          password = password.trim();

          if (aeEmpty(username)) {
            aeTitle = "ENTER USER NAME!";
            aeBody = "PLEASE ENTER USERNAME";
            $("#aeAlertTitle").text(aeTitle);
            $("#aeAlertBody").text(aeBody);
            $("#aeAlert").modal("show");
            return;
          } else if (aeEmpty(password)) {
            aeTitle = "ENTER PASSWORD";
            aeBody = "PLEASE ENTER PASSWORD";
            $("#aeAlertTitle").text(aeTitle);
            $("#aeAlertBody").text(aeBody);
            $("#aeAlert").modal("show");
            return;
          } else {
            validateLogin();
          }
        });
      });
    </script>
  </head>
  <body>
    <div class="h-100 d-flex align-items-center justify-content-center m-1">
      <div
        class="h-100 d-flex align-items-center justify-content-center m-auto"
      >
        <form id="form">
          <div class="form-outline mb-2 text-center">
            <h3
              style="
                font-weight: bolder;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
              "
            >
              USER LOGIN
            </h3>
            <i style="font-size: 2rem" class="bi bi-lock-fill"></i>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-2">
            <input
              type="email"
              id="tf_username"
              class="form-control"
              placeholder="Username"
              style="font-weight: bold; color: black; background-color: white"
            />
          </div>

          <!-- Password input -->
          <div class="input-group mb-2" id="show_hide_password">
            <input
              class="form-control w-100"
              id="tf_password"
              type="password"
              placeholder="Password"
              style="font-weight: bold; color: black; background-color: white"
            />

            <span>
              <a id="sp" href="">
                <i
                  id="eyeID"
                  style="color: rgb(33, 3, 51)"
                  class="fa fa-eye-slash"
                  aria-hidden="true"
                ></i
              ></a>
            </span>
          </div>

          <div class="form-outline mb-2">
            <button
              id="bt_login"
              style="font-weight: bold"
              class="btn-primary w-100"
              type="button"
            >
              Login <i id="loading" class="fa fa-spinner fa-spin fa-fw"></i>
            </button>
          </div>

          <!-- 2 column grid layout for inline styling -->
          <div class="row mb-4">
            <div class="col d-flex justify-content-start">
              <!-- Checkbox -->
              <div class="form-check justify-content-lg-start">
                <a
                  id="forgot_password"
                  style="font-weight: bold; color: white"
                  href="#"
                  >Forgot Password</a
                >
                <br />
                <a
                  style="font-weight: bold; color: white"
                  href="user_signup.html"
                  >New User?</a
                >
                <br />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal HTML -->
    <div id="aeAlert" class="modal fade" tabindex="-3">
      <div class="modal-dialog" style="width: 20rem">
        <div class="modal-content">
          <div
            style="background-color: blue; color: white"
            class="modal-header"
          >
            <h5 id="aeAlertTitle" class="modal-title">*****</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div style="background-color: white; color: black" class="modal-body">
            <h6 id="aeAlertBody">**********</h6>
          </div>
        </div>
      </div>
    </div>

    <!-- END MODAL -->

    <!-- BEGIN AEMODEL-->
    <div id="aeMdSuccess" class="modal" tabindex="-1">
      <div
        style="max-width: 20rem; background-color: gray"
        class="modal-dialog"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="aeMTitle" class="modal-title"><strong>SUCCESS!</strong></h5>
          </div>
          <div class="modal-body">
            <p id="aeMBody">Action Performed successfully.</p>
          </div>
          <div class="modal-footer">
            <button
              id="btClose"
              type="button"
              class="btn btn-primary"
              data-bs-dismiss="modal"
            >
              Ok
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- END AEMODEL-->

    <!-- Modal HTML -->
    <div id="ae_model_forgot" class="modal fade" tabindex="-3">
      <div class="modal-dialog" style="width: 20rem">
        <div class="modal-content">
          <div style="background-color: aqua" class="modal-header">
            <h5 class="modal-title">Password Recovery</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <label for="tf_email">Enter Email</label>
            <input id="tf_email" type="text" placeholder="Enter Email" />
          </div>
          <div style="background-color: aqua" class="modal-footer">
            <button id="bt_model_send" type="button" class="btn btn-primary">
              Send Password
            </button>

            <button
              type="button"
              class="btn btn-danger"
              data-bs-dismiss="modal"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- END MODAL -->

    <script>
      function aeEmpty(e) {
        var ee = "";
        try {
          ee = e.trim();
        } catch (error) {
          return true;
        }
        try {
          switch (e) {
            case "":
            case 0:
            case "0":
            case null:
            case false:
            case undefined:
              return true;
            default:
              return false;
          }
        } catch (error) {
          return true;
        }
      }
    </script>

    <script>
      function validateLogin() {

       // alert(username+" :"+password)
        $("#loading").show();
        $.ajax({
          type: "post",
          data: {
            username: username,
            password: password,
          },
          cache: false,
          url: "validateLogin.php",
          dataType: "text",
          error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
          },

          success: function (data, status) {
            $("#loading").hide();

          //  alert(data)



            if (data == 0) {
              aeTitle = "INVALID LOGIN ATTEMPT";
              aeBody = "PLEASE ENTER VALID LOGIN DETAILS";
              $("#aeAlertTitle").text(aeTitle);
              $("#aeAlertBody").text(aeBody);
              $("#aeAlert").modal("show");
            } else if (data == 1) {
              location.href = "donation.html";
            } else if (data == 2) {
              location.href = "expense.html";
            } else if (data == 900) {
              location.href = "admin.html";
            }
          },
        });
      }
    </script>

    <script>
      function select_email(){
        $("#loading").show();
        $.ajax({
          type: "post",
          data: {
            email: email


          },
          cache: false,
          url: "select_email.php",
          dataType: "text",
          error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
          },

          success: function (data,status) {
            $("#loading").hide();

            var output=data.split("|");
            var username=output[0];
            var password=output[1];

          //  alert(username+" "+password)

          if(username==0){
            aeTitle = "INVALID EMAIL ADDRESS";
                aeBody = "YOUR EMAIL ADDRESS IS UNKNOWN.ENTER A REGISTERED EMAIL ADDRESS";
                $("#aeAlertTitle").text(aeTitle);
                $("#aeAlertBody").text(aeBody);
                $("#aeAlert").modal("show");
          }


      

            send_password_recovery(username,password)
            
        
          },
        });
      }
      function send_password_recovery(username,password){

        var subject="PASSWORD RECOVERY";
        var message="Hi,\n your Correct Login Details:"+"\n\n USERNAME: "+username
        +"\nPASSWORD: "+password



        $("#loading").show();
        $.ajax({
          type: "post",
          data: {
            receiver: email,
            subject:subject,
            message:message



          },
          cache: false,
          url: "sendEmail.php",
          dataType: "text",
          error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
          },

          success: function (data,status) {
            $("#loading").hide();
            if(data==1){

              aeTitle = "PASSWORD RECOVERY SENT SUCCESSFULLY.";
                aeBody = "WE HAVE SEND YOUR CORRECT LOGIN DETAILS TO YOUR EMAIL ACCOUNT";
                $("#aeAlertTitle").text(aeTitle);
                $("#aeAlertBody").text(aeBody);
                $("#aeAlert").modal("show");

            }

         
          },
        });
      }

    </script>

    <script>
            const validateEmail = (email) => {
        return String(email)
          .toLowerCase()
          .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          );
      };
    </script>


<script>
  
 
      
</script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
