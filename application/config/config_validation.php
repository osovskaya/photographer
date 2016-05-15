<?php

/*
* Validation rules for Photographer REST API project
*/

// table fileds
$config['table_fields'] = array(
    'users' => array('role', 'name', 'username', 'password', 'phone'),
    'albums' => array('user', 'name'),
    'album/images' => array('album', 'name', 'image', 'type'),
    'reset' => array('password', 'code'),
    'resized' => array('size', 'photo_id', 'src', 'status', 'comment')
);

// users
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

// albums
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

// album/images
$config['album/images_post'] = array(
    array(
        'field' => 'album',
        'label' => 'album',
        'rules' => 'required|max_length[10]|integer'
    ),
    array(
        'field' => 'name',
        'label' => 'name',
        'rules' => 'required|max_length[50]'
    ),
    array(
        'field' => 'image',
        'label' => 'image',
        'rules' => 'required'
    ),
    array(
        'field' => 'type',
        'label' => 'type',
        'rules' => 'required|max_length[10]'
    )
);

$config['album/images_put'] = array(
    array(
        'field' => 'album',
        'label' => 'album',
        'rules' => 'max_length[10]|integer'
    ),
    array(
        'field' => 'name',
        'label' => 'name',
        'rules' => 'max_length[50]|alpha_numeric'
    ),
    array(
        'field' => 'type',
        'label' => 'type',
        'rules' => 'max_length[10]'
    )
);

// reset password
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

// resized
$config['resized_post'] = array(
    array(
        'field' => 'size',
        'label' => 'size',
        'rules' => 'required|max_length[10]|numeric'
    ),
    array(
        'field' => 'photo_id',
        'label' => 'photo_id',
        'rules' => 'required|max_length[10]|integer'
    ),
    array(
        'field' => 'src',
        'label' => 'src',
        'rules' => 'max_length[256]'
    ),
    array(
        'field' => 'status',
        'label' => 'status',
        'rules' => 'in_list[new,in_progress,complete,error]'
    ),
    array(
        'field' => 'comment',
        'label' => 'comment',
        'rules' => 'max_length[256]'
    )
);

$config['resized_put'] = array(
    array(
        'field' => 'size',
        'label' => 'size',
        'rules' => 'required|max_length[10]|numeric'
    ),
    array(
        'field' => 'photo_id',
        'label' => 'photo_id',
        'rules' => 'max_length[10]|integer'
    ),
    array(
        'field' => 'src',
        'label' => 'src',
        'rules' => 'max_length[256]'
    ),
    array(
        'field' => 'status',
        'label' => 'status',
        'rules' => 'in_list[new,in_progress,complete,error]'
    ),
    array(
        'field' => 'comment',
        'label' => 'comment',
        'rules' => 'max_length[256]'
    )
);
