<?php
class lib_pagination {
	
	function pageslist($baseurl, $totalrows, $offset,$per_page, $currentpage){
	   $totalpages = ceil($totalrows/$per_page);
	   $from = $currentpage-$offset;
	   $to = $currentpage +$offset;
	   if ($from<=0) $from=1;
	   if ($to>$totalpages) $to=$totalpages;
	   $links="";
	   for ($j=$from; $j<=$to; $j++) {
		if ($j==$currentpage) $links = $links . "<span>$j</span>"; 
		else $links = $links . "<a href = '$baseurl/$j/'>$j</a>"; 	
	   }
	   
	   return $links;
	}//
}