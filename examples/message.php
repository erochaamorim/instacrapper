<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$username='erickrochaamorim';
$password='@erk#171';

use Phpfastcache\Helper\Psr16Adapter;

$seperator = PHP_SAPI === 'cli' ? "\n" : "<br>\n";
$instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(), $username, $password, new Psr16Adapter('Files'));
$instagram->login();

$mediaCode='CPEiOZ4B8f4';
$comments = $instagram->getMediaCommentsByCode($mediaCode, 1000);
$total_nr_comments = count($comments);
echo "Total nr of comments: ".$total_nr_comments;

$pageSize=intdiv($total_nr_comments, 2);

$comments = $instagram->getMediaCommentsByCode($mediaCode, $pageSize);
echo "${seperator}Nr of comments page 1: ".count($comments);

$comments = $instagram->getMediaCommentsByCode($mediaCode, $pageSize+$total_nr_comments%2);
echo "${seperator}Nr of comments page 2: ".count($comments);


$maxId = null;
$hasPrevious = true;
$counter = 0;
while ($hasPrevious)
{
    $counter++;
    $PaginateComments = $instagram->getPaginateMediaCommentsByCode($mediaCode, $pageSize, $maxId);
    $comments = $PaginateComments->comments;
    $maxId = $PaginateComments->maxId;
    $hasPrevious = $PaginateComments->hasPrevious;

    echo "${seperator}${seperator}--------------------------------------------------------------------------------";
    echo "${seperator}Nr of comments page ${counter}: ".count($comments);
    echo "${seperator}Total comments: " . $PaginateComments->commentsCount;
    echo "${seperator}Has Previous:   " . $PaginateComments->hasPrevious;
    $count=1;
    foreach ($comments as $comment){
        echo "${seperator}Comment Number ".$count." : ".$comment->getId();
        echo "${seperator}comment Creates:"  . $comment->getCreatedAt();
        echo "${seperator}comment Text   :"  . $comment->getText();
        $count+=1;
    }
    sleep(2);
}
