<div class="container-fluid" style="background-color: rgb(25,25,25); padding: 0;">
  <div class="row no-gutters">
    <div class="col-md-3" onclick="LoadInnerPageSimple('Home');">
      <h3 style="color: rgb(255, 255, 255); margin: 4%;">Snuggle Bot</h3>
    </div>

    <div class="col-md-5"></div>
    <div class="col-md-2">
      <select id="ServerSelector" class="form-control" onchange="LoadInnerPageSimple('Home');">
        <option value="0">Global Statistics</option>
        <?php
        $serverName = "Removed for security"; // update me
        $connectionOptions = array(
          "Database" => "Removed for security", // update me
          "Uid" => "Removed for security", // update me
          "PWD" => "Removed for security"
        );
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if($conn){
        echo "<script>console.log(\"Database connection reached\");</script>";
          $GuildResult = sqlsrv_query($conn, "select * from Guild;");

          $row = sqlsrv_fetch_array($GuildResult, SQLSRV_FETCH_ASSOC);
          do{
            if(is_null($row)){
              echo "<script>console.log(\"oof\");</script>";
              break;
            }
            echo ("<option value=\"" . $row['GuildID'] . "\">" . $row['GuildName'] . "</option>");
          }while($row = sqlsrv_fetch_array($GuildResult, SQLSRV_FETCH_ASSOC));
          sqlsrv_close($conn);
        }else{

          echo "<script>console.log(\"Failed\");</script>";
          die( print_r( sqlsrv_errors(), true));
        }
        ?>
      </select>
    </div>

    <div class="col-md-2">
      <button type="button" class="btn btn-primary" style="margin: 4%; padding: 3% 12%; float: right;">Login</button>
    </div>
  </div>
</div>
