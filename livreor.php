<?php
require_once('Entity\Message.php');
require_once('Entity\GuestBook.php');
require_once('header.php');

$guestBook = new Guestbook('files/livre');
if(isset($_POST['username']) && isset($_POST['message'])){
    $message = new Message($_POST['username'], $_POST['message']);
    if($message->isValid()) {
        $guestBook->addMessage($message);
    }

}
?>

<div class="md-12 ml-4">
    <form method="POST">
        <div class="form-group">
            <label class="form-check-label" for="username">Nom d'utilisateur</label>
            <input name="username" class="form-control" type="text">
        </div>
        <div class="form-group">
            <label class="form-check-label" for="text">Message</label>
            <textarea name="message" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Envoyer</button>
    </form>
</div>
<?php if(isset($message)): ?>
    <?php if(!$message->isValid()): ?>
        <div class="alert alert-danger" role="alert">
        <?php foreach($message->getErrors() as $error): ?>
            <?= $error ?>
        <?php endforeach ?>
        </div>
    <?php endif ?>
<?php endif ?>
<div class="md-12">
    <?php foreach($guestBook->getMessages() as $message): ?>
    <?= $message->toHtml() ?>
    <?php endforeach ?>
</div>
<?php
require_once('footer.php');
?>
