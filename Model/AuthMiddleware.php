<?php
class AuthMiddleware {

//This is the method that will help us handle the authentication and redirect
//This takes 2 args, the user group of the current user and the requested path from that user
    public function handle($userGroup, $requestedPath) {
        $paths = [
        
            'FINANCE' => ['stockCheckFinance.php'],
            'ADMIN' => [
                'adminIndex.php',
                'insertStock.php',
                'manage-ticket.php',
                'stockcheck.php',
                'view-tickets.php'
            ],
        ];
        
        //If the path this specific usr is not in the allowed paths for that user, they get redirected
        if (!in_array($requestedPath, $paths[$userGroup])) {
            exit();
        }
        return true;
    }
}