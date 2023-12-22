<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Start Project');?>
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
                        <section class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <h4>CREATE PROJECT</h4>
                            <hr>
                            <div class="form-wrap">
                                <div class="error-display"></div>
                                <form>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Naming Project</label>
                                        <div class="form-group-even">
                                            <input type="text" name="name" id="name" placeholder="Project Name" />
                                            <input type="text" name="tname" id="tname" placeholder="Project Technical Name" />
                                            <input type="text" name="desc" id="desc" placeholder="Project Description"/>
                                            <input type="text" name="summary" id="summary" placeholder="Project Summary"/>
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section"> Start Date, Halfway Date, Finish Dates, And Total Duration</label>
                                        <div class="form-group-even">
                                        <input type="date" name="sdate" id="sdate" />
                                        <input type="date" name="mdate" id="mdate" />
                                        <input type="date" name="cdate" id="cdate" />
                                        <input type="text" name="duration" id="duration" placeholder="Timeframe" />
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Supervisors</label>
                                        <div class="form-group-even">
                                            <input type="text" name="director" id="director" placeholder="Project Director" />
                                            <input type="text"name="manager" id="manager" placeholder="Project Manager"/>
                                            <input type="text" name="supervisor" id="supervisor" placeholder="Project Supervisor"/>
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Photos, PDFs And Files</label>
                                        <div class="song-files">
                                            <div class="sub-form-group">
                                                    <label for="pictures" class="cover">
                                                        <i class="fa fa-image fa-3x"></i><br>
                                                        Project Pictures
                                                    </label>
                                                    <input type="file" 
                                                            id="pictures" 
                                                            class="form-control" 
                                                            name="pictures"
                                                            accept="image/png, image/jpeg, image/jpg, image/jfif, image/gif"
                                                            multiple/>
                                            </div>
                                            <div class="sub-form-group">
                                                <label for="documents" class="artwork">
                                                    <i class="fa fa-image fa-3x"></i><br>
                                                    PDFs
                                                </label>
                                                <input type="file" 
                                                        id="documents" 
                                                        class="form-control" 
                                                        name="documents"
                                                        accept=".pdf,.docx,.doc,.txt"
                                                        multiple
                                                        />
                                            </div>
                                            <div class="sub-form-group">
                                                <label for="files" class="artwork">
                                                    <i class="fa fa-image fa-3x"></i><br>
                                                    Files
                                                </label>
                                                <input type="file" 
                                                        id="files" 
                                                        class="form-control" 
                                                        name="files"
                                                        accept=".mp3,.mp4,.wav,.ogg,.mpeg,.3gp"
                                                        multiple
                                                        />
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" 
                                                    class="btn btn-dark 
                                                            btn-sm 
                                                            submit-btn 
                                                            form-control"
                                                    id="migrateAdd">
                                                    <strong>START PROJECT</strong> 
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <?php $AdminiUXTemplate->spinAnime();?>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
        function processFilesFromForms(formData,input,fileSave,err){
            let artwork = document.getElementById(input),
                    artworkFileList = artwork.files,
                    artworkListLength = artworkFileList.length
                    i = 0;
                    if(artworkListLength > 0){
                        while(i<=artworkListLength){
                            formData.append(fileSave,artworkFileList[i]);
                            i++;
                        }
                    }else $(".error-display").html('<div class="e-notice">'+err+'</div>');
        }
        function errorDisplayAssistant(errCode,errFlaggs){
            if((errCode==404)||(errCode==505)){
                (".error-display").html('<div class="e-notice">'+errFlaggs+'</div>');
            }
        }
        $("#migrateAdd").click(function(evt){
            evt.preventDefault();
            let formData = new FormData(),
                name = ($("#name").val()!="")?$("#name").val():$(".error-display").html('<div class="e-notice">Enter Project Name</div>'),
                tname = ($("#tname").val()!="")?$("#tname").val():$(".error-display").html('<div class="e-notice">Enter Project Technical Name</div>'),
                desc = ($("#desc").val()!="")?$("#desc").val():0,
                summary = ($("#summary").val()!="")?$("#summary").val():0,
                sdate = ($("#sdate").val()!="")?$("#sdate").val():0,
                mdate = ($("#mdate").val()!="")?$("#mdate").val():0,
                cdate = ($("#cdate").val()!="")?$("#cdate").val():0,
                duration = ($("#duration").val()!="")?$("#duration").val():0,
                director = ($("#director").val()!="")?$("#director").val():0,
                manager = ($("#manager").val()!="")?$("#manager").val():0,
                supervisor = ($("#supervisor").val()!="")?$("#supervisor").val():0;

                formData.append("name",name);
                formData.append("tname",tname);
                formData.append("desc",desc);
                formData.append("summary",summary);
                formData.append("sdate",sdate);
                formData.append("mdate",mdate);
                formData.append("cdate",cdate);
                formData.append("duration",duration);
                formData.append("director",director);
                formData.append("manager",manager);
                formData.append("supervisor",supervisor);
              
                let pictures = document.getElementById("pictures"),
                picturesFileList = pictures.files,
                picturesListLength = picturesFileList.length,
                j = 0;
                if(picturesListLength > 0){
                    while(j<=picturesListLength){
                        formData.append("pictures[]",picturesFileList[j]);
                        j++;
                    }
                }

                let documents = document.getElementById("documents"),
                documentsFileList = documents.files,
                documentsListLength = documentsFileList.length,
                i = 0;
                if(documentsListLength > 0){
                    while(i<=documentsListLength){
                        formData.append("documents[]",documentsFileList[i]);
                        i++;
                    }
                }

                let filesa = document.getElementById("files"),
                filesaFileList = filesa.files,
                filesaListLength = filesaFileList.length,
                q = 0;
                if(filesaListLength > 0){
                    while(q<=filesaListLength){
                        formData.append("filesa[]",filesaFileList[q]);
                        q++;
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: '../../middleware/admini/handleAdvert/mw_project_push',
                    processData: false,
                    contentType: false,
                    async: true,
                    data:formData,
                    beforeSend:function(){
                        $(".spin-wrap").css("display","flex");
                        $(".dash-full-wrapper").css("animation","waterWaveFade 2s infinite");
                    },
                    success:function(q,status,settings){
                        let s = JSON.parse(q);
                        scrollTo(0,0);
                        $(".spin-wrap").css("display","none");
                        $(".dash-full-wrapper").css("animation","none");
                        if(s["status"]==200){
                            $(".error-display").html('<div class="e-success">Project Created</div>');
                        }else $(".error-display").html('<div class="e-notice">Operation Failed, Try Again</div>');
                    }
                });
        });
    </script>
</body>
</html>
 