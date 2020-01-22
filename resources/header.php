<?php
if ($title == "Home") {
    echo "

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <title>$title | DD Plugins</title>

    <!--Bootstrap cdn-->
    <link rel='stylesheet' type='text/css' href='assets/bootstrap/css/bootstrap.min.css'>
    <!--Font awesome cdn-->
    <link href='assets/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.css' rel='stylesheet' type='text/css'/>


    <!--Custom CSS-->
    <link rel='stylesheet' href='assets/css/style.css'>
    
</head>
<body>

<nav class='navbar navbar-expand-md navbar-dark mb-3 navbar-custom'>

    <div class='container'>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarsExampleDefault' aria-controls='navbarsExampleDefault' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>

        <div class='collapse navbar-collapse' id='navbarsExampleDefault'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item text-dark'>Digital Dreams Plugins!
                </li>
            </ul>
            <ul class='navbar-nav ml-auto'>

                <li class='nav-item'>
                    <a class='nav-link' href='./excelGroupRows'>Excel Group Rows</a>
                </li>
                <!--                <li class='nav-item'>-->
                <!--                    <a class='nav-link' href='logout'>Logout</a>-->
                <!--                </li>-->
                <li class='nav-item '>
                    <a class='nav-link' href='./excelToVCF'>Excel-VCF Extrator </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='./phonenumberCleanup'>Contact Cleanup</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='./VCF2number'>VCF Extractor</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='./html2js'>HTML - JS</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='./rssreader'>Rss Reader</a>
                </li>


            </ul>

        </div>
    </div>
</nav>";
} else {
    echo "

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <title>$title | DD Plugins</title>

    <!--Bootstrap cdn-->
    <link rel='stylesheet' type='text/css' href='../assets/bootstrap/css/bootstrap.min.css'>
    <!--Font awesome cdn-->
    <link href='../assets/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.css' rel='stylesheet' type='text/css'/>


    <!--Custom CSS-->
    <link rel='stylesheet' href='../assets/css/style.css'>
    <style>
        input, textarea{
            margin:10px;
        }
    </style>

</head>
<body>

<nav class='navbar navbar-expand-md bg-primary navbar-dark'>
    <a class='navbar-brand' href='../'>Home</a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#collapsibleNavbar'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='collapsibleNavbar'>
        <ul class='navbar-nav font-weight-bold'>
            <li class='nav-item'>
                <a class='nav-link' href='../excelGroupRows'>Excel Group Rows</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../excelToVCF'>Excel - VCF Extractor</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../phonenumberCleanup'>Contact Cleanup</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../VCF2number'>VCF Extractor</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../rssreader'>Rss Reader</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='../html2js'>HTML - JS</a>
                </li>
            <li class='nav-item'>
                <button class='btn btn-light font-weight-bold' type='button' id='help' data-toggle='modal' data-target='#myModal'>Help</button>
            </li>
            
        </ul>
    </div>
</nav>
<div style='height: 2px; background: white'></div>";
}
?>
