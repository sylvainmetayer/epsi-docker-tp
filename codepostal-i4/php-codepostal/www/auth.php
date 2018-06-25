<?php
include 'connect.php';

if ($_POST['ut_login'] != '' and $_POST['ut_motdepasse'] != '') {
    $ut_login = "'".mysqli_real_escape_string($lien,$_POST['ut_login'])."'";
    $ut_motdepasse = "SHA2(CONCAT(ut_salt,'".mysqli_real_escape_string($lien,$_POST['ut_motdepasse'])."'),256)";
    $sql = "SELECT * FROM utilisateurs WHERE ut_login = $ut_login AND ut_motdepasse = $ut_motdepasse";
    $res = mysqli_query($lien, $sql);
    if(mysqli_num_rows($res) == 1) {
        $redis = new Redis();
        $redis->connect('redis', 6379);
        $redis->auth("password");
        $redis->set("connected", true);
        $redis->save();
        //$_SESSION['login'] = $_POST['ut_login'];
        header('Location: liste.php');
    } else {
        header('Location: erreur-badlogin.html');
    }
} else {
    header('Location: erreur-nologin.html');
}
 ?>
