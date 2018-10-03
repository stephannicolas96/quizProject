<?php

$inputs = [
    (object) [
        'wrappingDivClasses' => 'input-field',
        'inputAttr' => 'id="username" type="text" name="username" maxlength="30" required',
        'labelContent' => USERNAME,
        'labelAttr' => 'username'
    ],
    (object) [
        'wrappingDivClasses' => 'input-field',
        'inputAttr' => 'id="email" type="email" name="email" maxlength="50" required',
        'labelContent' => EMAIL,
        'labelAttr' => 'email'
    ],
    (object) [
        'wrappingDivClasses' => 'input-field password',
        'inputAttr' => 'id="registrationPassword" type="password" name="registrationPassword"  maxlength="60" strength="0" required',
        'labelContent' => PASSWORD,
        'labelAttr' => 'registrationPassword'
    ]
];