<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<h2>Upload Form</h2>
<form method="POST" enctype="multipart/form-data" action="import1c.php">
	<input type="file" name="datafile">
	<input type="submit" name="sbm" value="Send">
</form>
<hr/>
<h2>Check Form</h2>
<form method="POST" enctype="multipart/form-data" action="import1c_check.php">
	<input type="file" name="datafile">
	<input type="submit" name="sbm" value="Send">
</form>
<hr/>