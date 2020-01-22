<?php
$title = 'Phone Numbers Extractor';
$output = $link = $outputs = "";
include_once "../resources/header.php";
if (isset($_POST['submit'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image

    if ($imageFileType != "txt" && $imageFileType != "vcf") {
        $output = "txt and vcf files are only allowed.";
        $uploadOk = 0;
        die();
    }
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $f = $target_file;
        $h = fopen($f, "r");
        if ($h) {
            $c = fread($h, filesize($f));
            $ex = explode("\r", $c);
            foreach ($ex as $k => $v) {
                $v1 = trim($v);
                $v1 = str_replace(" ", "", $v1);

                if (stripos($v1, 'TEL;CELL:') !== false) $v1 = strstr($v1, ':');
                else if (stripos($v1, 'TEL;WORK:') !== false) $v1 = strstr($v1, ':');
                else if (stripos($v1, 'TEL;HOME:') !== false) $v1 = strstr($v1, ':');
                else if (stripos($v1, 'TEL;VOICE:') !== false) $v1 = strstr($v1, ':');
                else if (empty($v1) || strstr($v1, "*555*") != false || strstr($v1, "E") != false || is_numeric($v1) === false || strlen($v1) < 8) continue;

                if (strlen($v1) == 11 && substr($v1, 0, 1) != "0") $v1 = "0" . $v1;
                if (strstr($v1, "+") === false) $v1 = "0" . substr($v1, -10);
                if (strlen($v1) > 10) $v1 = "0" . substr($v1, -10);
                if (stripos($v1, "#") !== false || stripos($v1, "*") !== false || stripos($v1, ":") !== false) continue;
                $outputs .= $v1 . ", ";
            }
            $output = "<textarea class='form-control w-40' readonly id='numbers'>$outputs</textarea>";
            $myfile = fopen("cleancontacts.doc", "w") or die("Unable to open file!");
            fwrite($myfile, $outputs, strlen($outputs));
            fclose($myfile);
            $path = "cleancontacts.doc";
            $link = "<div class='row'><div class='col-6'><button class='btn btn-outline-dark btn-block btn-lg' onclick='copyText()'>Copy Text</button></div>
                 <div class='col-6'><a href='./$path' class='btn btn-outline-primary btn-block btn-lg '>Get Doc Format</a></div></div>";

        }

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
    <div class="jumbotron bg-primary text-center font-weight-bold text-white">
        <h1>Phone Number Cleanup</h1>
<!--        <p class="text-dark">This Creates an importable mobile contacts vcf file from an excel sheet</p>-->
    </div>
    <div class="container">
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Phone Number Cleanup Help!</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>This tool formats phone numbers from txt files into number presets</p>
                        <li>First you include the txt file holding your numbers into the first field</li>
                        <li>Click on the Extract Button to begin the formatting process</li>
                        <li>Converted numbers are displayed once the process is done</li>
                        <li>Two buttons are displayed. You can just copy the formatted numbers or
                        simply download the numbers in doc format</li>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" required class="form-control">
                    <!--                <input type="number" name="sortCol" required class="form-control" placeholder="Sort by ...">-->
                    <input type="hidden" name="Doc" class="form-control">
                    <input type="submit" value="EXTRACT" class="btn btn-primary btn-block" name="submit" >
                </form>
                <div><?= $output?></div>
                <div><?= $link?></div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
<?php
include_once "../resources/footer.php";