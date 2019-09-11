<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      User Management
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
      
      <li class="active">User Management</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modeladduser">
          Add User
        </button>


      </div>



      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
            <thead>
              <tr>
                <th style="width: 10px ">#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Photo</th>
                <th>Profile</th>
                <th>Status</th>
                <th>Last login</th>
                <th>Actions</th>
              </tr>

            </thead>

            <tbody>
              <tr>
                <td>1</td>
                <td>Administrator</td>
                <td>admin</td>
                <td><img src="views/img/users/default/anonymous.png" alt="User Photo" class="img-thumbnail" width="40 px"></td>
                <td>Administrator</td>
                <td><button class="btn btn-success btn-xs">Activated</button></td>
                <td>2019-09-02 3:58 AM</td>
                <td>
                  <div class="btn btn-group">
                    <button class="btn btn-warning" > <i class="fa fa-pencil" ></i></button>
                    <button class="btn btn-warning" > <i class="fa fa-times" ></i></button>
                  </div>

                </td>
              </tr>

              <tr>
                <td>1</td>
                <td>Administrator</td>
                <td>admin</td>
                <td><img src="views/img/users/default/anonymous.png" alt="User Photo" class="img-thumbnail" width="40 px"></td>
                <td>Administrator</td>
                <td><button class="btn btn-success btn-xs">Activated</button></td>
                <td>2019-09-02 3:58 AM</td>
                <td>
                  <div class="btn btn-group">
                    <button class="btn btn-warning" > <i class="fa fa-pencil" ></i></button>
                    <button class="btn btn-warning" > <i class="fa fa-times" ></i></button>
                  </div>

                </td>
              </tr>

              <tr>
                <td>1</td>
                <td>Administrator</td>
                <td>admin</td>
                <td><img src="views/img/users/default/anonymous.png" alt="User Photo" class="img-thumbnail" width="40 px"></td>
                <td>Administrator</td>
                <td><button class="btn btn-success btn-xs">Activated</button></td>
                <td>2019-09-02 3:58 AM</td>
                <td>
                  <div class="btn btn-group">
                    <button class="btn btn-warning" > <i class="fa fa-pencil" ></i></button>
                    <button class="btn btn-warning" > <i class="fa fa-times" ></i></button>
                  </div>

                </td>
              </tr>


            </tbody>

          
        </table>

      </div>

    </div>

  </section>

</div>

<!-- Add user model -->


<div id="modeladduser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">


      <form role="form" method="post" enctype="multipart/form-data">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="background: #3c8dbc; color: #fff" >&times;</button>
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"> </i> </span>
              <input class="form-control input-lg" type="text" name="newName" placeholder="Insert Name" required>
              
            </div>
            
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"> </i> </span>
              <input class="form-control input-lg" type="text" name="newUsername" placeholder="Insert Username" required>
              
            </div>
            
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"> </i> </span>
              <input class="form-control input-lg" type="password" name="newPassword" placeholder="Insert Password" required>
              
            </div>
            
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-users"> </i> </span>
              <select class="form-control input-lg" name="newProfile" >
                
                <option value="">Select profile</option>
                  <option value="administrator">Administrator</option>
                  <option value="special">Special</option>
                  <option value="seller">Seller</option>

              </select>

              <!-- Uploading image -->
            <div class="form-group">

              <div class="panel">Upload image</div>

              <input class="newPics" type="file" name="newPhoto">

              <p class="help-block">Maximum size 2Mb</p>

              <img class="thumbnail preview" src="views/img/users/default/anonymous.png" width="100px">

            </div>

              
            </div>
            
          </div>

        </div>



      </div>


      <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save</button>
          
        </div>

    </form>

    </div>

  </div>
</div>



