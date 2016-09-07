<?php
$post = array('user' =>array('hung', 'hoang'), 'age' =>array('12', '14'));
//$post = array('user' =>'hung', 'age' =>'12');
foreach ($post as $k => $v) {
	if(!is_array($v)) {
		$a = $post;
	} else {
		foreach ($v as $key => $value) {
			$a[] = $value;
		}
	}
}
print_r($a);
