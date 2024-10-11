<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GitHubUser;
use App\Models\GitHubRepo;

class GitHubUserController extends Controller
{
    public function showProfile(Request $request, $github_id)
    {
        $githubUser = GitHubUser::where('github_id',$github_id)->first();
        $search = $request->input('search');
        $repositoriesQuery = GitHubRepo::where('github_user_id', $githubUser->id);

        if ($search) {
            $repositoriesQuery->where('name', 'LIKE', "%{$search}%");
        }

        $repositories = $repositoriesQuery->paginate(10);
        return view('github.profile', [
            'username' => $githubUser->username,
            'avatar' => $githubUser->avatar,
            'bio' => $githubUser->bio,
            'public_repos_count' => $githubUser->public_repos_count,
            'repositories' => $repositories,
            'githubUser' => $githubUser,
        ]);
    }
    
}
