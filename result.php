<?php
session_start();
if (!empty($_SESSION)) {
    $nums = $_SESSION['nums'];
    ?> <ul>
    <?php foreach ($nums as $num) {
        echo "<li> $num </li>";
    } ?>
</ul>
<?php
}
?>