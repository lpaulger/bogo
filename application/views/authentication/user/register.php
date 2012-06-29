<!-- welcome -->
<div class="row">
    <?php echo validation_errors(); ?>
    <form method="post" action="<?php echo site_url('signup') ?>" class="form-horizontal well">
        <fieldset>
            <legend>Sign up for an account now!</legend>

            <div class="control-group">
                <label for="username" >Desired Username</label>
                <input type="text" id="username" name="username" class="span3" placeholder="Username..."/>
            </div>

            <div class="control-group">
                <label>Choose a password</label>
                <input type="password" id="password" name="password" class="span3" placeholder="Password..."/>
            </div>

            <div class="control-group">
                <label>Confirm Password</label>
                <input type="password" id="passwordConfirm" name="passwordConfirm" class="span3" placeholder="Confirm Password..."/>
            </div>

            <div class="control-group">
                <label>First name</label>
                <input type="text" id="firstName" name="firstName" class="span3" placeholder="First name..."/>
            </div>

            <div class="control-group">
                <label>Last name</label>
                <input type="text" id="lastName" name="lastName" class="span3" placeholder="Last Name..."/>
            </div>
            
            <div class="control-group">
                <label>Email</label>
                <input type="text" id="email" name="email" class="span3" placeholder="Email..."/>
            </div>

            <div class="control-group">
                <label>State name</label>
                <input placeholder="State..." type="text" id="state" name="state" class="span3" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Alabama&quot;,&quot;Alaska&quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;California&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]">
            </div>

            <div class="control-group">
                <label>City</label>
                <input type="text" id="city" name="city" class="span3" placeholder="City..."/>
            </div>



        </fieldset>
        <div class="control-group">
            <button type="submit" class="btn">Submit</button>
        </div>
    </form>
</div>
<!-- end row -->
