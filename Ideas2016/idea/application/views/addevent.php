<section>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10" style="background-color: rgba(255,255,255,0.9); ">
                <div class="p-10">

                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active" style="background:none;"><a data-target="#22-Nov-2016"name="22-Nov-2016" data-toggle="tab">22-Nov-2016</a></li>
                        <li><a data-target="#23-Nov-2016" name="23-Nov-2016" data-toggle="tab">23-Nov-2016</a></li>
                        <li><a data-target="#24-Nov-2016" name="24-Nov-2016" data-toggle="tab">24-Nov-2016</a></li>
                        <li><a data-target="#25-Nov-2016" name="25-Nov-2016"data-toggle="tab">25-Nov-2016</a></li>
                        <li class="pull-right"><a data-target="#regUser" name="regUser"data-toggle="tab">Registered Users</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="22-Nov-2016"> 
                            <div id="event"></div>
                            <button type="button" class="btn btn-primary btn-danger pull-right m-10" data-toggle="modal" data-target="#myModal" data-whatever="22-Nov-2016">Add Events</button>
                        </div>
                        <div class="tab-pane" id="23-Nov-2016">
                            <div id="event2"></div>
                            <button type="button" class="btn btn-primary btn-danger pull-right m-10" data-toggle="modal" data-target="#myModal" data-whatever="23-Nov-2016">Add Events</button>
                        </div>
                        <div class="tab-pane" id="24-Nov-2016">
                            <div id="event3"></div>
                            <button type="button" class="btn btn-primary btn-danger pull-right m-10" data-toggle="modal" data-target="#myModal" data-whatever="24-Nov-2016">Add Events</button>
                        </div>
                        <div class="tab-pane" id="25-Nov-2016">
                            <div id="event4"></div>
                            <button type="button" class="btn btn-primary btn-danger pull-right m-10" data-toggle="modal" data-target="#myModal" data-whatever="25-Nov-2016">Add Events</button>
                        </div>
                        <div class="tab-pane" id="regUser">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>EVENT NAME</th>
                                        <th>START TIME</th>
                                        <th>END TIME</th>
                                        <th>VENUE</th>
                                    </tr>
                                </thead>
                                <tbody id="user">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>            

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Event</h4>
                </div>
                <div class="modal-body">
                    <form id="notify" method="POST">
                        <div class="row p-10">
                            <div class="col-md-12 hidden">
                                <div class="form-group">
                                    <input type="text" class="form-control h-50" name="date" id="date">
                                </div>
                            </div>
                            <div class="col-md-12 hidden">
                                <div class="form-group">
                                    <input type="text" class="form-control h-50" name="id" id="id">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control h-50" id="topic" name="topic" placeholder="Event Name" required="required">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control h-50" id="start_time" name="start_time" placeholder="Start Time" required="required">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control h-50" id="end_time" name="end_time" placeholder="End Time" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control h-50" id="venue" name="venue" placeholder="Event Venue" required="required">
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="checkbox pull-left p-10 m-10">
                                    <label><input type="checkbox" name="is_conference" id="is_conference" value = 1 >Enable Registration</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default"  id="addEvent">Add</button>
                            <button type="submit" class="btn btn-primary"  id="updateEvent">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancel">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        $('#updateEvent').hide();
        viewEvent(function (response) {
            if (response.message === "all events") {
                if (response.data.length > 0) {
                    for (var i = 0; i < response.data.length; i++) {
                        if (response.data[i]['date'] === "22-Nov-2016") {
                            var id = response.data[i]['event_id'];
                            var event = response.data[i]['topic'];
                            var start_time = response.data[i]['start_time'];
                            var end_time = response.data[i]['end_time'];
                            var venue = response.data[i]['venue'];
                            var is_conference = response.data[i]['is_conference'];
                            if (is_conference === null) {
                                is_conference = "No";
                            } else {
                                is_conference = "Yes";
                            }
                            divItems =
                                    "<div class='col-md-12 m-5' style='border-radius: 10px; background-color: rgba(74, 122, 188, 0.25);'>" +
                                    "<div class='col-md-3'><div class='form-group'> <label class='lab'>" + event + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label class='lab'>" + start_time + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label class='lab'>" + end_time + "</label></div></div>" +
                                    "<div class='col-md-3'><div class='form-group'> <label class='lab'>" + venue + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label class='lab'>" + is_conference + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <button type='button' class='btn btn-danger m-10 deleteEvent' value='" + id + "'>Delete</button></div></div>" +
//                                    "<div class='col-md-1'><div class='form-group'> <button type='button' class='btn btn-primary m-10'>Edit</button></div></div>" +
                                    "<button type='button' class='btn btn-primary pull-right m-10 editEvent' data-toggle='modal' data-target='#myModal' data-whatever='22-Nov-2016' value='" + id + "'>Edit Events</button>" +
                                    "</div>";
                            $('#event').append(divItems);
                        }
                        if (response.data[i]['date'] === "23-Nov-2016") {
                            var id = response.data[i]['event_id'];
                            var event = response.data[i]['topic'];
                            var start_time = response.data[i]['start_time'];
                            var end_time = response.data[i]['end_time'];
                            var venue = response.data[i]['venue'];
                            var is_conference = response.data[i]['is_conference'];
                            if (is_conference === null) {
                                is_conference = "No";
                            } else {
                                is_conference = "Yes";
                            }
                            divItems =
                                    "<div class='col-md-12 m-5' style='border-radius: 10px; background-color: rgba(74, 122, 188, 0.25);'>" +
                                    "<div class='col-md-3'><div class='form-group'> <label>" + event + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + start_time + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + end_time + "</label></div></div>" +
                                    "<div class='col-md-3'><div class='form-group'> <label>" + venue + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + is_conference + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <button type='button' class='btn btn-danger m-10 deleteEvent' value='" + id + "'>Delete</button></div></div>" +
                                    "<button type='button' class='btn btn-primary pull-right m-10 editEvent' data-toggle='modal' data-target='#myModal' data-whatever='23-Nov-2016' value='" + id + "'>Edit Events</button>" +
                                    "</div>";
                            $('#event2').append(divItems);
                        }
                        if (response.data[i]['date'] === "24-Nov-2016") {
                            var id = response.data[i]['event_id'];
                            var event = response.data[i]['topic'];
                            var start_time = response.data[i]['start_time'];
                            var end_time = response.data[i]['end_time'];
                            var venue = response.data[i]['venue'];
                            var is_conference = response.data[i]['is_conference'];
                            if (is_conference === null) {
                                is_conference = "No";
                            } else {
                                is_conference = "Yes";
                            }
                            divItems =
                                    "<div class='col-md-12 m-5' style='border-radius: 10px; background-color: rgba(74, 122, 188, 0.25);'>" +
                                    "<div class='col-md-3'><div class='form-group'> <label>" + event + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + start_time + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + end_time + "</label></div></div>" +
                                    "<div class='col-md-3'><div class='form-group'> <label>" + venue + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + is_conference + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <button type='button' class='btn btn-danger m-10 deleteEvent' value='" + id + "'>Delete</button></div></div>" +
                                    "<button type='button' class='btn btn-primary pull-right m-10 editEvent' data-toggle='modal' data-target='#myModal' data-whatever='24-Nov-2016' value='" + id + "'>Edit Events</button>" +
                                    "</div>";
                            $('#event3').append(divItems);
                        }
                        if (response.data[i]['date'] === "25-Nov-2016") {
                            var id = response.data[i]['event_id'];
                            var event = response.data[i]['topic'];
                            var start_time = response.data[i]['start_time'];
                            var end_time = response.data[i]['end_time'];
                            var venue = response.data[i]['venue'];
                            var is_conference = response.data[i]['is_conference'];
                            if (is_conference === null) {
                                is_conference = "No";
                            } else {
                                is_conference = "Yes";
                            }
                            divItems =
                                    "<div class='col-md-12 m-5' style='border-radius: 10px; background-color: rgba(74, 122, 188, 0.25);'>" +
                                    "<div class='col-md-3'><div class='form-group'> <label>" + event + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + start_time + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + end_time + "</label></div></div>" +
                                    "<div class='col-md-3'><div class='form-group'> <label>" + venue + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <label>" + is_conference + "</label></div></div>" +
                                    "<div class='col-md-1'><div class='form-group'> <button type='button' class='btn btn-danger m-10 deleteEvent' value='" + id + "'>Delete</button></div></div>" +
                                    "<button type='button' class='btn btn-primary pull-right m-10 editEvent' data-toggle='modal' data-target='#myModal' data-whatever='25-Nov-2016' value='" + id + "'>Edit Events</button>" +
                                    "</div>";
                            $('#event4').append(divItems);
                        }
                    }
                }
            }
            $('.deleteEvent').click(function () {
                console.log($(this).val());
                var formData = {
                    type: "POST",
                    data: "id=" + $(this).val()
                };
                deleteEvent(formData, function (response) {
                    if (response.message === "event deleted") {
                        var redirectUrl = baseUrl.websiteServer.concat(page.admin.addevent);
                        location.href = redirectUrl;
                    }
                });
            });
            $('#cancel').click(function () {
                $('#updateEvent').hide();
                $('#addEvent').show();
                $(this).closest('form').find("input[type=text], textarea, checkbox").val("");
            });
            $('.editEvent').click(function () {
                $('#addEvent').hide();
                $('#updateEvent').show();
                var formData = {
                    type: "POST",
                    data: "id=" + $(this).val()
                };
                getEventById(formData, function (response) {
                    console.log(response);
                    if (response.message === "event by id") {
                        $.each(response.data, function (index, value) {
                            $("#id").val((value['id'] !== null) ? value['id'] : "-");
                            $("#date").val((value['date'] !== null) ? value['date'] : "-");
                            $("#topic").val((value['topic'] !== null) ? value['topic'] : "-");
                            $("#start_time").val((value['start_time'] !== null) ? value['start_time'] : "-");
                            $("#end_time").val((value['end_time'] !== null) ? value['end_time'] : "-");
                            $("#venue").val((value['venue'] !== null) ? value['venue'] : "-");
                            if (value['is_conference'] === '1')
                                $("#is_conference").prop("checked", true);
                        });
                        $('#updateEvent').click(function () {
                            $('#notify').submit(function (e) {
                                e.preventDefault();
                                var form = $(this);
                                var formData = {
                                    type: form.attr('method'),
                                    data: form.serialize()
                                };
                                editEvent(formData, function (response) {
                                    if (response.message === "event updated") {
                                        alert("Event updtaed");
                                        var redirectUrl = baseUrl.websiteServer.concat(page.admin.addevent);
                                        location.href = redirectUrl;
                                    }
                                });
                            });
                        });
                    }
                });
            });
        });
