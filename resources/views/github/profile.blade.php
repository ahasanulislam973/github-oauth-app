@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile text-center">
        <img src="{{ $avatar }}" alt="Profile picture" class="profile-img img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
        <h2>{{ $username }}</h2>
        <p>{{ $bio }}</p>
        <p>Public Repositories: {{ $public_repos_count }}</p>
    </div>

    <form method="GET" action="{{ route('github.profile', ['github_id' => $githubUser->github_id]) }}" class="mb-3 d-flex">
        <input type="text" name="search" placeholder="Search repositories..." value="{{ request('search') }}" class="form-control mb-2" style="max-width: 300px;">
        <button type="submit" class="btn btn-primary mb-2 mx-2">Search</button>
        <a href="{{ route('github.profile', ['github_id' => $githubUser->github_id]) }}" class="btn btn-secondary mb-2">Reset</a>
    </form>

    <div class="repositories">
        <h3>Public Repositories</h3>
        <ul class="list-group">
            @forelse($repositories as $repo)
                <li class="list-group-item">
                    <h4>{{ $repo->name }}</h4>
                    <p>{{ $repo->description }}</p>
                    <p>
                        Stars: {{ $repo->stars }} | Forks: {{ $repo->forks }} | Language: {{ $repo->language }}
                    </p>
                    <a href="{{ $repo->html_url }}" target="_blank" class="btn btn-secondary">View on GitHub</a>
                </li>
            @empty
                <li class="list-group-item">No repositories found.</li>
            @endforelse
        </ul>

        <div class="mt-3">
            {{ $repositories->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
