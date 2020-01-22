<?php 
    $url = '';
    if(isset($_POST['submit'])){
        if($_POST['feedurl'] != ''){
            $url = $_POST['feedurl'];
        }
    }
    echo $url;
    function feedSearch($url) {

        if($html = @DOMDocument::loadHTML(file_get_contents($url))) {
            $xpath = new DOMXPath($html);
            $feeds = $xpath->query("//head/link[@href][@type='application/rss+xml']");

            $results = array();

            foreach($feeds as $feed) {
                $results[] = array(
                    'title' => $feed->getAttribute('title'),
                    'href' => $feed->getAttribute('href'),
                );
            }

            return $results;

        }

        return false;

    }

    print_r(feedSearch('http://www.flickr.com/photos/tags/bristol/'));

    /*
    Array
    (
        [0] => Array
            (
                [title] => Flickr: &quot;bristol&quot; RSS feed
                [href] => http://api.flickr.com/services/feeds/photos_public.gne?tags=bristol&lang=en-us&format=rss_200
            )

        [1] => Array
            (
                [title] => Flickr: "bristol" Geo feed
                [href] => http://api.flickr.com/services/feeds/geo/?tags=bristol&lang=en-us
            )

    )
    */
?>
<form method="post" action="">
    <input type="text" name="feedurl" placeholder="Enter website feed URL">&nbsp;
    <input type="submit" value="Submit" name="submit">
</form>