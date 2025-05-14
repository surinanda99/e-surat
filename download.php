<?php

$filename = "surat.pdf";

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
header("Content-Transfer-Encoding: binary");
header("Accept-Ranges: bytes");

@readfile($filename);
?>
