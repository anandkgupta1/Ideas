@extends('layout.layout')
@include('partials.profile_popup')
@section('content')
    <div class="row">
        <div class="col-3">
            <div class="card overflow-hidden">
                <div class="card-body pt-3">
                    <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="nav-item d-none">
                            <a class="nav-link" href="{{ route('explore') }}">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('feedback.form') }}">FeedBack</a>
                        </li>
                        <li class="nav-item d-none">
                            <a class="nav-link" href="{{ route('terms') }}">Terms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('support') }}">Support</a>
                        </li>
                        <li class="nav-item d-none">
                            <a class="nav-link" href="{{ route('setting') }}">Settings</a>
                        </li>
                    </ul>
                </div>
                @if (Auth::check())
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link btn-sm" href="#" onclick="openPopup(event); return false;">View
                            Profile</a>
                    </div>
                @endif
            </div>


            <div class="feedback-section mt-4">
                <div class="card mt-3">
                    <div class="card-header pb-0 border-0">
                        <h5>Feedback</h5>
                    </div>
                    <div class="card-body">
                        <!-- Feedback Items Container -->
                        <div id="feedback-container">
                            @forelse ($feedbacks as $index => $feedback)
                                <div class="card mt-2 feedback-item" style="{{ $index >= 2 ? 'display: none;' : '' }}">
                                    <div class="card-body">
                                        <p><strong>Name:</strong> {{ $feedback->user->name ?? 'Anonymous' }}</p>
                                        <p><strong>Rating:</strong> {{ $feedback->rating }}</p>
                                        <p>{{ $feedback->comments }}</p>
                                        <p class="text-muted">Submitted on: {{ $feedback->created_at->format('d-m-Y') }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p>No feedback available.</p>
                            @endforelse
                        </div>

                        <!-- Show More Button -->
                        @if (count($feedbacks) > 2)
                            <button id="show-more-btn" class="btn btn-primary mt-3">Show More</button>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="col-6">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h4>Share Your Ideas</h4>
            <div class="row">
                <div class="mb-3">
                    <textarea class="form-control" id="idea" rows="3" placeholder="Share your thoughts..."></textarea>
                </div>
                <div>
                    <button class="btn btn-dark" id="shareButton">Share</button>
                </div>
            </div>
            <hr>

            <div id="ideasContainer">
                @php
                    $userCount = 0;
                @endphp
                @foreach ($ideas->groupBy('user_id') as $userId => $userIdeas)
                    @php
                        $user = \App\Models\User::find($userId); // Get user for each user_id
                        $userCount++;
                    @endphp
                    <div class="user-ideas" id="user-ideas-{{ $userId }}"
                        @if ($userCount > 2) style="display: none;" @endif>
                        <div class="mt-3">
                            <div class="card">
                                <div class="px-3 pt-4 pb-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                                                src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ $user->name }}"
                                                alt="{{ $user->name }}">
                                            <div>
                                                <h5 class="card-title mb-0">{{ $user->name ?? 'Guest' }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach ($userIdeas as $idea)
                                        <div class="d-flex justify-content-between">
                                            <p class="fs-6 fw-light text-muted">{{ $idea->content }}</p>
                                            <span
                                                class="fs-6 fw-light text-muted">{{ $idea->created_at->format('d-m-Y') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            @php
                                                $userLiked = auth()->check()
                                                    ? \App\Models\Like::where('idea_id', $idea->id)
                                                        ->where('user_id', auth()->id())
                                                        ->exists()
                                                    : false;
                                            @endphp
                                            <a href="javascript:void(0)" class="fw-light nav-link fs-6 like-btn"
                                                data-idea-id="{{ $idea->id }}"
                                                data-liked="{{ $userLiked ? 'true' : 'false' }}">
                                                <i class="fa fa-heart heart-icon"
                                                    style="color: {{ $userLiked ? 'red' : '#b6b2de' }}"></i>
                                                <span class="like-count">{{ $idea->likes()->count() }}</span>
                                            </a>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Show More Button -->
                @if ($userCount > 2)
                    <div id="showMoreBtnContainer">
                        <button class="btn btn-primary mt-3" id="showMoreBtn">Show More</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-3">
            <div class="card d-none">
                <div class="card-header pb-0 border-0">
                    <h5>Search</h5>
                </div>
                <div class="card-body">
                    <input placeholder="Search..." class="form-control w-100" type="text" id="search">
                    <button class="btn btn-dark mt-2" id="searchBtn">Search</button>
                </div>
            </div>

            <div id="searchResults">
                <!-- Search results will be inserted here -->
            </div>

            <div class="card mt-3">
                <div class="card-header pb-0 border-0">
                    <h5>Who to Follow</h5>
                </div>
                <div class="card-body">
                    <!-- Follow Suggestion List -->
                    <div class="follow-list">
                        @foreach ($users as $index => $user)
                            <div class="hstack gap-2 mb-3 follow-item @if ($index >= 3) d-none @endif">
                                <div class="avatar">
                                    <a href="#!">
                                        <img class="avatar-img rounded-circle"
                                            src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ $user->name }}"
                                            alt="{{ $user->name }}">
                                    </a>
                                </div>
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0" href="#!">{{ $user->name }}</a>
                                    <p class="mb-0 small text-truncate">{{ '@' . strtolower($user->name) }}</p>
                                </div>

                                @php
                                    // Check if the logged-in user is already following this user
                                    $isFollowing = \App\Models\Follow::where('follower_id', auth()->id())
                                        ->where('followed_id', $user->id)
                                        ->exists();
                                @endphp

                                <button class="btn btn-primary-soft rounded-circle icon-md ms-auto follow-btn"
                                    data-user-id="{{ $user->id }}">
                                    <i class="fa-solid {{ $isFollowing ? 'fa-check' : 'fa-plus' }}"></i>
                                    <span>{{ $isFollowing ? 'Following' : 'Follow' }}</span>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <!-- Show More / Show Less Button -->
                    <div class="d-grid mt-3">
                        <button class="btn btn-sm btn-primary-soft" id="toggleFollowList">Show More</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        var csrfToken = '{{ csrf_token() }}';
        document.getElementById('shareButton').addEventListener('click', function() {
            var ideaContent = document.getElementById('idea').value;

            if (ideaContent.trim() === "") {
                alert("Please share your idea before submitting.");
                return;
            }

            var csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenElement) {
                alert("CSRF token not found.");
                return;
            }
            var csrfToken = csrfTokenElement.getAttribute('content');

            fetch("{{ route('ideas.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        content: ideaContent
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        var newIdea = `
                        <div class="mt-3">
                            <div class="card">
                                <div class="px-3 pt-4 pb-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=User" alt="User Avatar">
                                            <div>
                                                <h5 class="card-title mb-0">{{ Auth::user()->name ?? 'Guest' }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="fs-6 fw-light text-muted">${ideaContent}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="fw-light nav-link fs-6 like-button" data-idea-id="${data.idea.id}">
                                            <span class="fas fa-heart me-1"></span> 
                                            <span class="like-count">0</span> <!-- Default like count -->
                                        </a>
                                        <span class="fs-6 fw-light text-muted">${new Date().toLocaleDateString()}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                        document.getElementById('ideasContainer').insertAdjacentHTML('afterbegin', newIdea);
                        document.getElementById('idea').value = '';
                    } else {
                        alert("Failed to share idea. Please try again.");
                    }
                })
                .catch(error => {
                    console.error('There was an error:', error);
                    alert("An error occurred while sharing your idea.");
                });
        });

        document.getElementById('showMoreBtn').addEventListener('click', function() {
            const hiddenUserIdeas = document.querySelectorAll('.user-ideas[style="display: none;"]');
            hiddenUserIdeas.forEach(function(idea) {
                idea.style.display = 'block';
            });
            document.getElementById('showMoreBtnContainer').style.display = 'none'; // Hide "Show More" button
        });

        // Handle the Like button click event
        $(document).on('click', '.like-btn', function(e) {
            e.preventDefault();

            var ideaId = $(this).data('idea-id');
            var likeButton = $(this);
            var heartIcon = likeButton.find('.heart-icon');
            var likeCount = likeButton.find('.like-count');

            $.ajax({
                url: '/ideas/' + ideaId + '/like',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        likeCount.text(response.likes);
                        // ✅ liked field se heart color toggle hoga
                        if (response.liked) {
                            heartIcon.css('color', 'red');
                            likeButton.data('liked', 'true');
                        } else {
                            heartIcon.css('color', '#b6b2de');
                            likeButton.data('liked', 'false');
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    if (xhr.status === 401 || xhr.status === 200) {
                        alert('Please login to like ideas.');
                    } else {
                        alert('Like failed. Please try again.');
                    }
                }
            });
        });
    </script>
    <!-- JavaScript for Show More functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreBtn = document.getElementById('show-more-btn');
            const feedbackItems = document.querySelectorAll('.feedback-item');

            if (showMoreBtn) {
                showMoreBtn.addEventListener('click', function() {
                    feedbackItems.forEach((item, index) => {
                        if (index >= 2) {
                            item.style.display = item.style.display === 'none' ? 'block' : 'none';
                        }
                    });

                    // Toggle button text
                    showMoreBtn.textContent =
                        showMoreBtn.textContent === 'Show More' ? 'Show Less' : 'Show More';
                });
            }
        });
        //  for follow user
        $(document).on('click', '.follow-btn', function() {
            var button = $(this);
            var followedId = button.data('user-id');
            var action = button.find('span').text().trim() === 'Follow' ? 'follow' : 'unfollow';

            $.ajax({
                url: '/follow/' + followedId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    action: action // Send follow/unfollow action
                },
                success: function(response) {
                    if (response.message === 'Following' || response.message === 'Unfollowed') {
                        if (response.message === 'Following') {
                            button.find('i').removeClass('fa-plus').addClass('fa-check');
                            button.find('span').text('Following');
                        } else if (response.message === 'Unfollowed') {
                            button.find('i').removeClass('fa-check').addClass('fa-plus');
                            button.find('span').text('Follow');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error (optional)
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        // Handle the Show More / Show Less functionality
        $(document).on('click', '#toggleFollowList', function() {
            var button = $(this);
            var followItems = $('.follow-item');

            // Toggle visibility of follow items
            if (button.text() === 'Show More') {
                followItems.removeClass('d-none'); // Show all users
                button.text('Show Less');
            } else {
                followItems.slice(3).addClass('d-none'); // Hide users after the first 3
                button.text('Show More');
            }
        });
    </script>
    <script>
        document.getElementById('searchBtn').addEventListener('click', function() {
            var searchQuery = document.getElementById('search').value.trim().toLowerCase();

            if (searchQuery === "") {
                alert("Please enter a username to search.");
                return;
            }

            var filteredUsers =
                @json($users); // Get the list of users from the backend (already in the page's blade template)

            // Find the user that matches the search query
            var foundUser = filteredUsers.find(user => user.name.toLowerCase().includes(searchQuery));

            if (foundUser) {
                // Display the user's ideas
                var userIdeasHTML = `
                <h4>Ideas from ${foundUser.name}</h4>
                <div class="user-ideas">
                    ${foundUser.ideas.map(idea => `
                                                    <div class="card mt-3">
                                                        <div class="card-body">
                                                            <p>${idea.content}</p>
                                                            <span class="fs-6 fw-light text-muted">${idea.created_at}</span>
                                                        </div>
                                                    </div>
                                                `).join('')}
                </div>
            `;
                document.getElementById('searchResults').innerHTML = userIdeasHTML;
            } else {
                // No user found
                document.getElementById('searchResults').innerHTML = "<p>No user found with that name.</p>";
            }
        });
    </script>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
