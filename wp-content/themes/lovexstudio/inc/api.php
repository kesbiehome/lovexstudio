<?php

class My_REST_Posts_Controller
{
    // Here initialize our namespace and resource name.
    private $namespace;

    private $resource_name;

    public function __construct()
    {
        $this->namespace = 'lovexstudio/v1';
        $this->resource_name = 'loadMoreProjects';
    }

    // Register our routes.
    public function register_routes()
    {
        register_rest_route(
            $this->namespace, '/' . $this->resource_name,

            [
                'permission_callback' => '__return_true',
                'callback' => [$this, 'api_get_more_projects'],
                'args' => [
                    'termID' => [
                        'required' => true,
                        'validate_callback' => function ($param) {
                            return is_numeric($param);
                        },
                        'sanitize_callback' => 'absint'
                    ],
                    'postsPerPage' => [
                        'required' => false,
                        'validate_callback' => function ($param) {
                            return is_numeric($param);
                        },
                        'sanitize_callback' => 'absint'
                    ],
                    'paged' => [
                        'required' => false,
                        'validate_callback' => function ($param) {
                            return is_numeric($param);
                        },
                        'sanitize_callback' => 'absint'
                    ]
                ]
            ]
        );
    }

    public function get_more_projects($term_id, $posts_per_page = 6, $paged = 1)
    {
        $project_args = [
            'post_type' => 'project',
            'posts_per_page' => $posts_per_page,
            'fields' => 'ids',
            'paged' => $paged,
            'tax_query' => [
                [
                    'taxonomy' => 'project_cat',
                    'field' => 'term_id',
                    'terms' => $term_id
                ]
            ]
        ];

        $project_query = new WP_Query($project_args);

        if (!$project_query->have_posts()) {
            return [];
        }

        $project_ids = $project_query->posts;
        $max_num_pages = $project_query->max_num_pages;

        $columns = [];
        $column_index = 1;

        foreach ($project_ids as $id) {
            if ($column_index > 3) {
                $column_index = 1;
            }

            if (!$columns[$column_index]) {
                $columns[$column_index] = [];
            }

            array_push($columns[$column_index], $id);

            $column_index++;
        }

        $column_content = [];

        foreach ($columns as $index => $column) {
            ob_start();
            the_block('project-column', [
                'column_index' => $index,
                'project_ids' => $column
            ]);
            $column_content[] = ob_get_clean(); 
        }

        return [
            'args' => [
                'maxNumPages' => $max_num_pages,
                'nextPage' => (int) $max_num_pages > (int) $paged
            ],
            'html' => $column_content
        ];
    }

    public function api_get_more_projects($request)
    {
        $term_id = $request->get_param('termID');
        $posts_per_page = $request->get_param('postsPerPage') ?? 6;
        $paged = $request->get_param('paged') ?? 1;

        $result = $this->get_more_projects($term_id, $posts_per_page, $paged);

        return new WP_REST_Response($result, 200);
    }
}

function prefix_register_my_rest_routes()
{
    $controller = new My_REST_Posts_Controller();
    $controller->register_routes();
}

add_action('rest_api_init', 'prefix_register_my_rest_routes');