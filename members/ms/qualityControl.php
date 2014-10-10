<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
    <?php include "../../config.php";?>
    <?php include ROOT_DIR."/header.html";?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script src="/majorlab/js/d3.min.js"></script>
    <script src="/majorlab/js/dc.min.js"></script>
    <script src="/majorlab/js/crossfilter.min.js"></script>
     <title>Major Lab - MS Quality Control</title>
   </head>
   <body>
      <div id="wrap">
         <?php include ROOT_DIR."/navbar.html";?>

         <div id="stripe2">

            <div id="str2">
               <div class="innerdiv">
                  <div class="pageHeader">
                    <h1>Mass Spectrometry Quality Control</h1>
                  </div>

                  <div class="content">
                     <div id="row-chart-1"></div>
                     <div id="box-chart-1"></div>
                  </div>
               </div>
            </div>
         </div>
       </div>
   <?php include ROOT_DIR."/footer.html";?>
   <script type="text/javascript" src="/majorlab/js/qualityControl.js"></script>
   </body>
</html>
