<?php
// Build up those SQL tables and rows.
require "inc/app.php";

header("Content-type: text/plain");

// building the emoticon table:
if($db->query("CREATE TABLE `emoticons` (
    `id` int(11) NOT NULL,
    `emo_tag` text NOT NULL,
    `emo_location` text NOT NULL,
    `is_active` tinyint(4) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;")) {
    echo "[DB ] Emoticons Table creation success.\n";
} else {
    echo "[DB ] Emoticons Table creation FAILED.\n";
}

//building the comments table:
if($db->query("CREATE TABLE `comments` (
    `id` int(11) NOT NULL,
    `display_name` text NOT NULL,
    `email` text NOT NULL,
    `comments` text NOT NULL,
    `is_active` text NOT NULL,
    `created_date` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;")) {
    echo "[DB ] Comments Table creation success.\n";
} else {
    echo "[DB ] Comments Table creation FAILED.\n";
}

//scanning the emoticon folder
$emos = array_slice(scandir(__DIR__ . '/assets/emoticon/'), 2);
$counter = 1;
foreach($emos as $emo) {
    if(insert_emoticon(":cat" . $counter++ . ":", 'assets/emoticon/' . $emo)) {
        echo "[EMO] Successfully adding $emo as :cat" .  ($counter-1).":.\n";
    } else {
        echo "[EMO] FAILED adding $emo as :cat" .  ($counter-1).":.\n";
    }
}

if(insert_comment("Chris", "iam@christianto.net", "Yep, berhasil. :cat9:", strtotime("9 September 2000"))){
    echo "[CMN] Successfully adding a comment.\n";
} else {
    echo "[CMN] FAILED adding a comment.\n";
}

echo "[SYS] DB creation finished.\n";
echo "[SYS] Happy Learning.\n";

echo "[CHZ] Try to find the easter egg, you'll get one.\n";
echo "[CHZ] It's my buddy's birthday.\n";