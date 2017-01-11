<section>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10" style="background-color: rgba(255,255,255,0.9)">
                <div class="p-10">

                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active" style="background:none;"><a data-target="#home" data-toggle="tab">Add Admin</a></li>
                        <li><a data-target="#profile" data-toggle="tab">View Admin</a></li>
                        <li><a data-target="#messages" data-toggle="tab">Admin Privilages</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <form id="admin" method="POST">
                                <h2>Add Sub Admins</h2>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control h-50" name="username" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control h-50" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="privilege1" value= 9 >Notifications</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="privilege2" value= 10 >Events</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="privilege3" value = 11 >Users</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" id="addadmin" class="btn btn-primary pull-right m-10">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="profile">

                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>User Name</th>


                                    </tr>
                                </thead>
                                <tbody id="viewadmin">

                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane" id="messages">
                            <div class="row p-10">
                                <form id="privilege" method="POST">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <select class="form-control h-50" id="username" name="admin_id">
                                                <option value="">Select User Name</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control h-50" name="privilege_id">
                                                <option value="">Select Privilege</option>
                                                <option value=9>Notifications</option>
                                                <option value=10>Events</option>
                                                <option value=11>Users</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="submit" id="admin_privilege" class="btn btn-primary pull-right m-10">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</section>
<script src="<?= base_url(); ?>assets/js/jquery-2.1.4.min.js"></script> 
<script>
    $(document).ready(function () {

        $('#addadmin').click(function () {
            $('#admin').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var formData = {
                    type: form.attr('method'),
                    data: form.serialize()
                };
                addSubAdmin(formData, function (response) {
                    var redirectUrl = baseUrl.websiteServer.concat(page.admin.addAdmin);
                    location.href = redirectUrl;
                });
            });
        });
        getAllAdmin(function (response) {
            console.log(response);
            if (response.message === "Total Admins") {
                if (response.data.length > 0) {
                    $.each(response.data, function (index, name) {
                        $("#username").append($("<option></option>").val(name['id']).html(name['username']));
                    });
                    for (var i = 0; i < response.data.length; i++) {
                        var username = response.data[i]['username'];
                        divItems =
                                " <tr data-toggle='collapse'>" +
                                "<td>" + username + "</td>" +
                                "</tr>";
                        $('#viewadmin').append(divItems);
                    }
                }
            }
        });
        $('#admin_privilege').click(function () {
            $('#privilege').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var formData = {
                    type: form.attr('method'),
                    data: form.serialize()
                };
                addPrivilege(formData, function (response) {
                    console.log(response.message);
                });
            });
        });
    });
</script>