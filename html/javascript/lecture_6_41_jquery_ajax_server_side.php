<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	date_default_timezone_set('Asia/Seoul');
	echo '현재 시각을 알려드려요~~ (나 서버...)<br>';
	echo date('e Y M j H시 i분 s초');
} else {
	echo 'AJAX error: request was not GET';
}