<?php

test('landing page returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('MedRep');
    $response->assertSee('délégués médicaux');
});
