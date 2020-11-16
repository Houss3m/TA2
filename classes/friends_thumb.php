<?php 
    class Thumbnail{
        public function create_thumbnail($image){
            $width =50;
            $type='jpg';
            $height=50;
            $image_exif = exif_read_data($image,0,true);
            $image = exif_thumbnail($image, $width, $height, $type);
            return base64_encode($image);
         } 
    }
?>