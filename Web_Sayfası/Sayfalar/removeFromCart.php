<?php
    session_start();

    if (!isset($_SESSION["sepet"]) || count($_SESSION["sepet"]) === 0) {
        echo "Sepetiniz boş.";
    } else {
        $urunID = $_GET["urunID"];

        foreach ($_SESSION["sepet"] as $key => $urun) {
            if ($urun["urunID"] == $urunID) {
                unset($_SESSION["sepet"][$key]);
                exit; 
            }
        }
        echo "Ürün sepetinizde bulunamadı.";
    }
?>
