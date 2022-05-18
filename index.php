<?php
$dir = '.';
$list = str_replace($dir.'/','',(glob($dir.'/*.pkg')));
$mode = $_REQUEST['mode'] ? $_REQUEST['mode'] : '';
$id = $_REQUEST['id'] ? $_REQUEST['id'] : '';
if ($mode == '') {
    if ($id == '') {
        if (file_exists('background')) {
            $backFile = file_get_contents('background');
            if ($backFile != '') {
                $background = $backFile;
            } else {
                $background = 'https://github.com/eurohouse/eurostyle/blob/hot/back.ocean.png?raw=true';
            }
        } else {
            $background = 'https://github.com/eurohouse/eurostyle/blob/hot/back.ocean.png?raw=true';
        }
    } else {
        $pkgID = $id;
        $pkgOpen = file_get_contents($pkgID.'.pkg');
        $pkgExp = explode('|[1]|', $pkgOpen);
        $pkgHead = $pkgExp[0];
        $pkgHeadExp = explode('|[2]|', $pkgHead);
        $pkgAuthor = $pkgHeadExp[0];
        $pkgProject = $pkgHeadExp[1];
        $pkgVersion = $pkgHeadExp[2];
        $pkgBranch = $pkgHeadExp[3];
        $pkgCreated = $pkgHeadExp[4];
        $pkgDescription = $pkgHeadExp[5];        
        if (isset($pkgHeadExp[6])) {
            $pkgTitle = $pkgHeadExp[6];
        } else {
            $pkgTitle = strtoupper($pkgID);
        }
        if (isset($pkgHeadExp[7])) {
            $pkgType = $pkgHeadExp[7];
        } else {
            $pkgType = 'Package';
        }
        if (file_exists($pkgID.'.cover.png')) {
            $pkgIcon = $pkgID.'.cover.png';
        } else {
            if (isset($pkgHeadExp[8])) {
                $pkgIcon = $pkgHeadExp[8];
            } else {
        	$pkgIcon = 'https://github.com/flossely/basic/blob/main/sys.app.png?raw=true';
            }
        }
        if (isset($pkgHeadExp[9])) {
            $pkgLauncher = $pkgHeadExp[9];
        } else {
            $pkgLauncher = 'index.php';
        }
        $pkgBody = $pkgExp[1];
        $pkgLaunchTitle = $pkgTitle;
        $pkgLaunchApp = $pkgLauncher;
        $pkgLaunchCover = $pkgIcon;
        $pkgLaunchBack = (file_exists($pkgID.'.back.png')) ? $pkgID.'.back.png' : 'https://github.com/wholemarket/whisper/blob/main/back.win9x.png?raw=true';
        $background = $pkgLaunchBack;
    }
} elseif ($mode == 'store') {
    $backgroundFile = file_get_contents('background');
    $background = (file_exists($backgroundFile)) ? $backgroundFile : 'https://github.com/eurohouse/eurohot/blob/main/back.ocean.png?raw=true';
} else {
    $backgroundFile = file_get_contents('background');
    $background = (file_exists($backgroundFile)) ? $backgroundFile : 'https://github.com/eurohouse/eurohot/blob/main/back.ocean.png?raw=true';
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
    height: 10%;
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
    top: 14%;
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
<?php include 'base.incl.php'; ?>
</head>
<body>
<div class='top'>
<p align='center'>
<input class='actionButton' type='button' value="Home" onclick="window.location.href='index.php';">
<input class='actionButton' type='button' value="Store" onclick="window.location.href='index.php?mode=store';">
<input class='actionButton' type='button' value="Update" onclick="get('i','','from','steam','','flossely',false);">
<input class='actionButton' type='button' value="Exit" onclick="get('i','','from','hsis','','flossely',false);">
</p>
</div>
<div class='panel'>
<?php
if ($mode == '') {
    if ($id == '') {
?>
<p align='center'>
<?php
    foreach ($list as $key=>$value) {
        $pkgID = basename($value, '.pkg');
        $pkgOpen = file_get_contents($value);
        $pkgExp = explode('|[1]|', $pkgOpen);
        $pkgHead = $pkgExp[0];
        $pkgHeadExp = explode('|[2]|', $pkgHead);
        $pkgAuthor = $pkgHeadExp[0];
        $pkgProject = $pkgHeadExp[1];
        $pkgVersion = $pkgHeadExp[2];
        $pkgBranch = $pkgHeadExp[3];
        $pkgCreated = $pkgHeadExp[4];
        $pkgDescription = $pkgHeadExp[5];
        if (isset($pkgHeadExp[6])) {
            $pkgTitle = $pkgHeadExp[6];
        } else {
            $pkgTitle = strtoupper($pkgID);
        }
        if (isset($pkgHeadExp[7])) {
            $pkgType = $pkgHeadExp[7];
        } else {
            $pkgType = 'Package';
        }
        if (file_exists($pkgID.'.cover.png')) {
            $pkgIcon = $pkgID.'.cover.png';
        } else {
            if (isset($pkgHeadExp[8])) {
                $pkgIcon = $pkgHeadExp[8];
            } else {
        	$pkgIcon = 'https://github.com/flossely/basic/blob/main/sys.app.png?raw=true';
            }
        }
        if (isset($pkgHeadExp[9])) {
            $pkgLauncher = $pkgHeadExp[9];
        } else {
            $pkgLauncher = 'index.php';
        }
        $pkgBody = $pkgExp[1];
        $pkgLaunchTitle = $pkgTitle;
        $pkgLaunchApp = $pkgLauncher;
        $pkgLaunchCover = $pkgIcon;
        $pkgLaunchBack = (file_exists($pkgID.'.back.png')) ? $pkgID.'.back.png' : 'https://github.com/wholemarket/whisper/blob/main/back.win9x.png?raw=true';
?>
<img style="height:20%;position:relative;" title="<?=$pkgLaunchTitle;?>" src="<?=$pkgLaunchCover;?>" onclick="window.location.href='index.php?id=<?=$pkgID;?>';">
<?php } ?>
</p>
<?php } else { ?>
    <h2 align='center'><img style="height:92px;position:relative;" src="<?=$pkgLaunchCover;?>"> <?=$pkgLaunchTitle;?></h2>
    <p align='center'><?=$pkgDescription;?></p>
    <p align='center'>
        <input class='actionButton' type='button' value="Play" onclick="window.location.href='<?=$pkgLaunchApp;?>';">
         <input class='actionButton' type='button' value="Back" onclick="window.location.href='index.php';"><br>
         <input class='actionButton' type='button' value="Update" onclick="get('i','','from','<?=$pkgID;?>','','<?=$pkgAuthor;?>');">
         <input class='actionButton' type='button' value="Uninstall" onclick="get('d','','<?=$pkgID;?>','from','','here',true); window.location.href = 'index.php';">
    </p>
<?php }} elseif ($mode == 'store') { ?>
    <p align='center'>
    <label>Install a new game: </label><br>
    <input type="text" id="getMan" style="width:30%;position:relative;" value="" onkeydown="if (event.keyCode == 13) {
    get('i', '', 'from', getMan.value, '', 'flossely', true); window.location.href = 'index.php';
}">
    </p>
<?php } else { ?>

<?php } ?>
</div>
</body>
</html>
