<?php
$title = 'VCF Extractor';
$output = $link = "";
include_once "../resources/header.php";
if (isset($_POST['Doc'])) {
    extract($_POST);
    $f = $_FILES['f']['tmp_name'];
//    echo "<pre>";
//    print_r($f);
//    echo "</pre>";
    $h = fopen($f, "r");
    if ($h) {
        $c = fread($h, filesize($f));
        fclose($h);
        $ex = explode("\r", $c);
        $px = "";
        foreach ($ex as $k => $v) {
            $e = "";
            $v1 = trim($v);
            if (stripos($v1, 'TEL;CELL:') !== false) $e = strstr($v1, ':');
            if (stripos($v1, 'TEL;WORK:') !== false) $e = strstr($v1, ':');
            if (stripos($v1, 'TEL;HOME:') !== false) $e = strstr($v1, ':');
            if (stripos($v1, 'TEL;VOICE:') !== false) $e = strstr($v1, ':');
            if (stripos($v1, 'TEL;TYPE=CELL:') !== false) $e = strstr($v1, ':');
            else continue;
            $px .= str_replace(':', ' ', $e) . ",";
        }
        $output = "<textarea class='form-control w-40' readonly id='numbers'>$px</textarea>";
        $myfile = fopen("contacts32.doc", "w") or die("Unable to open file!");
        fwrite($myfile, $output, strlen($output));
        fclose($myfile);
        $path = "contacts32.doc";
        $link = "<div class='row'><div class='col-6'><button class='btn btn-outline-dark btn-block btn-lg' onclick='copyText()'>Copy Text</button></div>
        <div class='col-6'><a href='./$path' class='btn btn-outline-primary btn-block btn-lg '>Get Docx Format</a></div></div>";
    }
}

?>
<div class="jumbotron bg-primary text-center font-weight-bold text-white">
    <h1>CONTACT EXTRACTOR</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="f" required class="form-control">
                <input type="hidden" name="Doc" class="form-control">
                <input type="submit" value="CONVERT" class="btn btn-primary btn-block">
            </form>
            <div><?= $output?></div>
            <div><?php print_r($link)?></div>

        </div>

        <div class="col-1"></div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">VCF Extractor Help!</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p>This plugin extracts contacts in VCF Formats and converts them into single-lined numbers</p>
                    <ul>
                        <li>The first form field accepts the vcf file to be formatted.</li>
                        <li>Click on the Convert Button to begin the formatting process</li>
                        <li>Converted numbers are displayed once the process is done</li>
                        <li>Two buttons are displayed. You can just copy the formatted numbers or
                        simply download the numbers in doc format</li>
                        </ul>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
    include_once "../resources/footer.php";