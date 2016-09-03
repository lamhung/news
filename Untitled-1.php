<?php
// try catch -> exception
function delete_image($file_path)
{
	try {
		unlink($file_path);
	} catch(Exception $e) {
		echo 'khong the xoa file';
		echo $e->getMessage();
	}
}

$file_path = 'C:\image\car.jpg';
delete_image($file_path);

//RollBack -> transaction
$result = array('sucess' => false, 'msg'=>'');
try {
    // First of all, let's begin a transaction
    $db->beginTransaction();

    // A set of queries; if one fails, an exception should be thrown
    $db->query('first query');
    $db->query('second query');
    $db->query('third query');
    // If we arrive here, it means that no exception was thrown
    // i.e. no query has failed, and we can commit the transaction
    $db->commit();
	
	$result['success'] = true;
	
} catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    $db->rollback();
	$result['msg'] = 'khong the luu don hang: ' . $e->getMessage();
	
}

return $result;