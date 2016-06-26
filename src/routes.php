<?php
Route::get('/clockwork-show', [
    'as'    => 'clockwork.show',
    'uses'  => 'KalebClark\ClockworkView\ClockworkViewController@show'
]);