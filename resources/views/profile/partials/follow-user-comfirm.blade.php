<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('follow') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('フォロー数・フォロワー数を確認する場所です') }}
        </p>
    </header>


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $user->name }}'s Profile</h2>

                <div>
                    <strong>フォロー数: </strong>{{ $user->followee_id->count() }}人
                    <strong>フォロワー数: </strong>{{ $user->follower_id->count() }}人
                </div>

                <div class="mt-4">
                    @if(Auth::check() && Auth::id() != $user->id)
                    @php
                    $isFollowing = Auth::user()->following->contains($user->id);
                    @endphp

                    <form id="followForm" action="{{ $isFollowing ? route('follow.remove') : route('follow.add') }}" method="POST">
                        @csrf
                        @if($isFollowing)
                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                        @else
                        <button type="submit" class="btn btn-primary">フォローする</button>
                        @endif
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </form>
                    @endif
                </div>

                <div class="mt-4">
                    <h3>フォロー中のユーザー</h3>
                    <ul>
                        @foreach ($user->followee_id as $followee_id)
                        <li>{{ $followee_id->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-4">
                    <h3>フォロワー</h3>
                    <ul>
                        @foreach ($user->follower_id as $follower_id)
                        <li>{{ $follower_id->name }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>


</section>