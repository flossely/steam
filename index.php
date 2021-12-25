<?php
$dir = '.';
include 'gi.php';
$list = str_replace($dir.'/','',(glob($dir.'/*.pkg')));
$id = $_REQUEST['id'] ? $_REQUEST['id'] : '';
if ($id == '') {
    $backgroundFile = file_get_contents('background');
    $background = (file_exists($backgroundFile)) ? $backgroundFile : 'https://github.com/eurohouse/eurohot/blob/main/back.canada.png?raw=true';
} else {
    $pkgOpen = file_get_contents($id.'.pkg');
    $pkgExp = explode('=|1|=', $pkgOpen);
    $pkgHead = $pkgExp[0];
    $pkgHeadExp = explode('=|2|=', $pkgHead);
    $pkgAuthor = $pkgHeadExp[0];
    $pkgWorkspace = $pkgHeadExp[1];
    $pkgVersion = $pkgHeadExp[2];
    $pkgBuild = $pkgHeadExp[3];
    $pkgCreated = $pkgHeadExp[4];
    $pkgDescription = $pkgHeadExp[5];
    $pkgLaunch = $pkgHeadExp[6];
    $pkgLaunchExp = explode('=|3|=', $pkgLaunch);
    $pkgLaunchTitle = $pkgLaunchExp[0];
    $pkgLaunchAuthor = $pkgLaunchExp[1];
    $pkgLaunchIcon = $pkgLaunchExp[2];
    $pkgLaunchImage = $pkgLaunchExp[3];
    $pkgLaunchBack = $pkgLaunchExp[4];
    $pkgLaunchApp = $pkgLaunchExp[5];
    $pkgBody = $pkgExp[1];
    $background = $pkgLaunchBack;
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Steam Web</title>
<link rel="shortcut icon" href="favicon.png?rev=<?=time();?>" type="image/x-icon">
<style>
@font-face {
    font-family: "arial";
    src: url("arial.ttf");
}
body {
    background-color: #e4e4e4;
    background-image: url(<?=$background;?>);
    background-size: auto 100vh;
    background-repeat: no-repeat;
    color: #000;
    font-family: "arial";
    font-size: 14pt;
}
font, a, p, b, i, strong, em, li {
    color: #000;
    font-family: "arial";
    font-size: 14pt;
}
table, tr, td, th {
    background-color: #dcdad5;
    color: #000;
    font-family: "arial";
    font-size: 14pt;
    text-align: center;
}
input, select, textarea {
    background-color: #fff;
    color: #000;
    border: none;
    border-radius: 5px;
    font-family: "arial";
    font-size: 14pt;
}
.top {
    background-color: #e4e4e4;
    border: none;
    border-radius: 5px;
    opacity: 0.75;
    position: absolute;
    width: 92%;
    height: 13%;
    top: 4%;
    left: 4%;
}
.panel {
    background-color: #e4e4e4;
    border: none;
    border-radius: 5px;
    opacity: 0.75;
    position: absolute;
    width: 92%;
    height: 77%;
    top: 17%;
    left: 4%;
    overflow-y: scroll;
}
.hover:hover {
    opacity: 0.7;
    position: relative;
}
.actionButtonGreen {
    background: linear-gradient(to bottom, #28ce53 0%, #1dbd3a 100%);
    background-size: 100%;
    color: #fff;
    border: none;
    border-radius: 5px;
    width: 29px;
    height: 28px;
    font-family: "arial";
    font-weight: bold;
    font-size: 14pt;
    position: relative;
}
.actionButtonRed {
    background: linear-gradient(to bottom, #f3123b 0%, #ed1157 100%);
    background-size: 100%;
    color: #fff;
    border: none;
    border-radius: 5px;
    width: 29px;
    height: 28px;
    font-family: "arial";
    font-weight: bold;
    font-size: 14pt;
    position: relative;
}
.actionIcon {
    height: 86%;
    position: relative;
}
.actionIcon:hover {
    opacity: 0.7;
}
</style>
<script src="jquery.js"></script>
<script src="base.js"></script>
</head>
<body>
<div class='top'>
<input class='actionButton' type='button' value="Update" onclick="get('i','from','steam','<?=$srcPubRepo;?>');">
<input class='actionButton' type='button' value="Get HSIS!" onclick="get('r','steam','hsis','<?=$srcPubRepo;?>');">
</div>
<div class='panel'>
<?php if ($id == '') { ?>
<p align='center'>
<?php
    foreach ($list as $key=>$value) {
        $pkgID = basename($value, '.pkg');
        $pkgOpen = file_get_contents($value);
        $pkgExp = explode('=|1|=', $pkgOpen);
        $pkgHead = $pkgExp[0];
        $pkgHeadExp = explode('=|2|=', $pkgHead);
        $pkgAuthor = $pkgHeadExp[0];
        $pkgWorkspace = $pkgHeadExp[1];
        $pkgVersion = $pkgHeadExp[2];
        $pkgBuild = $pkgHeadExp[3];
        $pkgCreated = $pkgHeadExp[4];
        $pkgDescription = $pkgHeadExp[5];
        $pkgLaunch = $pkgHeadExp[6];
        $pkgLaunchExp = explode('=|3|=', $pkgLaunch);
        $pkgLaunchTitle = $pkgLaunchExp[0];
        $pkgLaunchAuthor = $pkgLaunchExp[1];
        $pkgLaunchIcon = $pkgLaunchExp[2];
        $pkgLaunchImage = $pkgLaunchExp[3];
        $pkgLaunchBack = $pkgLaunchExp[4];
        $pkgLaunchApp = $pkgLaunchExp[5];
        $pkgBody = $pkgExp[1];
?>
<img style="width:20%;position:relative;" title="<?=$pkgLaunchTitle.' by '.$pkgLaunchAuthor;?>" src="<?=$pkgLaunchImage;?>" onclick="window.location.href='index.php?id=<?=$pkgID;?>';">
<?php } ?>
</p>
<?php } else { ?>

<?php } ?>
</div>
</body>
</html>
