<?php

return [

    ['GET', '/job/post', function() {
        session_start();
        echo render_view('job/post.php');
        unset($_SESSION['success'], $_SESSION['publish'], $_SESSION['spam']);
    }],

    ['GET', '/job/{id:[1-9]+\d*}/{action:publish|spam}', function(array $vars = []) {
        extract($vars);
        $job = new \App\Models\Job([]);
        $job->setId($id);
        $job->$action();
        session_start();
        $_SESSION[$action] = true;
        header('Location: /job/post');
    }],

    ['POST', '/job/post', function() {
        $job = new \App\Models\Job($_POST);

        if (!$job->isValid())
        {
            $errors = $job->getMessages();
            $data = $job->getOriginal();
            echo render_view('job/post.php', ['data' => $data, 'errors' => $errors]);
        }

        if ($job->save())
        {
            session_start();
            $_SESSION['success'] = true;
            header('Location: /job/post');
        }
    }],

];
