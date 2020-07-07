<div class="container-fluid" style="background-color: rgb(35,35,35); padding: 0; height: 100%;">

  <div id="admin-header" class="row no-gutters category-header" onclick="sidebar_SelectCat('admin');">
    <div class="col-12">
      <h4>Admin</h4>
    </div>
  </div>
  <div id="admin-sub" class="row no-gutters sub-category" style="background-color: rgb(40, 40, 40); display: none;">
    <div class="col-12">
      <ul style="list-style-type: none; padding-top: 0.5em; padding-left: 2em; padding-right: 1em; padding-bottom: 1em;">
        <li class="category-sub-buttons" onclick="LoadInnerPage('Users', 1, 15);"><p>Users</p></li>
        <li class="category-sub-buttons" onclick="LoadInnerPage('Bans', 1, 15);"><p>Bans</p></li>
      </ul>
    </div>
  </div>

    <div id="posts-header" class="row no-gutters category-header">
      <div class="col-12" onclick="sidebar_SelectCat('posts');">
        <h4>Posts</h4>
      </div>
    </div>
    <div id="posts-sub" class="row no-gutters sub-category" style="background-color: rgb(40, 40, 40); display: none;">
      <div class="col-12">
        <ul style="list-style-type: none; padding-top: 0.5em; padding-left: 2em; padding-right: 1em; padding-bottom: 1em;">
          <li class="category-sub-buttons" onclick="LoadInnerPage('ReactionPosts');"><p>Reaction post</p></li>
        </ul>
      </div>+
    </div>
</div>
