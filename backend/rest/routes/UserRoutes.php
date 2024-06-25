<?php

require_once __DIR__ . "/../services/UserService.class.php";

Flight::set("userService", new UserService());

Flight::group("/users", function () {
    Flight::route("GET /", function () {
        $data = Flight::get("userService")->getUsers();
        Flight::json($data);
    });

    Flight::route("GET /@user_id", function ($user_id) {
        $data = Flight::get("userService")->getUserByID($user_id);
        Flight::json($data);
    });

    Flight::route("POST /add", function () {
        $payload = Flight::request()->data->getData();


        if (isset($payload['id']) && $payload['id'] !== NULL && $payload['id'] !== '') {
            Flight::get("userService")->editUser($payload);
        } else {
            unset($payload['id']);
            $user = Flight::get("userService")->addUser($payload);
        }

        Flight::json($user);
    });

    Flight::route("DELETE /delete/@user_id", function ($user_id) {
        if ($user_id == NULL || $user_id == '') {
            Flight::halt(500, "You have to provide a valid position ID!");
        }

        Flight::get("userService")->deleteUser($user_id);
        Flight::json(['message' => "You have successfully deleted the position!"]);
    });
});
