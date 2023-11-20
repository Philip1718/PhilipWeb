<?php if (isset($error) && count($error) > 0) :?>
    <div class="error">
        <?php foreach ($error as $err) : ?>
            <p><?php echo $err ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
