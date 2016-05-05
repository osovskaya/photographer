<?php

/*
* Validation rules for Photographer REST API project
*/


$config['table_fields'] = array(
    'users' => array('role', 'name', 'username', 'password', 'phone'),
    'albums' => array('user', 'name'),
    'reset' => array('password', 'code')
);

$config['users_post'] = array(
    array(
    'field' => 'role',
    'label' => 'role',
    'rules' => 'required|in_list[client,photographer,admin]'
    ),
    array(
    'field' => 'name',
    'label' => 'name',
    'rules' => 'required|max_length[50]|alpha_numeric_spaces'
    ),
    array(
    'field' => 'username',
    'label' => 'Username',
    'rules' => 'required|max_length[50]|valid_email|is_unique[users.username]'
    ),
    array(
    'field' => 'password',
    'label' => 'Password',
    'rules' => 'required|max_length[50]|alpha_numeric'
    ),
    array(
    'field' => 'phone',
    'label' => 'phone',
    'rules' => 'exact_length[12]|numeric'
    )
    );

$config['users_put'] = array(
    array(
        'field' => 'role',
        'label' => 'role',
        'rules' => 'in_list[client,photographer,admin]'
    ),
    array(
        'field' => 'name',
        'label' => 'name',
        'rules' => 'max_length[50]|alpha_numeric_spaces'
    ),
    array(
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'max_length[50]|is_unique[users.username]'
    ),
    array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'max_length[50]|alpha_numeric'
    ),
    array(
        'field' => 'phone',
        'label' => 'phone',
        'rules' => 'exact_length[12]|numeric'
    )
);

$config['albums_post'] = array(
    array(
        'field' => 'name',
        'label' => 'name',
        'rules' => 'required|max_length[50]|alpha_numeric_spaces'
    ),
    array(
        'field' => 'user',
        'label' => 'User',
        'rules' => 'required|max_length[10]|integer'
    )
);

$config['albums_put'] = array(
    array(
        'field' => 'name',
        'label' => 'name',
        'rules' => 'max_length[50]|alpha_numeric_spaces'
    ),
    array(
        'field' => 'user',
        'label' => 'User',
        'rules' => 'max_length[10]|integer'
    )
);

$config['reset_post'] = array(
    array(
        'field' => 'email',
        'label' => 'email',
        'rules' => 'required|max_length[50]|valid_email'
    )
);

$config['reset_put'] = array(
    array(
        'field' => 'password',
        'label' => 'password',
        'rules' => 'required|max_length[50]|alpha_numeric'
    ),
    array(
        'field' => 'code',
        'label' => 'code',
        'rules' => 'required|alpha_numeric'
    )
);
