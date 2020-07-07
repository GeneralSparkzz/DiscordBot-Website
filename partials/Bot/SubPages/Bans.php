  <table class="table table-stripped table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Reason</th>
        <th scope="col">UserID</th>
      </tr>
    </thead>
    <tbody>
    <?php
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
          $sql= "exec SP_FetchBans '$GuildID', 10, 0;";
          $getResults = sqlsrv_query($conn, $sql);
          if ($getResults == FALSE){
              echo (sqlsrv_errors());
            }
          $count = 0;
          while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
            $count = $count + 1;
           echo ("<tr>
                  <th scope=\"row\">". $count . "</th>
                  <td>" . $row['BannedName'] . "</td>
                  <td>" . $row['BannedReason'] . "</td>
                  <td>" . $row['BannedID'] . "</td>
                  </tr>");
          }
          sqlsrv_free_stmt($getResults);
        }else{
         echo "Connection could not be established.<br />";

         //die( print_r( sqlsrv_errors(), true));
        }
        sqlsrv_close($conn);
     ?>
   </tbody>
 </table>
