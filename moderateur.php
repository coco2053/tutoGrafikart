<?php
require_once('header.php');
function moderer(string $phrase)
{
    $grosMots = ['pute', 'merde', 'salope'];
    $asterisques = [];
    foreach($grosMots as $gm) {
        $asterisques [] = $gm[0].str_repeat('*', strlen($gm)-1);
    }
    $phrase = str_replace($grosMots, $asterisques, $phrase);
    return $phrase;
}
?>
<form method="post">
        <div class="form-control">
            <label for="phrase">Entrez une phrase</label>
            <input type="text" name="phrase">

        <button type="submit">Moderer</button>
        </div>
    </form>
<?php
if(!empty($_POST['phrase'])){
    echo moderer($_POST['phrase']);
}
require_once('footer.php');
