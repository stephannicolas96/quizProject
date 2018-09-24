<?php

class helpers {
    
    public static function getUserImageName($id){
        return file_exists(path::getUserImagesPath() . $id . '.png') ? $id . '.png' : 'user-image.png';
    }
}

