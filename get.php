<?php
    function getBackend($prop = null, $pdo) {
        $stmt = $pdo->prepare("SELECT * FROM `backend` WHERE Settings=?");
        $stmt->execute([$prop]);
        return $stmt->fetch(PDO::FETCH_ASSOC)["value1"];
    }