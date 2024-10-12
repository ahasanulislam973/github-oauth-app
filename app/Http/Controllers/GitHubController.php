<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GitHubUser;
use App\Models\GitHubRepo;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

class GitHubController extends Controller
{
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            $repos = $this->getPublicRepositories($githubUser->token);

            $user = GitHubUser::updateOrCreate(
                ['github_id' => $githubUser->id],
                [
                    'username' => $githubUser->nickname,
                    'avatar' => $githubUser->avatar,
                    'bio' => $githubUser->user['bio'] ?? 'No bio available',
                    'public_repos_count' => $githubUser->user['public_repos'],
                ]
            );

            foreach ($repos as $repoData) {
                GitHubRepo::updateOrCreate(
                    [
                        'github_user_id' => $user->id,
                        'name' => $repoData['name'],
                    ],
                    [
                        'description' => $repoData['description'],
                        'stars' => $repoData['stargazers_count'],
                        'forks' => $repoData['forks_count'],
                        'language' => $repoData['language'],
                        'html_url' => $repoData['html_url'],
                    ]
                );
            }

            session(['github_user_id' => $user->id]);
            return redirect()->route('github.profile', ['github_id' => $githubUser->id]);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error logging in with GitHub.');
        }
    }


    private function getPublicRepositories($token)
    {
        $response = Http::withToken($token)
            ->get('https://api.github.com/user/repos', [
                'visibility' => 'public',
            ]);

        return $response->json();
    }
}
