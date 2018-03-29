<?php

trait Shareable {
    public function share() {
        echo "Sharing...<br>";
    }
}

trait Likeable {
    public function like() {
        echo "Liked...<br>";
    }
}


class Video {
    use Shareable, Likeable;
}

class Image {
    use Shareable, Likeable;
}


$video = new Video();
$image = new Image();
$video->share();
$video->like();
$image->share();
$image->like();