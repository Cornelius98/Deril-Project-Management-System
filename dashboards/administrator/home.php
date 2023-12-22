<?php 
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
$current_user = $_SESSION["aSessn"]["aSeck"];
$projectGraph = $GraphSimulator->projectGraphCoords($current_user);
$barGraph = $GraphSimulator->barGraphCoords($current_user);
$pieChart = $GraphSimulator->pieChart($current_user);
$notifications = $ProductPull->notifications($current_user);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Home');?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side($notifications);?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <hr>
                            <a href="activities" class="btn btn-dark btn-sm">Account Loggs</a>
                            <a href="network" class="btn btn-dark btn-sm">Projects' Team</a>
                            <a href="invited" class="btn btn-dark btn-sm">Invitations</a>

                            <div class="tabs">
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Create</strong></h5>
                                        <p>Start a new project.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="create"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-briefcase"></i>
                                            <span class="notice-slider">
                                                <?php echo $notifications["projects"]; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Projects</strong></h5>
                                        <p>Browse Created projects.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="projects"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-bell"></i>
                                            <span class="notice-slider">
                                                <?php echo $notifications["notifications"]; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Notifications</strong></h5>
                                        <p>Notifications On Your Account.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="notifications"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-users"></i>
                                            <span class="notice-slider">
                                                <?php echo $notifications["discussions"]; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Discussions</strong></h5>
                                        <p>Follow Discussions.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="discussed"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                            </div>
                            <div>
                                <section class="project-graphs">
                                    <canvas class="graph-1" id="graph-1"></canvas>
                                    <canvas class="graph-2" id="graph-2"></canvas>
                                </section>
                            </div>
                            <div>
                                <?php $UserErrorsPool->error("err_gallery_key","Gallery Requested To Display Is Not Recognized");?>
                                <?php $UserErrorsPool->error("err_pjr_key","Project Requested To Display Is Not Recognized");?>
                                <?php $UserErrorsPool->error("err_pjr_int","Project Id is not interger");?>
                                <?php $UserErrorsPool->error("err_pjr","Project Identifier Is Not Set");?>
                                <?php $UserErrorsPool->error("err_pipe","Project Creator Is Not Found");?>
                                <?php $UserErrorsPool->error("err_pjr_empty","Project Container Not Found");?>
                                <?php $UserErrorsPool->error("err_empty_rinvite","Invitations Not Found");?>
                            </div>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
        var barTaggs = ["Photos", "PDFs", "Videos"];
        var barValues = [
                        <?php echo json_encode($barGraph["barPictures"]);?>,
                        <?php echo json_encode($barGraph["barDocuments"]);?>,
                        <?php echo json_encode($barGraph["barFiles"]);?>
                    ];
        var barColors = ["skyblue", "lightblue","darkblue"];

        new Chart("graph-2", {
            type: "bar",
            data:{
                labels: barTaggs,
                datasets: [{
                backgroundColor: barColors,
                data: barValues
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                title: {
                    display: true, text: 'Uploaded Files Charts'
                }
            }
        });

        const xLabels = <?php echo json_encode($projectGraph["discussionCoords"]); ?>;
        new Chart("graph-1", {
        type: "line",
        data: {
            labels: xLabels,
            scaleFontColor: "#FFFFFF",
            datasets: [{
                data: <?php echo json_encode($projectGraph["projectCoords"]); ?>,
                borderColor: "white",
                label: "Projects",
                fill: false
            },
            {
                data: <?php echo json_encode($projectGraph["discussionCoords"]); ?>,
                borderColor: "seagreen",
                label: "Discussions",
                fill: false
            }]
        },
        options: {
            legend: {
                display: true,
                color: "white"
            },
            scales: {
                    xAxes: [{
                            display: true,
                            ticks: {
                                
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Time'
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                                max: 30,
                                stepSize: 1
                            }
                        }]
                }
        }
        });
    </script>
</body>
</html>

