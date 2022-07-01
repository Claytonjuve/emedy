 <?php include_once('header-no-info.php'); ?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto my-auto">
            <div class="card">
                <div class="card-body px-lg-5 py-lg-5 text-center">
                    <img src="images/2fa.jpg" class="rounded-circle avatar-lg img-thumbnail mb-4" alt="profile-image">
                    <h2 class="text-success">2FA Security</h2>
                    <p class="mb-4">We have sent you a 6-digits code to your email account.</p>
                    <form action="process-data/2fa-process.php" method="POST">
                        <div class="row mb-4">
                            <div class="col-lg-2 col-md-2 col-2 ps-0 ps-md-2">
                                <input type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa" name="pin1" maxlength="1">
                            </div>
                            <div class="col-lg-2 col-md-2 col-2 ps-0 ps-md-2">
                                <input type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa" name="pin2" maxlength="1">
                            </div>
                            <div class="col-lg-2 col-md-2 col-2 ps-0 ps-md-2">
                                <input type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa" name="pin3" maxlength="1">
                            </div>
                            <div class="col-lg-2 col-md-2 col-2 pe-0 pe-md-2">
                                <input type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa" name="pin4" maxlength="1">
                            </div>
                            <div class="col-lg-2 col-md-2 col-2 pe-0 pe-md-2">
                                <input type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa" name="pin5" maxlength="1">
                            </div>
                            <div class="col-lg-2 col-md-2 col-2 pe-0 pe-md-2">
                                <input type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa" name="pin6" maxlength="1">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-success btn-lg my-4">Continue</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <?php include_once('footer.php'); ?>