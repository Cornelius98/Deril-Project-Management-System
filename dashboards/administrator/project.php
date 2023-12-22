<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
$adrSeck = null;
$params = null;
$o = null;
if(isset($_GET["pipe"]) && !empty($_GET["pipe"])){
    if($int = $NameSanitizer->is_whole_int($_GET["pipe"])){
        if($UserAccountPull->advertiser_exist($_GET["pipe"])){
            $adrSeck = $int;
            $o = $AdminiAccountPull->get_mirror_account_route_o($adrSeck);
            if(!is_array($o) || empty($o) || empty($o["adr_id"]))
                header("location:err_mirror_credentials");
            else {
                $params = 'pipe='.$_GET["pipe"].'&&pjr='.$_GET["pjr"];
                $ProductPush->view($_GET["pjr"],$_SESSION["aSessn"]["aSeck"]);
            }
        }else header("location:home?err_uthread_unexist");
    }else header("location:home?err_uthread_nn");
}else header("location:home?err_uthread_unset");

$projectContainer = $ProductPull->get_project($_GET["pjr"]);
$projectGraph = $GraphSimulator->projectGraphCoordsPjctAlone($_GET["pjr"]);
$barGraph = $GraphSimulator->barGraphCoordsAlone($_GET["pjr"]);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Project Review');?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
                            <hr>
                            <a href="progress?<?php echo $params;?>" class="btn btn-dark btn-sm"> Record Progress</a>
                            <div>
                                <div class="form-grouped">
                                    <label for="form-section" class="form-section">Resources</label>
                                    <div class="">
                                        <a href="gallery?<?php echo $params.'&&gallery=1';?>" class="sub-form-group">
                                                <label for="pictures" class="cover">
                                                    Photos
                                                </label>
                                        </a>
                                        <a href="gallery?<?php echo $params.'&&gallery=2';?>" class="sub-form-group">
                                            <label for="documents" class="artwork">
                                                PDFs
                                            </label>
                                        </a>
                                        <a href="gallery?<?php echo $params.'&&gallery=3';?>" class="sub-form-group">
                                            <label for="files" class="artwork">
                                                Files
                                            </label>
                                        </a>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <?php 
                                if(is_array($projectContainer) && !empty($projectContainer)){
                                    echo '<div class="ads-section">
                                                <div class="ads-desc" id="personal">
                                                    <h5>Project</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Status:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["mute"]!=0)
                                                                        echo "Offline";
                                                                    else echo "Online";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Name(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["name"]!=0)
                                                                        echo $projectContainer["name"];
                                                                    else 
                                                                        echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Technical(s) Name:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["tname"]!=0)
                                                                        echo $projectContainer["tname"];
                                                                    else 
                                                                        echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="contact">
                                                    <h5>Description</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Description:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["desc"])
                                                                        echo $projectContainer["desc"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Summary:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["summary"])
                                                                        echo $projectContainer["summary"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Conclusion:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["conclusion"])
                                                                        echo $projectContainer["conclusion"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="billing">
                                                    <h5>Dates</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Start Date:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["sdate"])
                                                                        echo date("F,D Y",strtotime($projectContainer['sdate']));
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Midway Date:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["mdate"]!=0)
                                                                        echo date("F,D Y",strtotime($projectContainer['mdate']));
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Completion Date:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["cdate"]!=0)
                                                                        echo date("F,D Y",strtotime($projectContainer['mdate']));
                                                                    else echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Time Of Creation:</td>
                                                                <td  class="ads-prop-value">'.date("H:m A",strtotime($projectContainer['p_time'])).'</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Duration:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["duration"]!=0)
                                                                        echo $projectContainer["duration"];
                                                                    else echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="location">
                                                    <h5>Reports</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Report:</td>
                                                                <td  class="ads-prop-value"><a href="pdfGenerate?quarter=Third">Download</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div>
                                                <a href="invite?'.$params.'" class="sub-form-group">
                                                        <label for="pictures" class="cover">
                                                            INVITE TEAM
                                                        </label>
                                                </a>
                                                <a href="discuss?'.$params.'" class="sub-form-group">
                                                    <label for="documents" class="artwork">
                                                        Discussion Room
                                                    </label>
                                                </a>
                                                <a href="share?'.$params.'" class="sub-form-group">
                                                    <label for="files" class="artwork">
                                                        Share Project
                                                    </label>
                                                </a>
                                            </div>
                                            <br>
                                            <br>
                                        </div><br><br>';
                                }else{
                                    echo '<h5 class="err_products">
                                                <i class="fa fa-robot"></i>
                                                <br>
                                                Project Not Available
                                            </h5>';
                                }
                            ?>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
        var barTaggs = ["Pictures", "Docs", "Files"];
        var barValues = [<?php echo json_encode($barGraph["barPictures"]);?>,
                        <?php echo json_encode($barGraph["barDocuments"]);?>,
                        <?php echo json_encode($barGraph["barFiles"]);?>
                    ];
        var barColors = ["skyblue", "lightblue","darkblue"];
        new Chart("graph-2", {
            type: "bar",
            data: {
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
                    display: true, text: 'File Statistics'
                }
            }
        });
    </script>
</body>
</html>

 

