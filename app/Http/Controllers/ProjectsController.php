<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function all() {
        $projects = Project::all();
        return response()->json([
            'data' => $projects->map(function ($project) {
                return [
                    'id' => $project->id,
                    'name' => $project->name
                ];
            }),
        ]);
    }

    public function one($id) {
        try {
            $project = Project::query()->where('id', $id)->firstOrFail();

            return response()->json([
                'data' => $project,
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'data' => 'Not found'
            ])->setStatusCode(404);
        }
    }

    public function create() {
        $project = new Project();
        $project->name = 'New project';
        $project->content = '[]';
        $project->save();

        return response()->json([
            'data' => $project
        ]);
    }

    public function update(UpdateProjectRequest $request) {
        $name = $request->get("name", '-1');
        $content = $request->get("content", '-1');

        try {
            $project = Project::query()->where("id", $request->route()->parameter('id'))->firstOrFail();

            if($name != '-1') {
                $project->name = $name;
            }

            if($content != '-1') {
                $project->content = $content;
            }

            $project->save();
            return response()->json([
                'data' => $project
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ])->setStatusCode(404);
        }
    }
}
