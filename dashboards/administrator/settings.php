<?php 
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Settings');?>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side();?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <h5>Platform Maintenance</h5>
                            <hr>
                            <div class="tabs">
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-bell"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5>
                                            <strong>
                                                Password 
                                            </strong>
                                        </h5>
                                        <p>Alter Password.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="settings_password"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5>
                                            <strong>
                                                Team
                                            </strong>
                                        </h5>
                                        <p>People on your projects.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="network"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-clock"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5>
                                            <strong>User Profile</strong>
                                        </h5>
                                        <p>Preview Your Profile.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="settings_timeline"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-clock"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5>
                                            <strong>Activities</strong>
                                        </h5>
                                        <p>My Activities.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="activities"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                            </div>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
</body>
</html>

