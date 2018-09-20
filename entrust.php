<?php

/**
 * 通过分配或委托至其他对象，委托设计模式能够去除核心对象中的判断和复杂的功能性
 */
class PlayList
{

    private $_songs;

    public function __construct()
    {
        $this->_songs = [];
    }

    public function addSong($location, $title)
    {
        $song = ['location' => $location, 'title' => $title];
        $this->_songs[] = $song;
    }


    public function getM3U()
    {
        $m3u = '';

        foreach ($this->_songs as $song) {
            $m3u .= "M3U, {$song['title' ]} \n";
            $m3u .= "{$song[ 'location']}\n";
        }

        return $m3u;

    }

    public function getPLS()
    {
        $pls = '';

        foreach ($this->_songs as $song) {

            $pls .= "PLS, {$song['title' ]} \n";
            $pls .= "{$song[ 'location']}\n";
        }

        return $pls;
    }

}

//调用

$playlist = new Playlist();
$playlist->addSong('/root/resource/a.mp3', 'A music');
$playlist->addSong('/root/resource/b.mp3', 'B music');
$playlist->addSong('/root/resource/c.mp3', 'C music');
$externalFormat = 'm3u';

if ($externalFormat == 'm3u') {  //核心的复杂判断
    $playContent = $playlist->getM3U();
} else {
    $playContent = $playlist->getPLS();
}

print $playContent;


//使用委托模式

class NewPlayList
{
    private $_songs;

    private $_typeObject;

    public function __construct($type)
    {

        $this->_songs = array();
        $object = $type . 'PlayListDelegate';
        $this->_typeObject = new $object;
    }

    public function addSong($location, $title)
    {

        $song = array('location' => $location, 'title' => $title);
        $this->_songs[] = $song;

    }


    public function getPlayList()
    {

        $playlist = $this->_typeObject->getPlayList($this->_songs);
        return $playlist;
    }
}

class M3UPlayListDelegate
{

    public function getPlayList($songs)
    {

        $m3u = '';

        foreach ($songs as $song) {
            $m3u .= "M3U, {$song['title' ]} \n";
            $m3u .= "{$song[ 'location']}\n";
        }

        return $m3u;

    }
}


class PLSPlayListDelegate
{


    public function getPlayList($songs)
    {

        $pls = '';

        foreach ($songs as $song) {

            $pls .= "PLS, {$song['title' ]} \n";
            $pls .= "{$song[ 'location']}\n";
        }

        return $pls;

    }
}

$newPlayList = new NewPlaylist('M3U');
$newPlayList->addSong('/root/resource/a.mp3', 'A music');
$newPlayList->addSong('/root/resource/b.mp3', 'B music');
$newPlayList->addSong('/root/resource/c.mp3', 'C music');
$newPlayListContent = $newPlayList->getPlayList();
print $newPlayListContent;



