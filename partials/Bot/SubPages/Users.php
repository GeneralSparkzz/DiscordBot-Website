<table class="table table-stripped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">UserID</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $PageNum = $_POST['pageToLoad'];
    $PageCount = $_POST['PerPageCount'];
    $GuildID = $_POST['guildID'];

    $serverName = "Removed for security"; // update me
    $connectionOptions = array(
      "Database" => "Removed for security", // update me
      "Uid" => "Removed for security", // update me
      "PWD" => "Removed for security" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if($conn){
      $MaxPage = 0;
      $UserCount = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(GU.UserID) as UserCount from GuildUser GU join GuildUserConnector GUC on GU.UserID = GUC.UserID where GUC.GuildID = '$GuildID';"))['UserCount'];

      if(is_null($UserCount) == false){
        $MaxPage = ceil(floatval($UserCount) / floatval($PageCount));
      }

      $sql_FetchUserSet = "exec SP_FetchUsers '$GuildID', " . $PageCount . ", " . (($PageNum - 1) * $PageCount) . ";";
      $getResults = sqlsrv_query($conn, $sql_FetchUserSet);
      if ($getResults == FALSE){
        echo (sqlsrv_errors());
      }
      $count = ($PageNum - 1) * $PageCount;
      $row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
      do{
        if(is_null($row)){
          echo "<script>LoadInnerPage('Users', " . ($PageNum - 1) . ", 15);</script>";
          break;
        }
        $count = $count + 1;
        echo ("<tr>
        <th scope=\"row\">". $count . "</th>
        <td>" . $row['Username'] . "</td>
        <td>" . $row['UserID'] . "</td>
        <td><button type=\"button\" class=\"btn btn-outline-warning\" onclick=\"kickUser(" . $row['UserID'] . ");\">Kick</button></td>
        <td><button type=\"button\" class=\"btn btn-outline-danger\" onclick=\"banUser(" . $row['UserID'] . ");\">Ban</button></td>
        </tr>");
      }while($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC));
      sqlsrv_free_stmt($getResults);

      echo ("
      </tbody>
      </table>
      <div class=\"container\">
      <div class=\"row\">
      <div class=\"col-1\">");

      if($PageNum == 1){
        echo ("<button type=\"button\" class=\"btn btn-secondary\" disabled>First</button>");
      }else{
        echo ("<button type=\"button\" class=\"btn btn-secondary\" onclick=\"LoadInnerPage('Users', 1, 15);\">First</button>");
      }

      echo ("
      </div>
      <div class=\"col-1\">");

      if($PageNum == 1){
        echo ("<button type=\"button\" class=\"btn btn-secondary\" disabled>Previous</button>");
      }else{
        echo ("<button type=\"button\" class=\"btn btn-secondary\" onclick=\"LoadInnerPage('Users', " . ($PageNum - 1) . ", 15);\">Previous</button>");
      }

      echo("
      </div>

      <div class=\"col-3\"></div>

      <div class=\"col-2\">
      <p id=\"pageNum\" class=\"center\">$PageNum</p>
      </div>

      <div class=\"col-3\"></div>

      <div class=\"col-1\">");

      if($MaxPage == $PageNum){
        echo ("<button type=\"button\" class=\"btn btn-secondary\" disabled>Next</button>");
      }else{
        echo ("<button type=\"button\" class=\"btn btn-secondary\" onclick=\"LoadInnerPage('Users', " . ($PageNum + 1) . ", 15);\">Next</button>");
      }

      echo ("
      </div>
      <div class=\"col-1\">");

      if($MaxPage == $PageNum){
        echo ("<button type=\"button\" class=\"btn btn-secondary\" disabled>Last</button>");
      }else{
        echo ("<button type=\"button\" class=\"btn btn-secondary\" onclick=\"LoadInnerPage('Users', " . ($MaxPage) . ", 15);\">Last</button>");
      }

      echo ("
      </div>
      </div>
      </div>
      ");
    }else{
      echo ("Connection could not be established.<br />");

      //die( print_r( sqlsrv_errors(), true));
    }
    sqlsrv_close($conn);
    ?>
