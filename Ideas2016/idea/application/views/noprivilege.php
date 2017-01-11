<section>
    <div class="container bg">

        <div class="row" style="margin-top:50px;">
            <div class="row" style="max-width:100%;padding-top:120px;">
                <div class="col-md-offset-4 col-md-4" style="background-color: rgba(255,255,255,0.5);">
                    <div class="login-panel">
                        <div class="login-head">
                            <div class="row">
                                <div class="col-md-12" style="text-align:center;">
                                    <img src="<?= base_url(); ?>assets/images/ideas_logo.png" style="width: 40%;padding:10px;">
                                </div>
                            </div>
                            <div class="row p-20 text-center">
                                <div class="form-group">
                                    <h2 class="text-gray">UNPRIVILEGED USER</h2>
                                    <h4>You are not allowed to enter contact super admin</h4>
                                </div>
                                <div class="row mb-20">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                </div>
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

//        $('#login1').click(function () {
//            $('#loginform').submit(function (e) {
//                e.preventDefault();
//                var form = $(this);
//                var formData = {
//                    type: form.attr('method'),
//                    data: form.serialize()
//                };
//                loginAdmin(function (response) {
//
//                });
//            });
//        });

        $('#login1').click(function () {
            $('#loginform').submit(function (event) {
                event.preventDefault();
                var form = $(this);
                var formData = {
                    type: form.attr('method'),
                    data: form.serialize()
                };
                loginUser(formData, function (loginResp) {
                    if (loginResp.message === "user login successfully") {
                        console.log("user login successfully");
//                      redirect to dashboard page now
                        var redirectUrl = baseUrl.websiteServer.concat(page.admin.notification);
                        location.href = redirectUrl;
                    } else {
                        console.log(loginResp.message);
                    }
                });
            });


        });



    });
</script>