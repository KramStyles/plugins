<?php
require('office_extractor.php');
$title = 'Excel Group Rows';
include_once "../resources/header.php";
$output = $link = "";
function clearFiles(){
    //The name of the folder.
    $folder = 'uploads';
//Get a list of all of the file names in the folder.
    $files = glob($folder . '/*');
//Loop through the file list.
    foreach($files as $file){
    //Make sure that this is a file and not a directory.
        if(is_file($file)){
        //Use the unlink function to delete the file.
            unlink($file);
        }
    }
}

function excelSheetSepertor($excel_file, $colSortNum)
{
    if ($xlsx = SimpleXLSX::parse($excel_file)) {
        $x = $xlsx->rows();//extract the excel file as an array using the extractor above
    } else {
        $output = SimpleXLSX::parse_error();
    }
    $i = []; //create an empty array
    foreach ($x as $x1) { //loop the array
        $i[] = $x1[$colSortNum]; //push the avary value of every 2nd column into the emty array
    }
    $r = array_unique($i); //remove every repeated value making this new array avlue unique
    $dir = getcwd().'\\uploads\\';
    $olddir = getcwd();
    foreach ($r as $j) { //loop through the new unique array
        foreach ($x as $t) { //loop through the extracted array
            if ($t[$colSortNum] == $j) { //if the value of the unique array equals the value of the 2nd column of the extract array
                $l[$j][] = $t; // create a new two dimentional array using the unique array value as the key for this array and the entir value of the extract array as the value of this new array
            }
        }
        array_unshift($l[$j], $x[0]); //here place the first value of the extract array at the begining of every value of the multidimentional array
        foreach ($l[$j] as $d) { // loop the multi dimentional array and grt the value of each dimention
            $dir_handle = opendir($dir);

            if(is_resource($dir_handle))
            {
                chdir("$dir");
                $file_handle = fopen($j . ".csv", 'a',$dir); //create a with using the value of each unique array as the the file name withe dit csv extension
                $filepath = fputcsv($file_handle, $d); // use the PHP fputcsv to arrange the value of this loop ($d) in the .CSV format
                chdir("$olddir");
            }
        }
    }
}

if (isset($_POST['excelDoc'])) {
    clearFiles();
    extract($_POST);
    $file = $_FILES['file']['tmp_name'];
    $myfile = fopen($file, 'r') or die('Unable to open file');
    $sortCol--;
    excelSheetSepertor($file, $sortCol);
    $output = "<hr><div class='alert alert-primary text-center font-weight-bold text-light'>Done</div><hr>";
    $link = "<form method='post' action=''>
    <input type='hidden' name='Explore'/>
    <input class='form-control btn btn-outline-primary btn-lg'  type='submit' value='Open Containing Folder'/>
    </form>";
}

if (isset($_POST['Explore'])) {
    $d = dir(getcwd());
    $sortpath = $d->path.'\\uploads\\';
    exec("EXPLORER /E,$sortpath");

}
?>

<div class="jumbotron bg-primary text-center font-weight-bold text-white">
    <h1>Excel Rows Grouping Plugin</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required class="form-control">
                <input type="number" name="sortCol" required class="form-control" placeholder="Sort by ...">
                <input type="hidden" name="excelDoc" class="form-control">
                <input type="submit" value="GROUP" class="btn btn-primary btn-block">
            </form>
            <div><?= $output ?></div>
            <div><?= $link ?></div>
        </div>
        <div class="col-1"></div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Row Grouping Help!</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p>This is a row grouping plugin. It sorts and seperates files based on columns. </p>
                    <ul>
                        <li>First choose the excel file you want to group</li>
                        <li>Input the column number you want to sort with. E.g If you want to sort based on classes, select the column number for classes.</li>
                        <li>Click on the group button. The process runs in the background and a second button appears</li>
                        <li>Click on the second button to open the folder containing the sorted excel files.</li>
                        <li>Open them to see the results.</li>
                        <li>When you are done, feel free to delete the files</li>
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