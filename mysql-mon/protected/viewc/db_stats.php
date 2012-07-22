<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo $this->data['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <META HTTP-EQUIV="REFRESH" CONTENT="12System0">
        <link href="global/css/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="global/css/app.css" rel="stylesheet">
        <link rel="shortcut icon" href="global/image/favicon.ico">
    </head>
      <body data-spy="scroll" data-target=".subnav" data-offset="50">
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand">MySQL Monitor</a>
                </div>
            </div>
        </div>
        <div class="container">
            <header class="jumbotron subhead" id="overview">
                <h1>MySQL Database Stats</h1>
                <p class="lead">Detailed real-time DB performance and health</p>
                <div class="subnav">
                    <ul class="nav nav-pills">
                        <li>
                            <a href="#mysql_questions">Questions</a>
                        </li>
                        <li>
                            <a href="#mysql_select_sort">Select / Sort</a>
                        </li>
                        <li>
                            <a href="#mysql_connections">Connections</a>
                        </li>
                        <li>
                            <a href="#mysql_bytes">Traffic</a>
                        </li>
                        <li>
                            <a href="#mysql_temp">Created Temp</a>
                        </li>
                        <li>
                            <a href="#mysql_table_locks">Table Locks</a>
                        </li>
                        <li>
                            <a href="#mysql_innodb">InnoDB</a>
                        </li>
                    </ul>
                </div>
            </header>
            
            <section id="mysql_questions">
                <div class="page-header">
                    <h1>MySQL
                        <small>Questions</small>
                    </h1>
                </div>
                <div id="mysql-questions-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </section>
            <section id="mysql_select_sort">
                <div class="page-header">
                    <h1>MySQL
                        <small>Select / Sort</small>
                    </h1>
                </div>
                <div id="mysql-select-sort-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </section>
            <section id="mysql_connections">
                <div class="page-header">
                    <h1>MySQL
                        <small>Connections</small>
                    </h1>
                </div>
                <div id="mysql-connections-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </section>
            <section id="mysql_bytes">
                <div class="page-header">
                    <h1>MySQL
                        <small>Traffic</small>
                    </h1>
                </div>
                <div id="mysql-bytes-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </section>
            <section id="mysql_temp">
                <div class="page-header">
                    <h1>MySQL
                        <small>Created Temp</small>
                    </h1>
                </div>
                <div id="mysql-temp-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </section>
            <section id="mysql_table_locks">
                <div class="page-header">
                    <h1>MySQL
                        <small>Table Locks</small>
                    </h1>
                </div>
                <div id="mysql-table-locks-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </section>
            <section id="mysql_innodb">
                <div class="page-header">
                    <h1>MySQL
                        <small>InnoDB</small>
                    </h1>
                </div>
                <div id="mysql-innodb-bp-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                <div id="mysql-innodb-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </section>                       
        </div>
        <!-- /container -->
        <script src="global/js/jquery-1.7.2.min.js"></script>
        <script src="global/js/bootstrap/bootstrap.js"></script>
        <script src="global/js/highcharts/highcharts.js"></script>
        <script src="global/js/db_stats.js"></script>
    </body>

</html>
