<?php if (isset($_SESSION['mensaje'])) { ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['error'])) { ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>