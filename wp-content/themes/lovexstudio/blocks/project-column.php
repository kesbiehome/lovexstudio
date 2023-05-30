<?php

$is_first_large_card = $column_index % 2 !== 0 ?? false;

?>

<div class="project-column">
    <?php
    foreach($project_ids as $id) {
        the_block('project-card', [
            'project_id' => $id,
            'is_large_card' => $is_first_large_card
        ]);

        $is_first_large_card = !$is_first_large_card;
    }
    ?>
</div>