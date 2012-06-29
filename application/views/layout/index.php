<?php
    $nav['session'] = $session = $this->session->all_userdata();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $pageTitle; ?></title>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/supersized.core.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">

        <script type="text/javascript" src="/assets/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="/assets/font/cufon-yui.js"></script>
        <script type="text/javascript" src="/assets/font/Exo-Regular_400-Exo-Regular_700-Exo-Regular_italic_400-Exo-Regular_italic_700.font.js"></script>
        <script type="text/javascript" src="/assets/js/jquery.masonry.min.js"></script>
        <!--<script type='text/javascript' src='/assets/js/supersized.core.3.2.1.min.js'></script>
        <script type='text/javascript' src='/assets/js/loggedOut.js'></script>-->

        <script type="text/javascript" src="/assets/js/starter.js"></script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="/" class="brand">Karrrma</a>

                    <?php
                    if (isset($session['logged_in'])) {
                        $this->load->view('layout/template/loggedInNavigation',$nav);
                    } else {
                        $this->load->view('layout/template/loggedOutNavigation');
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        if (isset($data['exception'])) {
            $this->load->view('layout/template/exception', $data['exception']);
        }
        ?>
        <div class="container-fluid">
            <?php
            $this->load->view($viewLocation, $data);
            ?>
        </div><!-- /container -->
        <div class="footerContainer">
            <footer>
                <p>&copy; Karrrma 2012</p>
            </footer>
        </div>
    </body>
</html>