//        $('.deleteEvent').click(function () {
////            $('#notify').submit(function (e) {
////                e.preventDefault();
//                var form = $(this);
//                var formData = {
//                    type: form.attr('method'),
//                    data: form.val();
//                };
//                console.log(formData);
        regUsers(function (response) {
            if (response.message === "registered events") {
                console.log(response);
                if (response.data.length > 0) {
                    for (var i = 0; i < response.data.length; i++) {
                        
//                        for(var i = 0; i <){}
//                        var event_name = response.data[i]['topic'];
//                        var starttime = response.data[i]['start_time'];
//                        var endtime = response.data[i]['end_time'];
//                        var venue = response.data[i]['venue'];
//                        var email = response.data[i]['user_name'];
//                        var is_active = response.data[i]['is_active'];
//                        var designation = response.data[i]['designation'];
//                        var uemail = response.data[i]['user_name'];
//                        var type = response.data[i]['user_type'];
//                        var country = response.data[i]['country'];
//                        var business = response.data[i]['buisness'];
//                        var cname = response.data[i]['company_name'];
//                        var cemail = response.data[i]['company_email'];
//                        var cphone = response.data[i]['company_phone'];
//                        var caddress = response.data[i]['company_address'];
//                        var website = response.data[i]['company_website'];
//                        var accordian = "acc" + i;
                        divItems =
                                " <tr data-toggle='collapse' data-target='#" + accordian + "' class='clickable' >" +
                                "<td>" + event_name + "</td>" +
                                "<td>" + starttime + "</td>" +
                                "<td>" + endtime + "</td>" +
                                "<td>" + venue + "</td>" +
                                "</tr>" +
                                "<tr>" +
                                "<td colspan='4' style='border-top:0px;'>" +
                                "<div id='" + accordian + "' class='collapse'><div class='well well-lg'>" +
                                "<div class='row'>" +
                                "<div class='col-md-6'>" +
                                "<ul style='list-style: none;'>" +
                                "<li><label>Designation :</label>" + designation + "</li>" +
                                " <li><label>Email Address : </label>" + uemail + "</li>" +
                                "<li><label>Type : </label>" + type + "</li>" +
                                "<li><label>Country : </label>" + country + "</li>" +
                                "</ul>" +
                                "</div>" +
                                "<div class='col-md-6'>" +
                                "<ul style='list-style: none;'>" +
                                "<li><label>Buisness : </label>" + business + "</li>" +
                                "<li><label>Company Name : </label>" + cname + "</li>" +
                                "<li><label>Company Email : </label>" + cemail + "</li>" +
                                "<li><label>Company Phone : </label>" + cphone + "" +
                                "<li><label>Company Address : </label>" + caddress + "</li>" +
                                "<li><label>Company Website : </label>" + website + "</li>" +
                                "</ul>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</td>" +
                                "</tr>";
                        $('#user').append(divItems);
                    }
                }
            }
        });
////            });
//        });
        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var date = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-body #date').val(date);
        });
        $('#addEvent').click(function () {
            $('#notify').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var formData = {
                    type: form.attr('method'),
                    data: form.serialize()
                };
                addEvents(formData, function (response) {
                    if (response.message === "event added") {
                        alert("Event Added");
                        var redirectUrl = baseUrl.websiteServer.concat(page.admin.addevent);
                        location.href = redirectUrl;
                    }
                });
            });
        });
    }
    );
</script>