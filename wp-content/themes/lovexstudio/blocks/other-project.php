<?php

$project_id = get_the_id();
$project_terms = get_the_terms($project_id, 'project_cat');

$project_term_ids = [];
foreach ($project_terms as $project_term) {
    $project_term_ids[] = $project_term->term_id;
}

$project_relate = get_project_by_term_id($project_term_ids, [
    'post__not_in' => [$project_id]
], 4);

$project_relate_ids = $project_relate['project_ids'];

if (($key = array_search($project_id, $project_relate_ids)) !== false) {
    unset($project_relate_ids[$key]);
}

if (empty($project_relate_ids)) {
    return;
}

?>
<div class="other-project">
    <div class="other-project__container">
        <h2 class="other-project__title">
            <?php echo __('Related Projects', 'lovexstudio'); ?>
        </h2>
        <div class="other-project__list">
            <?php
            foreach ($project_relate_ids as $id) {
                the_block('project-card', [
                    'project_id' => $id
                ]);
            }
            ?>
        </div>
        <div class="other-project__button">
            <button class="btn other-project__link">
                <?php echo __('See more', 'lovexstudio'); ?>
            </button>
        </div>
    </div>
</div>