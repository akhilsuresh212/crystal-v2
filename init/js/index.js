$(document).ready(function() {});

$("#config_std_btn").click(function(e) {
  e.preventDefault();
  $("#steps").html('<li class="list-group-item">Starting...</li>');

  $.ajax({
    type: "POST",
    url: "controllers/controller.file.php",
    data: {
      action: "create_file"
    },
    dataType: "JSON",
    success: function(response) {
      console.log(response);

      if (response.status === "success") {
        $("#steps").html(
          '<li class="list-group-item">Configuration file initialized. Writting data.</li>'
        );
      } else {
        $("#steps").html(
          '<li class="list-group-item text-danger">' +
            response.message +
            "</li>"
        );
        return;
      }
    }
  });

  $.ajax({
    type: "POST",
    url: "controllers/controller.file.php",
    data: {
      action: "write_data"
    },
    dataType: "JSON",
    success: function(response) {
      console.log(response);
    }
  });
});
