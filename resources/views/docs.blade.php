<!DOCTYPE html>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="cache-control" content="no-cache">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
      <meta name="author" content="Elemental Path" />
      <meta name="description" content="RiveScript UI" />
      <meta name="keywords"  content="" />
      <meta name="Resource-type" content="Document" />
      
      <title>Documentation</title>

      <!-- Import jQuery, Bootstrap -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

      <style type="text/css">
      th, td
      {
        text-align: center;
      }
      .route
      {
        font-weight: bold;
        text-align: left;
      }
      </style>

    </head>

    <body>

      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="/api/v0.1/docs">CS656 IHLP</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div><!-- /.container-fluid -->
      </nav>

      <div class="container">
        <div class="row">

          <div class="col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">User Management</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tr>
                    <th>Route</th>
                    <th>HTTP Method</th>
                    <th>Required Parameters</th>
                    <th>Optional Parameters</th>
                    <th>Protected?*</th>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/user/login</td>
                    <td>GET</td>
                    <td>
                      email<br />password
                    </td>
                    <td>---</td>
                    <td>NO</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/user/register</td>
                    <td>POST</td>
                    <td>
                      name<br />email<br />password<br />role**
                    </td>
                    <td>---</td>
                    <td>NO</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/user/edit</td>
                    <td>PUT</td>
                    <td>---</td>
                    <td>name<br />email<br />role**</td>
                    <td>YES</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/user/password</td>
                    <td>PATCH</td>
                    <td>password</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/user/delete</td>
                    <td>DELETE</td>
                    <td>---</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                </table>
                *
              </div><!-- .panel-body -->
            </div><!-- .panel -->


            
        </div><!-- .col-xs-8 -->
      </div><!-- .row -->
    </div><!-- .container -->

    </body>
</html>