<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://eonasdan.github.io/bootstrap-datetimepicker/css/prettify-1.0.css">
    <link rel="stylesheet" href="https://eonasdan.github.io/bootstrap-datetimepicker/css/base.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">



  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class='col-md-5'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker6'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-md-5'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker7'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    </div>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript">
      $(function () {
          $('#datetimepicker6').datetimepicker();
          $('#datetimepicker7').datetimepicker({
              useCurrent: false //Important! See issue #1075
          });
          $("#datetimepicker6").on("dp.change", function (e) {
              $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
          });
          $("#datetimepicker7").on("dp.change", function (e) {
              $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
          });
      });
  </script>
</html>
