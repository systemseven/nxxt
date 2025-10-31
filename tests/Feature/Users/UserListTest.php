<?php

//rename this to user auth test and do the same thing you did with roles...
test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
})->skip();
