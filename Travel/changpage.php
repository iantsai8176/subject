<?php
// 顯示的頁數範圍
$range = 3;
 
// 若果正在顯示第一頁，無需顯示「前一頁」連結
if ($num_pages > 1) {
	// 使用 << 連結回到第一頁
	echo " <a href={$_SERVER['PHP_SELF']}?page=1><<</a> ";
	// 前一頁的頁數
	$prevpage = $num_pages - 1;
	// 使用 < 連結回到前一頁
	echo " <a href={$_SERVER['PHP_SELF']}?page=".$prevpage."><</a> ";
} // end if
 
// 顯示當前分頁鄰近的分頁頁數
for ($x = (($num_pages - $range) - 1); $x < (($num_pages + $range) + 1); $x++) {
	// 如果這是一個正確的頁數...
	if (($x > 0) && ($x <= $total_pages)) {
		// 如果這一頁等於當前頁數...
		if ($x == $num_pages) {
			// 不使用連結, 但用高亮度顯示
			echo " [<b>".$x."</b>] ";
			// 如果這一頁不是當前頁數...
		} else {
			// 顯示連結
			echo " <a href=performance.php?page=".$x.">".$x."</a> ";
		} // end else
	} // end if
} // end for
 
// 如果不是最後一頁, 顯示跳往下一頁及最後一頁的連結
if ($num_pages != $total_pages) {
	// 下一頁的頁數
	$nextpage = $num_pages + 1;
	// 顯示跳往下一頁的連結
	echo " <a href={$_SERVER['PHP_SELF']}?page=".$nextpage.">></a> ";
	// 顯示跳往最後一頁的連結
	echo " <a href={$_SERVER['PHP_SELF']}?page=".$total_pages.">>></a> ";
} // end if
?>