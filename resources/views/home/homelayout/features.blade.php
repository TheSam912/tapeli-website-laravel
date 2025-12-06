<div class="lonyo-section-padding2 position-relative">
    <div class="container">
        <div class="lonyo-section-title center">
            <h2>Features that make spending smarter</h2>
        </div>
        @php
            $features = App\Models\Feature::latest()->get();
        @endphp
        <div class="row">
            @foreach ($features as $item)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="lonyo-service-wrap light-bg" data-aos="fade-up" data-aos-duration="500">
                        <div class="lonyo-service-title">
                            <h4>{{ $item->title }}</h4>
                            <img src="{{ asset('frontend/assets/images/v1/' . $item->icon . '.svg') }}" alt="">
                        </div>
                        <div class="lonyo-service-data">
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="lonyo-feature-shape"></div>
</div>