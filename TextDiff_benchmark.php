<?php
/**
 * 性能测试
 * @Author: jiangpengfei
 * @Date:   2019-03-05
 */

require_once("vendor/autoload.php");

use TextDiff\TextDiff;

// 464
$textA = 'Up branch to easily missed by do. Admiration considered acceptance too led one melancholy expression. Are will took form the nor true. Winding enjoyed minuter her letters evident use eat colonel. He attacks observe mr cottage inquiry am examine gravity. Are dear but near left was. Year kept on over so as this of. She steepest doubtful betrayed formerly him. Active one called uneasy our seeing see cousin tastes its. Ye am it formed indeed agreed relied piqued. ';

// 447
$textB = 'Yet remarkably appearance get him his projection. Diverted endeavor bed peculiar men the not desirous. Acuteness abilities ask can offending furnished fulfilled sex. Warrant fifteen exposed ye at mistake. Blush since so in noisy still built up an again. As young ye hopes no he place means. Partiality diminution gay yet entreaties admiration. In mr it he mention perhaps attempt pointed suppose. Unknown ye chamber of warrant of norland arrived. ';

$startTime = microtime(true);

for ($i = 0; $i < 3; $i++) {
    $textDiff = new TextDiff();
    $textDiff->diff($textA, $textB);
}

$finishTime = microtime(true);

$cost = $finishTime-$startTime;

echo 'average time：'. $cost.PHP_EOL;