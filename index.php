
<?php
$title = "Home";
include_once 'resources/header.php'
?>

<div class="container">

    <div class='jumbotron jumbotron-fluid text-center color-set'>
        <div class="container">
            <h1 class='display-6'>Welcome to Digital Dreams Plugins</h1>
            <p class="text-lead">Just Click on any plugin you want to make use of and you would be directed to the page!</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class='card card-custom'>


                <div class="card-header card-header-custom text-center">

<!--                    <p class="font-weight-bold">Left</p>-->
                </div>
                <div class='card-body'>

                    <div class="row">
                        <div class="col-lg-12">


                            <ul class="list-group text-center">
                                <li class="list-group-item"><a href="./excelGroupRows" class="text-dark font-weight-bold">Excel Group Rows</a></li>
                                <li class="list-group-item"><a href="./excelToVCF" class="text-dark font-weight-bold">Excel - VCF Extractor</a></li>
                                <li class="list-group-item"><a href="./rssreader" class="text-dark font-weight-bold">Rss Reader</a></li>
                            </ul>


                        </div>
                    </div>



                </div>


            </div>
        </div>

        <div class="col-md-6 ">

            <div class='card card-custom'>


                <div class="card-header card-header-custom text-center">

<!--                    <p class="font-weight-bold">Right</p>-->
                </div>
                <div class='card-body'>

                    <div class="row">
                        <div class="col-lg-12">


                            <ul class="list-group text-center">

                                <li class="list-group-item"><a href="./VCF2number" class="text-dark font-weight-bold">VCF - Txt Extractor</a></li>
                                <li class="list-group-item"><a href="./phoneNumberCleanup" class="text-dark font-weight-bold">Contact Cleanup</a></li>
                                <li class="list-group-item"><a href="./html2js" class="text-dark font-weight-bold">HTML to JS</a></li>
                            </ul>


                        </div>
                    </div>



                </div>


            </div>
        </div>
    </div>

</div>
<?php
include_once 'resources/footer.php';