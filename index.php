<?php
include 'Class/DbConnect.php';
$db = new DbConnect;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <section class="main">
        <nav>
            <ul>
                <a href="index.php?page=realisation&command=modifier&categorie=RenovMur"><li>Rénovation des murs</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=PeintureInt"><li>Peinture Intérieur</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=RevetMur"><li>Revêtement des Murs</li></a>
                <a href="index.php?page=realisation&command=modifier&categorie=RevetSol"><li>Revêtement des Sols</li></a>
            </ul>
        </nav>
        <a href="index.php?page=realisation&command=modifier&categorie=All"><p class='afficher'>Afficher tout</p></a>
    
    <?php 
    
    
    if (isset($_GET['page'], $_GET['command'], $_GET['categorie']) && $_GET['page']='realisation' && $_GET['command']='modifier' && $_GET['categorie']=='All'){ 
        
        $resultAllChantier=$db->readAllSlide();
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\'><div class="cardupdate">
                <p>' .$resultAllChantierKey['nom_chantier'] .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <img src="' .$resultAllChantierKey['photo_av_chantier']. '" alt="">
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <img src="' .$resultAllChantierKey['photo_ap_chantier']. '" alt="">
                    </div>
                </div>
                <p>' .$resultAllChantierKey['description_chantier']. '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .$resultAllChantierKey['id_chantier']. '" value="Modifier">
                    <input type="submit" name="Supprimer' .$resultAllChantierKey['id_chantier']. '" value="Supprimer">
                    <input type="text" class="inputHidden" name="postSupprimer' .$resultAllChantierKey['id_chantier']. '" value="' .$resultAllChantierKey['id_chantier']. '">';

                    if (isset($_POST['Supprimer' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </div></form>';
        }
    }

    if (isset($_GET['page'], $_GET['command'], $_GET['card']) && $_GET['page']='realisation' && $_GET['command']='modifier'){
        $idCardUpdate=$_GET['card'];
        $resultCardUpdate=$db->readAllSlideUpdate($idCardUpdate);
        foreach ($resultCardUpdate as $resultCardUpdateKey){
        echo
                '<form class="updateForm" method=\'POST\'><div class="cardupdate">
                <input type="text" name="updateNomInput" value="' .$resultCardUpdateKey['nom_chantier'] .'">
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <img src="' .$resultCardUpdateKey['photo_av_chantier']. '" alt="">
                        <input type="file" name="uploadImgAv">
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <img src="' .$resultCardUpdateKey['photo_ap_chantier']. '" alt="">
                        <input type="file" name="uploadImgAp">
                    </div>
                </div>
                <input type="text" name="updateDescriptionInput" value="' .$resultCardUpdateKey['description_chantier'] .'">
                <div class="updOrDelete">
                    <input type="submit" name="Supprimer' .$resultCardUpdateKey['id_chantier']. '" value="Supprimer">
                    <input type="text" class="inputHidden" name="postSupprimer' .$resultCardUpdateKey['id_chantier']. '" value="' .$resultCardUpdateKey['id_chantier']. '">
                    <input type="submit" name="validerUpdate" value="Valider">
                    </div>
                </div></form>';
        }
        if (isset($_POST['validerUpdate'])){

        }
    }


    ?>
    </section>
</body>
</html>