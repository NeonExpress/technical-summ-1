<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class Pages extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $today = date('Y-m-d');

        $data = [
            'title' => 'Welcome',
            'today' => $today,
            'tasks' => $taskModel
                ->where('task_date', $today)
                ->orderBy('created_at', 'ASC')
                ->findAll()
        ];

        return view('pages/welcome', $data);
    }

    public function tasks()
    {
        $taskModel = new TaskModel();

        $data = [
            'title' => 'Task List',
            'tasks' => $taskModel
                ->orderBy('task_date', 'ASC')
                ->orderBy('created_at', 'ASC')
                ->findAll()
        ];

        return view('pages/tasks', $data);
    }

    public function profile()
    {
        $userModel = new UserModel();

        $data = [
            'title' => 'Profile',
            'user' => $userModel->first()
        ];

        return view('pages/profile', $data);
    }

    public function about()
    {
        return view('pages/about', [
            'title' => 'About'
        ]);
    }
}