<?php
/**
 * Diff two string using LCS
 * @Author: jiangpengfei
 * @Date:   2019-03-04
 */
namespace TextDiff;

/**
 * case a[i] == b[j]: dp[i][j] = dp[i-1][j-1] + 1
 * case a[i] != b[j]: dp[i][j] = max(dp[i-1][j], dp[i][j-1])
 * case i,j == 0: dp[i][j] = 0
 */
class TextDiff {

    /**
     * diff two string
     * @param string $a  string A
     * @param string $b  string B
     * @param string $html return html 
     * 
     * @return array diff result，u is unchange, d is delete, a is append
     */
    public function diff(string $a, string $b, bool $html = false)
    {
        $alen = mb_strlen($a, 'UTF-8');
        $blen = mb_strlen($b, 'UTF-8');

        $dp = new \SplFixedArray($alen+1);  // 为了方便计算，第0行和第0列都为0
        for ($i = 0; $i < $alen+1; $i++) {
            $dp[$i] = new \SplFixedArray($blen+1);
            if ($i == 0) {
                // 第一行全为0
                for ($j = 0; $j < $blen + 1; $j++) {
                    $dp[$i][$j] = new DPModel(0, PATH_NONE);
                }
            } else {
                $dp[$i][0] = new DPModel(0, PATH_NONE);
            }
        }

        for($i = 1; $i < $alen+1; $i++) {
            for($j = 1; $j < $blen+1; $j++) {
                $aChar = mb_substr($a, $i-1, 1, 'UTF-8');
                $bChar = mb_substr($b, $j-1, 1, 'UTF-8');

                if ($aChar === $bChar) {
                    $dp[$i][$j] = new DPModel($dp[$i-1][$j-1]->value + 1, PATH_TOPLEFT);
                } else {
                    if ($dp[$i-1][$j]->value > $dp[$i][$j-1]->value) {
                        // top is larger
                        $dp[$i][$j] = new DPModel($dp[$i-1][$j]->value, PATH_TOP);
                    } else {
                        // left is larger
                        $dp[$i][$j] = new DPModel($dp[$i][$j-1]->value, PATH_LEFT);
                    }
                }
            }
        }

        // loop finish, get the LCS accroding path
        $i = $alen;
        $j = $blen;

        $res = [];
        while($i > 0 && $j > 0) {
            switch ($dp[$i][$j]->path) {
                case PATH_TOP:  // from b, a delete
                    $res[] = [mb_substr($a, $i-1, 1, 'UTF-8'), 'd'];
                    $i--;
                    break;

                case PATH_TOPLEFT:  // from both a,b
                    $res[] = [mb_substr($a, $i-1, 1, 'UTF-8'), 'u'];
                    $i--;
                    $j--;
                    break;

                case PATH_LEFT:     // from a, b insert
                    $res[] = [mb_substr($b, $j-1, 1, 'UTF-8'), 'a'];
                    $j--;
                    break;
            }
        }

        $res = array_reverse($res);

        if ($html) {
            return $this->toHtml($res);
        } else {
            return $res;
        }
    }

    public function toHtml($res) {
        $str = '';
        foreach($res as $item) {
            if ($item[1] == 'u') {
                $str .= '<span class="text-unchange">'.$item[0].'</span>';
            } else if ($item[1] == 'd') {
                $str .= '<S class="text-delete">'.$item[0].'</S>';
            } else {
                $str .= '<B class="text-new">'.$item[0].'</B>';
            }
        }

        return $str;
    }

}