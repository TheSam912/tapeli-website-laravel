<div class="lonyo-section-padding2 position-relative">
    <div class="container">
        <div class="lonyo-section-title">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <h2>Don't Miss Our Blogs!</h2>
                </div>
                <div class="col-xl-4 col-lg-4 d-flex align-items-center justify-content-end">
                    <div class="lonyo-title-btn">
                        <a class="lonyo-default-btn t-btn" href="{{ route('all.posts.page') }}">See All</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="posts-section">
            <div class="posts-container">
                @php
                    $posts = App\Models\Post::latest()->get();
                @endphp
                <div class="posts-grid">
                    @foreach ($posts as $post)
                        <article class="post-card">
                            <div class="post-card__image-wrapper">
                                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="post-card__image">
                            </div>

                            <div class="post-card__content">
                                <div class="post-card__meta">
                                    <span class="post-card__author">
                                        {{ $post->author->name ?? $post->author_name ?? 'Unknown Author' }}
                                    </span>

                                    <span class="post-card__dot">&bull;</span>
                                    @if(isset($post->created_at))
                                        <span class="post-card__date">
                                            {{ $post->created_at->format('M d, Y') }}
                                        </span>
                                    @endif

                                    <span class="post-card__dot">&bull;</span>

                                    <span class="post-card__read-time">
                                        {{ $post->read_time ?? 5 }} min read
                                    </span>
                                </div>

                                <h3 class="post-card__title">
                                    {{ $post->title }}
                                </h3>

                                <p class="post-card__description">
                                    {{ \Illuminate\Support\Str::limit($post->description, 130) }}
                                </p>

                                @if(!empty($post->images) && count($post->images))
                                    <div class="post-card__image-list">
                                        @foreach ($post->images as $image)
                                            <img src="{{ $image->url }}" alt="{{ $post->title }} extra image"
                                                class="post-card__thumb">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
    <div class="lonyo-feature-shape"></div>
</div>