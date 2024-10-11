<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GitHubRepo extends Model
{
    use HasFactory;

    protected $fillable = ['github_user_id', 'name', 'description', 'stars', 'forks', 'language', 'html_url'];

    public function user()
    {
        return $this->belongsTo(GitHubUser::class, 'github_user_id');
    }
}
