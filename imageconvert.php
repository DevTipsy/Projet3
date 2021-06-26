<?php
Header ('Content-type: image/png');
$resource = imagecreatefrompng ('logo_gbaf.png');
imagealphablending($resource, false);
imagesavealpha($resource, true);
imagecolortransparent($resource);
imagepng($resource);
?>