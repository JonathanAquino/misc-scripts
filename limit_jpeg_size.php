<?php
/**
 * Limits the size of a jpeg file. Uses ImageMagick. Usually you should be able
 * to do this using ImageMagick's convert -define jpeg:extent=500kb input.jpg output.jpg
 * but it wasn't working for me (file size was not getting reduced).
 *
 * Usage: php limit_jpeg_size.php 500 input.jpg output.jpg
 */
$myDir = dirname(__FILE__);
$sizeInKb = $argv[1];
$kb = 1024;
$oldPath = $argv[2];
$newPath = $argv[3];
$tempPath = $myDir . '/temp.jpg';
if (filesize($oldPath) < $sizeInKb * $kb) {
    exec("cp $oldPath $newPath");
    return;
}
$quality = binary_search($sizeInKb * $kb, 100, function ($quality) use ($oldPath, $tempPath) {
    exec("convert $oldPath -compress jpeg -quality $quality $tempPath");
    $fileSize = filesize($tempPath);
    unlink($tempPath);
    return $fileSize;
});
@unlink($newPath);
exec("convert $oldPath -compress jpeg -quality $quality $newPath");
// Quality could be off by one - see "adjacent element" note below.
if (filesize($newPath) > $sizeInKb * $kb) {
    $quality -= 1;
    @unlink($newPath);
    exec("convert $oldPath -compress jpeg -quality $quality $newPath");
}
var_dump(basename($oldPath), filesize($oldPath), $quality);

/**
 * Does a binary search to find the index of the element. If the element is not
 * found, returns the index of an adjacent element.
 * Assumes that elements are integers, and that none are null.
 *
 * @param integer|string $target  the target value
 * @param integer $size  number of elements
 * @param function $get  retrieves the element for a given index; possibly expensive
 * @return integer  the index of the closest element
 */
function binary_search($target, $size, $get){
   $top = $size - 1;
   $bottom = 0;
   $array = [];

   while($top >= $bottom) {
      $i = floor(($top + $bottom) / 2);
      if (isset($array[$i])) {
          $value = $array[$i];
      } else {
          $value = $array[$i] = $get($i);
      }
      if ($value < $target) {
          $bottom = $i + 1;
      } elseif ($value > $target) {
          $top = $i - 1;
      }
      else {
          return $i;
      }
   }
   return $i;
}

