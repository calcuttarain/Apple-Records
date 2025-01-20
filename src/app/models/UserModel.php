<?php

class UserModel {
    use Model;

    protected $table = "users";
    protected $allowedColumns = [
        "first_name",
        "last_name",
        "email",
        "password",
        "type"
    ];
}
