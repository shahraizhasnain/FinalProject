<section>
    <div class="container">  
        <div class="row">
            <div class="col-md-offset-1 col-md-10" style="background-color: rgba(255,255,255,0.9)">
                <div class="p-10">

                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active" style="background:none;"><a data-target="#home" data-toggle="tab">Add Notifications</a></li>
                        <li><a data-target="#profile" data-toggle="tab">View Notification</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <form id="notify" method="POST">
                                <div class="row p-20">
                                    <div class="col-md-12">
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="foreignDelegate" value= 1 >Foreign Delegate</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="localDelegate" value= 1 >Local Delegate</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="trade" value = 1 >Trade Vistor</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="exhibitor" value = 1 >Exhibitor</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="functionary" value = 1 >Functionary</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="eventManager" value = 1 >Event Manager</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="organizer" value = 1 >Organizer</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="security" value = 1 >Security</label>
                                        </div>
                                        <div class="checkbox pull-left p-10 m-10">
                                            <label><input type="checkbox" name="guestVisitor" value = 1 >Guest Visitor</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control h-50" name="title" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" cols="5" rows="5" name="notification" placeholder="Notification"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-danger h-50" type="submit" id="push">Notify</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="profile">

                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Notifications</th>

                                    </tr>
                                </thead>
                                <tbody id="notification">

                                </tbody>
                            </table>

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

        $('#push').click(function () {
            $('#notify').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var formData = {
                    type: form.attr('method'),
                    data: form.serialize()
                };
                pushNotification(formData, function (response) {
                    if (response.message === "Notification send successfuly") {
                        alert("Notification Send");
                        var redirectUrl = baseUrl.websiteServer.concat(page.admin.notification);
                        location.href = redirectUrl;
                    }
                });
            });
        });

        viewNotification(function (response) {
            if (response.message === "all notifications") {
                if (response.data.length > 0) {
                    for (var i = 0; i < response.data.length; i++) {
                        var title = response.data[i]['title'];
                        var notification = response.data[i]['notification'];
                        console.log(notification);
                        divItems =
                                " <tr data-toggle='collapse'>" +
                                "<td>" + title + "</td>" +
                                "<td>" + notification + "</td>" +
                                "</tr>";
                        $('#notification').append(divItems);
                    }
                }
            }
        });
    });
</script>

</script>