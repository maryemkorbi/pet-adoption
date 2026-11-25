<?php

test('the home page redirects to the animals list', function () {
    $this->get('/')->assertRedirect(route('animals.index'));
});
