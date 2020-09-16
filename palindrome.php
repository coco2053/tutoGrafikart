
<?php

require_once('header.php');

function isPalindrome(string $word)
{

    return (strtolower($word) == strtolower(strrev($word))) ? 'C\'est un palindrome' : 'Ce n\'est pas un palindrome';
}

?>
<form method="post">
    <div class="form-control">
        <label for="phrase">Entrez un mot</label>
        <input type="text" name="phrase">

        <button type="submit">Verifier</button>
    </div>
</form>
<?php
if(!empty($_POST['phrase'])){
    echo isPalindrome($_POST['phrase']);
}
require_once('footer.php');