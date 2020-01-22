<?php
$title = 'RSS Fead Reader';
$output = $link =  $site = "";
include_once "../resources/header.php";
$url = "http://makitweb.com/feed/";
if(isset($_POST['submit'])){
    if($_POST['feedurl'] != ''){
        $url = $_POST['feedurl'];
    }
}
$invalidurl = false;
if(@simplexml_load_file($url)){
    $feeds = simplexml_load_file($url);
}else{
    $invalidurl = true;
    $output = "<h2 class='text-center'>Invalid RSS feed URL.</h2>";
}


?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
        .even:nth-child(even){
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <div class="jumbotron bg-primary text-center font-weight-bold text-white">
        <h1>Reading rss feeds using PHP</h1>
        <h5>|URL: <?= $url?>|</h5>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <form action="" method="post">
                    <input type="url" name="feedurl" required class="form-control" placeholder="Enter website feed URL">
                    <input type="submit" value="READ URL" class="btn btn-primary btn-block" name="submit">
                </form>
                <div><?= $output?></div>
                <div><?php print_r($link)?></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            $i=0;
            if(!empty($feeds)){
                $site = $feeds->channel->title;
                $sitelink = $feeds->channel->link;
                foreach ($feeds->channel->item as $item) {
                    $title = $item->title;
                    $link = $item->link;
                    $description = $item->description;
                    $postDate = $item->pubDate;
                    $pubDate = date('D, d M Y',strtotime($postDate));
                    if($i>=9) break;
                    ?>
                    <div class="col-4 mb-2 even">
                        <div class="card" style="width:380px; height: 300px">
                          <div class="card-body">
                            <h5 class="card-title text-center"><?= $title?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $pubDate?></h6>
                            <p class="card-text text-justify"><?php echo implode(' ', array_slice(explode(' ', $description), 0, 20)) . "..."; ?> </p>
                            <a href="<?= $link?>" class="btn btn-primary">Read More!</a>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <?php
                $i++;
            }
        }else{
            if(!$invalidurl){
                echo "<h2>No item found</h2>";
            }
        }
        ?>
    </div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">RSS Reader Help!</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p>This plugin extracts blog post from websites and parses them into feeds.</p>
                <ul>
                    <li>Just drop the url you want to extract feeds from. Example of such urls include:</li>
                    <li class="font-weight-bold">http://makitweb.com/feed</li>
                    <li class="font-weight-bold">https://chrislema.com/feed</li>
                    <li>Press enter or click on the button below to view feeds picked from the requested url</li>
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

