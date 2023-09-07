<?php

return [
    '/api/users' => 'ApiController@getUsers',
    '/api/posts' => 'PostController@getPosts',
    '/api/users/{id:[a-zA-Z0-9]+}' => 'ApiController@getUserID',
    // Add more routes as needed
];


