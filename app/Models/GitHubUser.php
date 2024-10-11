<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GitHubUser extends Model
{
    use HasFactory;

    protected $fillable = ['github_id', 'username', 'avatar', 'bio', 'public_repos_count'];

    public function repositories()
    {
        return $this->hasMany(GitHubRepo::class, 'github_user_id');
    }
}
