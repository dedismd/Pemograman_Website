<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {

    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;

    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');

    $stmt = $pdo->prepare('INSERT INTO contacts VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nim, $name, $email, $phone, $created]);
 
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="nim">NIM</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="nim" placeholder="19009076003" id="nim">
        <label for="name">Name</label>
        <label for="email">Email</label>
        <input type="text" name="name" placeholder="Malik Nika" id="name">
        <input type="text" name="email" placeholder="nika@example.com" id="email">
        <label for="phone">Phone</label>
        <label for="created">Created</label>
        <input type="text" name="phone" placeholder="087732554678" id="phone">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>