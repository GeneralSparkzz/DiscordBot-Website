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
  if($GuildID != 0){
    $UserCount = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(GU.UserID) as UserCount from GuildUser GU join GuildUserConnector GUC on GU.UserID = GUC.UserID where GUC.GuildID = '$GuildID';"))['UserCount'];
    $BanCount = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(B.BannedID) as BannedCount from Bans B join Guild G on B.GuildID = G.GuildID where G.GuildID = '$GuildID';"))['BannedCount'];
    echo "Total users in server: $UserCount, with $BanCount bans";
  }else{
    $UserCount = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(UserID) as UserCount from GuildUser;"))['UserCount'];
    $ServerCount = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(GuildID) as GuildCount from Guild;"))['GuildCount'];

    echo "<div class=\"container\">
      <div class=\"row\" style=\"margin: 1em;\">
        <div class=\"col-2\"></div>
        <div class=\"col-4\">
          <h4>Servers using Snuggle:</h4>
        </div>
        <div class=\"col-4\">
          <h4>$ServerCount</h4>
        </div>
        <div class=\"col-2\"></div>
      </div>
      <div class=\"row\" style=\"margin: 1em;\">
        <div class=\"col-2\"></div>
        <div class=\"col-4\">
          <h4>Total users:</h4>
        </div>
        <div class=\"col-4\">
          <h4>$UserCount</h4>
        </div>
        <div class=\"col-2\"></div>
      </div>
      <div class=\"row\" style=\"margin: 1em;\">
        <div class=\"col-2\"></div>
        <div class=\"col-8\"><div class=\"card text-white bg-dark mb-3\">
          <div class=\"card-header \">
            How to use Snuggle Bot
          </div>
          <div class=\"card-body\">
            <blockquote class=\"blockquote mb-0\">
              <p>To begin using Snuggle bot, select a server in the dropdown of the top right. Once a server is selected you then are able to use all features on the right that are enabled!</p>
            </blockquote>
          </div>
        </div>
      </div>
      <div class=\"col-2\"></div>
    </div>
    </div>";
  }
  sqlsrv_close($conn);
}
?>
