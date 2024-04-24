<?php

$columns = [];

$column_index = 1;

foreach ($project_ids as $id) {
    if ($column_index > 2) {
        $column_index = 1;
    }

    if (empty($columns[$column_index])) {
        $columns[$column_index] = [];
    }

    array_push($columns[$column_index], $id);

    $column_index++;
}

?>
<div class="project-grid">
    <?php
    foreach ($columns as $index => $column) {
        the_block('project-column', [
            'column_index' => $index,
            'project_ids' => $column
        ]);
    }
    ?>

</div>
<?php
