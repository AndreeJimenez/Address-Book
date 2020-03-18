<?php
include 'includes/functions/functions.php';
include 'includes/layout/header.php';

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if (!$id) {
	die('Not valid');
}

$result = getContacts($id);
$contact = $result->fetch_assoc();
?>


<div class="container-bar">
	<div class="container bar">
		<a href="index.php" class="btn return">Return</a>
		<h1>Update Contact</h1>
	</div>
</div>

<div class="bg-secundary container shadow">
	<form id="contact" action="#">
		<legend>Update Contact</span> </legend>

		<?php include 'includes/layout/form.php'; ?>
	</form>
</div>


<?php include 'includes/layout/footer.php'; ?>