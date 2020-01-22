<?php
$title = 'Excel - VCF Extractor';
include_once "../resources/header.php";
include_once 'office_extractor.php';
$output = $content = $year = "";
if (isset($_POST['image'])) {
    extract($_POST);
    $sheet--;
    $colName--;
    $colNum--;
    $file = $_FILES['file']['tmp_name'];
    $myfile = fopen($file, 'r') or die('Unable to open file');
    if ($xlsx = SimpleXLSX::parse($file)) {
    	$class = "";
        $year = $xlsx->rows($sheet)[0][0];
        // $class = substr($year, 0, 4);
        $class = $namePrefix;
        foreach ($xlsx->rows($sheet) as $row) {
            $content .= "BEGIN:VCARD \r\nVERSION:2.1\r\n";
            $content .= "N:Class_" . $class . "_" . $row[$colName] . "\r\n";
            $content .= "FN:Class_" . $class . "_" . $row[$colName] . "\r\n";
            if (substr($row[$colNum], 0, 1) != 0) $content .= "TEL;TYPE=CELL:0" . $row[$colNum] . "\r\n";
            else $content .= "TEL;TYPE=CELL:" . $row[$colNum] . "\r\n";
            $content .= "END:VCARD\r\n"; #\r\n
        }
        $myfile = fopen("contacts.vcf", "w") or die("Unable to open file!");
        $txt = "John Doe\n";
        fwrite($myfile, $content);
        fclose($myfile);
        $path = "contacts.vcf";
        $output = "<a href='./$path' class='btn btn-outline-primary btn-block btn-lg '>Get VCF</a>";
    } else {
        echo SimpleXLSX::parse_error();
    }
}
?>
<div class="jumbotron bg-primary text-center font-weight-bold text-white">
    <h1>VCF Contact Creator</h1>
    <p class="text-dark">This Creates an importable mobile contacts vcf file from an excel sheet</p>
    <p class="text-dark"><?= $year?></p>
</div>
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required class="form-control">
                <input type="number" name="sheet" required class="form-control" placeholder="Sheet Number">
                <input type="number" name="colName" required class="form-control" placeholder="Name Column">
                <input type="number" name="colNum" required class="form-control" placeholder="Number Column">
                <input type="text" name="namePrefix" class="form-control" placeholder="Name Prefix">
                <input type="hidden" name="image" class="form-control">
                <input type="submit" value="CONVERT" class="btn btn-primary btn-block" >
            </form>
            <div><?php print_r($output)?></div>
        </div>
        <div class="col-1"></div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">VCF Contact Creator Help!</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p>This tool makes it easy for you to convert all numbers in excel format to savable vcf formats</p>
                    <ul>
                        <li>The first field contains the excel file bearing the contact details</li>
                        <li>The second field is the sheet number. This number is located at the bottom of your excel document. When it is opened. It's typically 3 unless more was added</li>
                        <li>The third field is the column bearing the names of the contacts</li>
                        <li>The fourth column is the keyword that would appear in front of every name saved. E.g, Ebere would appear to be 2019_ebere if the keyword is 2019. This field can be left empty</li>
                        <li>When all the required fields have been filed, you click the convert button. The process runs.</li>
                        <li>After a while, a button appears. Clicking this button lets you download the newly created VCF document</li>
                    </ul>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
include_once '../resources/footer.php';
