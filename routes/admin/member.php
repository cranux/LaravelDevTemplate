<?php

Route::resource('member', 'MemberController', ['except' => [
    'create', 'store',
]]);
