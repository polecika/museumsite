<?php
$link = mysqli_connect("u376880.mysql.masterhost.ru", "u376880_polina", "ResiNgEd5I_G", "u376880_polina")or die ('ERROR CONNECT MYSQL1111');

if (!mysqli_set_charset($link, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($link));
    exit();
}

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>