<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Funeral Donation App</title>
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
        position: absolute;
        z-index: 2000;
        float: right;
      }
    </style>

    <script>
      var nameDel = "";
      $(document).ready(function () {
        updateList();

        $("#myMAddNewName").on("click", "#btMdelete", function (e) {
          e.preventDefault();
          nameDel = $("#tfMaddName").val();

          $("#nametodelete").text(nameDel);

          $("#myMAddDelete").modal("show");
        });

        $("#myMAddDelete").on("click", "#btMContinue", function (e) {
          e.preventDefault();
          $("#myMAddDelete").modal("hide");

          $.post(
            "deleteMember.php",
            {
              nameToDelete: nameDel,
            },
            function (data, status) {
              $("#myMAddNewName").modal("hide");
              location.href="index.php"
           
            }
          );
        });

        $("#btAddNewName").click(function () {
          var e = document.getElementById("nameList");
          var value = e.value;

          if(value=="To this Family Member"){
            value="";
          }
    
          nameDel = $("#tfMaddName").val(value);
          $("#myMAddNewName").modal("show");
        });

        $("#myMAddNewName").on("click", "#btMadd", function (e) {
          e.preventDefault();
          var name = $("#tfMaddName").val();

          $.post(
            "addNewFamilyMember.php",
            {
              newName: name,
            },
            function (data, status) {
              $("#myMAddNewName").modal("hide");

              updateList();
            }
          );
        });
      });
    </script>
  </head>
  <body>
    <button type="button" class="btn btn-primary sticky-top">
      System Report <i class="bi bi-filetype-pdf"></i>
    </button>
    <div class="h-100 d-flex align-items-center justify-content-center m-1">
      <div
        class="h-100 d-flex align-items-center justify-content-center m-auto"
      >
        <form id="form">
          <div class="form-outline mb-2 text-center">
            <h3>
              Receive Donation1
              <i class="bi bi-cash"></i>
            </h3>
          </div>

          <!--  input -->
          <div class="form-outline mb-2">
            <input
              required
              type="text"
              id="donarName"
              class="form-control"
              placeholder="Donor's name"
              style="font-weight: bold; color: black; background-color: white"
            />
          </div>
          <div class="form-outline mb-2">
            <input
              required
              type="tel"
              pattern="[0-9]{10}"
              id="donarMobile"
              class="form-control"
              placeholder="Donor's Mobile"
              style="font-weight: bold; color: black; background-color: white"
            />
          </div>
          <!--end  input -->

          <!--  input -->
          <div class="form-outline mb-2">
            <select
              id="nameList"
              style="font-weight: bold"
              class="form-select w-100"
            >
              <option selected>To this Family Member</option>
            </select>
          </div>
          <!--end  input -->
          <!--  input -->
          <div class="form-outline mb-2">
            <input
              required
              type="number"
              min="0"
              id="DonationAmount"
              class="form-control"
              placeholder="Donation Amount (GHS)"
              style="font-weight: bold; color: black; background-color: white"
            />
          </div>
          <!--end  input -->

          <div class="form-outline mb-2">
            <button style="font-weight: bold" class="btn-primary w-100">
              Add Donation
            </button>
          </div>
          <div class="row">
            <div class="col-6">
              <button
                style="font-weight: bold"
                class="btn-primary w-100"
                type="button"
              >
                Edit<i class="fa fa-pencil" aria-hidden="true"></i>
              </button>
            </div>
            <div class="col-6">
              <button
                id="btAddNewName"
                style="font-weight: bold"
                class="btn-primary w-100"
                type="button"
              >
                Name <i class="fa fa-user" aria-hidden="true"></i>
              </button>
            </div>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              id="ckReceipt"
              checked
            />
            <label class="form-check-label" for="ckReceipt">
              <i class="bi bi-receipt"></i>
              Auto print receipt
            </label>
          </div>

          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              id="ckSMS"
              checked
            />
            <label class="form-check-label" for="ckSMS">
              <i class="bi bi-chat-dots-fill"></i>
              Auto send SMS
            </label>
          </div>

          <hr />

          <h5>
            Total received
            <span style="font-size: 5r3m"> &nbsp; 0 &nbsp; GHS</span>
          </h5>

          <!-- 2 column grid layout for inline styling -->
          <div class="row mb-4">
            <div class="col d-flex justify-content-start">
              <!-- Checkbox -->
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal HTML -->
    <div id="myMAddNewName" class="modal fade" tabindex="-3">
      <div class="modal-dialog" style="width: 20rem">
        <div class="modal-content">
          <div style="background-color: aqua" class="modal-header">
            <h5 class="modal-title">Add New Name to List</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <label for="tfMaddName">Enter Name</label>
            <input id="tfMaddName" type="text" placeholder="New Name" />
          </div>
          <div style="background-color: aqua" class="modal-footer">
            <button id="btMadd" type="button" class="btn btn-primary">
              Add Name
            </button>
            <button id="btMdelete" type="button" class="btn btn-danger">
              Delete <i class="fa fa-trash" aria-hidden="true"></i>
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

    <!-- Modal HTML -->
    <div id="myMAddDelete" class="modal fade" tabindex="-3">
      <div class="modal-dialog" style="width: 20rem">
        <div class="modal-content">
          <div style="background-color: aqua" class="modal-header">
            <h5 class="modal-title">CONFIRM DELETION</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <h6 id="nametodelete" style="color: red; background-color: white">
              **********
            </h6>
            <h6>
              DO YOU WANT TO DELETE THIS FAMILY MEMBER?

              <h6>ALL DATA FOR THIS MEMBER WILL BE REMOVED.</h6>
              <span style="font-style: italic; text-decoration: underline"
                >NB: you cannot Undo this operation</span
              >
            </h6>
          </div>
          <div style="background-color: aqua" class="modal-footer">
            <button id="btMContinue" type="button" class="btn btn-danger">
              Delete <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
            <button
              id="btMdelete"
              type="button"
              class="btn btn-primary"
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
      function updateList() {
        $.ajax({
          url: "selectMemberList.php",
          type: "get",
          dataType: "JSON",
          success: function (response) {
            var len = response.length;

            try {
              $("#nameList")
                .empty()
                .append(
                  '<option selected="selected" >To this Family Member</option>'
                );

              for (let i = 1; i < len; i++) {
                var nam = response[i].item;

                var o = new Option(nam);
                /// jquerify the DOM object 'o' so we can use the html method
                $(o).html(nam);
                $("#nameList").append(o);
              }

              $("option").css({
                "font-weight": "bold",
              });
            } catch (error) {}

            // var li = response[1].newName;

            return;
          },
        });
      }
    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
