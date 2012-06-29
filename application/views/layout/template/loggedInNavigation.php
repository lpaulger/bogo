<?php
    $current = $this->uri->segment(1);
    $dashboard = $deals = $home = "";
    switch($current){
        case "dashboard": 
            $dashboard = "class='active'";
            break;
        case "deals": 
        case "vendors": 
            $deals = "active";
            break;
        default:
            $home = "class='active'";
    }     
?>
<ul class="nav">
    <li <?php echo $home;?>>
        <a href="/">Home</a>
    </li>
    <li <?php echo $dashboard;?>>
        <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
    </li>
    <li class="dropdown <?php echo $deals;?>">
        <a href="#"class="dropdown-toggle"data-toggle="dropdown">
            Deals <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo site_url('deals'); ?>">View Deals</a>
            </li>
            <li>
                <a href="<?php echo site_url('vendors'); ?>">View Vendors</a>
            </li>
        </ul>
    </li>
</ul>
<ul class="nav pull-right">
    <li class="divider-vertical"></li>
    <li class="dropdown">
        <a href="#"class="dropdown-toggle"data-toggle="dropdown">
            <?php echo $session['username']; ?><b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo site_url('signout'); ?>">Sign-Out</a>
                <a href="#">Profile</a>
            </li>
        </ul>
    </li>
    <li class="divider-vertical"></li>
</ul>