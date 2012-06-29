<!-- user/Sigin -->
<div class="row">
    <?php echo validation_errors(); ?>
        <div id="signinFormBackground" class="span">

            <div class="row" id="signinRow">

                <div class="span4 well" id="signinFormAside">
                    <div class="message"> <b>karma</b>
                        allows you to exchange <b>good deeds</b>
                        for
                        <b>great discounts</b>
                        on the items and services you
                        <span style="color:red; font-weight:bold;">love</span>
                        .
                        <h4>Free. Simple. Smart.</h4>

                        <div class="control-group">
                            <button type="button" class="btn btn-primary signupButton"> <i class="icon-heart icon-white"></i>
                                Sign Up
                            </button>
                        </div>
                    </div>
                </div>

                <div id="signinFormContainer" class="well span4">
                    <form id="signinForm" method="post" action="<?php echo site_url('signin') ?>
                        " class="form-horizontal pull-left ">
                        <fieldset>
                            <legend>Member Sign In</legend>
                            <div class="control-group">
                                <label>Username</label>
                                <input type="text" id="username" name="username" class="span4" placeholder="Enter E-mail or Username..."/>
                            </div>

                            <div class="control-group">
                                <label>Password</label>
                                <input type="password" id="password" name="password" class="span4" placeholder="Password..."/>
                            </div>
                        </fieldset>
                        <div class="control-group">
                            <div class="row">
                                <button type="submit" class="btn btn-primary span2"> <i class="icon-user icon-white"></i>
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end row -->