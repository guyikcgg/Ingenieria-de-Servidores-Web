<!DOCTYPE html>
<?php
function alert_warning($str) {
    echo "<script>alert_warning('".$str."');</script>";
}
function alert_danger($str) {
    echo "<script>alert_danger('".$str."');</script>";
}
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="My-Visit-Counter control panel">
        <meta name="author" content="Cristian G Guerrero">
        <!-- link rel="icon" href="http://getbootstrap.com/favicon.ico" TODO-->

        <title>My Visit Counter - Control Panel</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="ctrlpanel_files/offcanvas.css" rel="stylesheet">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        </style>
    </head>

    <body class="bg-light">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
        <script>
            button = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>';
        function alert_success(str) {
            $('#alert-zone').append('<div class="alert alert-success" role="alert">'+str+button+'</div>');
        }
        function alert_danger(str) {
            $('#alert-zone').append('<div class="alert alert-danger" role="alert">'+str+button+'</div>');
        }
        function alert_warning(str) {
            $('#alert-zone').append('<div class="alert alert-warning" role="alert">'+str+button+'</div>');
        }
        function logout() {
            document.cookie = 'id_token=;expires=Wed; 01 Jan 1970';
        }

        function display_received_msg(data, status) {
            if (status == 'success') {
                status = data.substring(0, 4);
                data   = data.substr(6);
                switch (status) {
                    case "_OK_":
                    alert_success(data);
                    retval = 'success';
                    break;

                    case "ERR_":
                    alert_danger(data);
                    retval = 'error';
                    break;

                    case "WARN":
                    alert_warning(data);
                    retval = 'warning';
                    break;

                    default:
                    alert_danger("Received unformatted message: "+data);
                    retval = 'error';
                    break;
                }
            } else {
                alert_danger("Error connecting to <i>manage.php</i>. STATUS: "+status+" DATA: "+data);
                retval = 'error';
            }
            return retval;
        }

        // Add counter
        function addCounter() {
            $.post("manage.php",
                {
                    userToken: userToken,
                    q: "addCounter"
                }, function(data, status) {
                    if (display_received_msg(data, status) == 'success') {
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
                }).fail(function() {
                    alert_danger("Error connecting to 'manage.php'");
                });
        }

        // Increment counter
        function incrementCounter(counterID) {
            $.post("manage.php",
                {
                    userToken: userToken,
                    q: "incrementCounter",
                    counterID: counterID
                }, function(data, status) {
                    if (display_received_msg(data, status) == 'success') {
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
                }).fail(function() {
                    alert_danger("Error connecting to 'manage.php'");
                });
        }

        // Reset counter
        function resetCounter(counterID) {
            $.post("manage.php",
                {
                    userToken: userToken,
                    q: "resetCounter",
                    counterID: counterID
                }, function(data, status) {
                    if (display_received_msg(data, status) == 'success') {
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
                }).fail(function() {
                    alert_danger("Error connecting to 'manage.php'");
                });
        }

        // Edit conter value
        function editValue(counterID) {
            var newValue = prompt("Enter new value for the counter", "0");
            $.post("manage.php",
                {
                    userToken: userToken,
                    q: "editCounter",
                    counterID: counterID,
                    value: newValue
                }, function(data, status) {
                    if (display_received_msg(data, status) == 'success') {
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
                }).fail(function() {
                    alert_danger("Error connecting to 'manage.php'");
                });
        }

        // Delete conter
        function deleteCounter(counterID) {
            var doDelete = confirm("Really delete counter '"+counterID.toString()+"' ?");
            if (doDelete)
            $.post("manage.php",
                {
                    userToken: userToken,
                    q: "deleteCounter",
                    counterID: counterID
                }, function(data, status) {
                    if (display_received_msg(data, status) == 'success') {
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
                }).fail(function() {
                    alert_danger("Error connecting to 'manage.php'");
                });
        }

        </script>


        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
            <a class="navbar-brand" href="#">My Visit Counter</a>
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Control Panel <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">API reference</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="container">

        <div id="alert-zone" class="my-3"></div>
            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h6 class="border-bottom border-gray pb-2 mb-0">Counters</h6>
<?php
// Required by Google App Engine
libxml_disable_entity_loader(false);

// Load custom service
$location = "http://my-visit-counter.appspot.com/service.php";

// Set Soap timeout
ini_set('default_socket_timeout', 50);
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

try {
    $client = new SoapClient(null, array('location'=>$location, 'uri'=>"http://test-uri/", 'trace'=>1));
} catch (SoapFault $error) {
    alert_danger('Error connecting to server. SoapClient says: '.$error->faultstring);
}

// Authenticate the user
try {
    require 'auth.php';
    echo '<script>userToken = "'.$userID.'";</script>'."\n";
} catch (Exception $e) {
    alert_danger('Authentication error: '.$e->getMessage());
}

try {
    $counterList = $client->ListarContadores($userID);
    if (sizeof($counterList) == 0) {
        alert_warning("You do not have any counter yet. Tip: click <i>Add counter</i>");
    }
    foreach($counterList as $counterID) {
        $visits = $client->LeerContador($counterID);
        $fVisits = $visits;
        $sVisits = $visits;
        $strVisits = $visits==1?" visit":" visits";
        $counterName = "Unnamed Counter";
        echo '
                <div class="media text-muted pt-3 border-bottom border-gray">
                    <span class="mr-2 rounded" style="width: 64px; height: 32px; text-align: center; background-color: #212529; color: lightgray; padding-top: 5px;" data-toggle="tooltip" data-placement="top" title="'.$fVisits.$strVisits.'"><b>'.$sVisits.'</b></span>
                    <div class="media-body pb-3 mb-0 small lh-125">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <strong class="text-gray-dark">'.$counterName.'</strong>
                        </div>
                        <span class="d-block">#'.$counterID.'</span>
                    </div>
                    <div style="font-size: x-large;">
                        <a href="javascript:incrementCounter('.$counterID.')" style="padding: 2px" data-toggle="tooltip" data-placement="top" title="Increment value by one"><i class="fa fa-plus-square"></i></a>
                        <a href="javascript:resetCounter('.$counterID.')" style="padding: 2px" data-toggle="tooltip" data-placement="top" title="Reset to zero"><i class="fa fa-undo"></i></a>
                        <a href="javascript:editValue('.$counterID.')" style="padding: 2px" data-toggle="tooltip" data-placement="top" title="Edit value"><i class="fa fa-edit"></i></a>
                        <a href="javascript:deleteCounter('.$counterID.')" style="padding: 2px" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
 ';
    }
} catch (SoapFault $error) {
    alert_danger('Error retrieving counters: '.$error->faultstring."\n<br>Last SOAP call: ".htmlspecialchars($client->__getLastResponse(), END_QUOTES));
}


?>
               <small class="d-block text-right mt-3">
                    <a href="javascript:addCounter()">Add counter</a>
                </small>
            </div>
        </main>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="ctrlpanel_files/holder.js"></script>
        <script src="ctrlpanel_files/offcanvas.js"></script>


        <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        </script>
    </body>
</html>
