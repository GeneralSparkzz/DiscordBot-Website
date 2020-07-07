<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Director page between all sub sites" />
  <meta name="author" content="Frank Work" />
  <title>Snuggle Bot</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
  <!-- Third party plugin CSS-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <style>
  p, h1, h2, h3, h4, h5, h6, body, html{
    padding: 0;
    margin: 0;
    color: rgb(255,255,255);
  }
  .category-header{
    padding: 1em;
    margin: 0;
  }
  .category-header:hover{
    background-color: rgb(50,50,50);
  }
  .category-sub-buttons:hover{
    background-color: rgb(50,50,50);
  }
  </style>
</head>
<body style="background-color: rgb(50,50,50); padding: 0; height: 100%;">
  <div class="container-fluid" style="padding: 0; height: 100%;">
    <div class="row no-gutters">
      <div class="col-12">
        <?php include './partials/Bot/navbar.php';?>
      </div>
    </div>
    <div class="row no-gutters" style="height: 100%;">
      <div class="col-2">
        <?php include './partials/Bot/sidebar.php';?>
      </div>
      <div class="col-10">
        <div id="InnerPage">
        </div>
      </div>
    </div>
  </div>
  <!-- Footer-->
  <!--<footer class="bg-light py-5 position-fixed fixed-bottom">
  <div class="container"><div class="small text-center text-muted">Copyright © 2020 - Frank Work</div></div>
</footer>-->
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
function sidebar_SelectCat(category){
  var SubCat = document.getElementById(category + "-sub");
  if(SubCat != null){
    var AllSubCats = document.getElementsByClassName("sub-category");

    for(var i = 0; i < AllSubCats.length; i++){
      if(AllSubCats[i] != SubCat){
        AllSubCats[i].style.display = "none";
      }else{
        AllSubCats[i].style.display = "block";
      }
    }
  }
}

function LoadInnerPage(name, page, listCount){
  var GuildID = document.getElementById("ServerSelector").value;

  if(GuildID == 0){
    window.alert("You must select a server first!");
  }else{

    if(page <= 0){
      page = 1;
    }

    if(listCount <= 0){
      listCount = 1;
    }

    $.ajax({
      url: "./partials/Bot/SubPages/" + name + ".php",
      type: 'post',
      data: {
        guildID: GuildID,
        pageToLoad: page,
        PerPageCount: listCount
      },
      success: function (data) {
        $("#InnerPage").html(data);
      },
      error: function () {
        $("#InnerPage").html('<div class="alert alert-info" role="alert">This page is not yet implemented into snuggle bot! Don\'t worry, it should arrive soon!</div>');
      }
    })
  }
}
function LoadInnerPageSimple(name){
  var GuildID = document.getElementById("ServerSelector").value;

  if(GuildID == 0 && name != "Home" && name != "Disclaimer"){
    window.alert("You must select a server first!");
  }else{
    $.ajax({
      url: "./partials/Bot/SubPages/" + name + ".php",
      type: 'post',
      data: {
        guildID: GuildID
      },
      success: function (data) {
        $("#InnerPage").html(data);
      },
      error: function () {
        $("#InnerPage").html('<div class="alert alert-info" role="alert">This page is not yet implemented into snuggle bot! Don\'t worry, it should arrive soon!</div>');
      }
    })
  }
}
LoadInnerPageSimple("Disclaimer");
</script>
</body>
</html>
