<!DOCTYPE html>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="cache-control" content="no-cache">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
      <meta name="author" content="Jay Ravaliya" />
      <meta name="description" content="CS 656 - IHLP Project" />
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
      table
      {
        table-layout: fixed;
      }
      .scroll-section
      {
        max-height: 250px;
        overflow: scroll;
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
            <div class="alert alert-info text-center" role="alert">
              <h3 class="header">{{{ URL::to('/') }}} <small>Root URL</small></h3>
            </div>

            <!-- The Basics -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">The Basics</h3>
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
                    <td class="route">/api/v0.1/heartbeat</td>
                    <td>GET</td>
                    <td>---</td>
                    <td>---</td>
                    <td>NO</td>
                  </tr>
                </table>
              </div>
            </div>

            <!-- User Management -->
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
                    <td>POST</td>
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
                      name<br />email<br />password
                    </td>
                    <td>
                      company_id++
                    </td>
                    <td>NO</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/user/edit</td>
                    <td>PUT</td>
                    <td>---</td>
                    <td>
                      name<br />email<br />company_id++<br />twitter<br />linkedin<br />resume<br />website
                    </td>
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
                    <td class="route">/api/v0.1/user/logout</td>
                    <td>POST</td>
                    <td>---</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/user/deactivate</td>
                    <td>DELETE</td>
                    <td>---</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                </table>
                <div class="well well-sm scroll-section">
                  <h3 class="header">Current Users** <small>{{{ count($users) }}} total user(s)</small></h3>
                  @foreach($users as $user)
                    <code>{{{ $user }}}</code><br /><br />
                  @endforeach
                </div>
              </div>
            </div>
            <!-- Chat -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Chat</h3>
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
                    <td class="route">/api/v0.1/chat/addChat</td>
                    <td>POST</td>
                    <td>message<br/>from_user_id<br/>to_user_id</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/chat/getChat</td>
                    <td>GET</td>
                    <td>from_user_id<br/>to_user_id</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                   <tr>
                    <td class="route">/api/v0.1/chat/deleteChat</td>
                    <td>POST</td>
                    <td>chat_id</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/chat/deleteConverstion</td>
                    <td>POST</td>
                    <td>from_user_id<br/>to_user_id</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                </table>
              </div>
            </div>

            <!-- Companies -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Companies</h3>
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
                    <td class="route">/api/v0.1/company/companies</td>
                    <td>GET</td>
                    <td>---</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/company/recruiters</td>
                    <td>GET</td>
                    <td>---</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/company/search</td>
                    <td>GET</td>
                    <td>---</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                </table>
                <div class="well well-sm scroll-section">
                  <h3 class="header">Current Companies (w/recruiters) <small>{{{ count($companies) }}} total companies</small></h3>
                  @foreach($companies as $company)
                  <code>{{{ $company }}}</code><br /><br />
                  @endforeach
                </div>
              </div>
            </div>

            <!-- Relationships -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">User Relationships</h3>
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
                    <td class="route">/api/v0.1/relationship/list</td>
                    <td>GET</td>
                    <td>---</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                  <tr>
                    <td class="route">/api/v0.1/relationship/add</td>
                    <td>POST</td>
                    <td>connection_token+</td>
                    <td>---</td>
                    <td>YES</td>
                  </tr>
                </table>
              </div>
            </div>

            <!-- Documentation Key -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Documentation Key</h3>
              </div>
              <div class="panel-body">
                <div class="well well-sm">
                  <strong>* Protected:</strong> Any route where "Protected?" is "YES" must include an HTTP Parameter "token" which is returned to the client when a user logs in or registers.<br />
                  <strong>** Student vs Recruiter:</strong> A student is defined by anyone whose "role" field is 1. This can only be changed if the client changes this value to 2 via <code>/api/v0.1/user/register</code> or <code>/api/v0.1/user/edit</code> routes. Default value for all users is 1.<br />
                  <strong>+ connection_token:</strong> Currently, the API only supports student to recruiter connection. See above for what constitutes a student or a recruiter.<br />
                  <strong>++ company_id:</strong> Company ID will be made available through either the <code>/api/v0.1/company/companies</code> or <code>/api/v0.1/company/search</code> routes. The selection must be sent through as an ID.<br />
                  <h5 class="header">Resources</h5>
                  <ul>
                    <li>Check out <a href="http://jsonprettyprint.com" target="_BLANK">JSON Pretty Print</a> if the objects on the HTML page are hard to read.</li>
                    <li>Check out <a href="https://www.getpostman.com/" target="_BLANK">Postman</a> or <a href="https://chrome.google.com/webstore/detail/advanced-rest-client/hgmloofddffdnphfgcellkdfbfbjeloo?hl=en-US" target="_BLANK">Advanced REST Client</a> to test the API with HTTP Requests.</li>
                  </ul>
                </div>
              </div>
            </div>
                              
        </div><!-- .col-xs-8 -->
      </div><!-- .row -->
    </div><!-- .container -->

    </body>
</html>