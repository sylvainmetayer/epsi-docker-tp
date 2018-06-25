<?php
    session_start();
    include 'connect.php';
    $redis = new Redis();
    $redis->connect('redis', 6379);
    $redis->auth("password");

    if (!$redis->get("connected")) { 
        header('Location: erreur-interdit.html');
    }
 ?><!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Code postaux - Liste</title>
        <style media="screen">
            span.code {
                display: inline-block;
                width: 60px;
            }
            div.ligne_cp:hover {
                color: #F00;
            }
            input#filtre_cp {
                width: 60px;
            }
        </style>
        <script type="text/javascript">
            function filtrer_cp() {
                filtre = document.getElementById('filtre_cp').value;
                if (filtre != '') {
                    document.location.href = '?filtre='+filtre;
                } else {
                    document.location.href = '?';
                }
            }
        </script>
    </head>
    <body>
        <h1>Code postaux de France</h1>
        <div class="">
            <input type="text" maxlength="5" name="filtre_cp" id="filtre_cp" value="" placeholder="Code postal">
            <input type="button" name="" value="Filtrer" onclick="filtrer_cp()">
        </div>
        <?php
            $sql = "SELECT * FROM codepostal ";
            if ($_GET['filtre'] != '') $sql .= " WHERE cp_code LIKE '%".mysqli_real_escape_string($lien,$_GET['filtre'])."%' ";
            $sql .= " ORDER BY cp_code, cp_ville";
            $res = mysqli_query($lien,$sql);
            while ($ligne = mysqli_fetch_assoc($res)) {
                echo '<div class="ligne_cp">';
                echo '<span class="code">'.$ligne['cp_code'].'</span> '.$ligne['cp_ville'];
                echo '</div>';
            }
        ?>
    </body>
</html>
