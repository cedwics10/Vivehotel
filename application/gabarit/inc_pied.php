Vivehôtel (Guinot&copy;2021-2022)
<?php if (!isset($_SSESSIOn['pro_id']) and !isset($_SESSION['per_id'])) { ?>
    <a class="lien_pied" href='<?= hlien("authentification", "connexion_personnel") ?>'>Connexion du personnel</a>
<?php } ?>
<script src="_js/script.js"></script>