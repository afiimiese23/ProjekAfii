<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Testimonial
            </h6>
            <h1 class="mb-5">penilaian Layanan</h1>
        </div>

        <div class="owl-carousel testimonial-carousel position-relative">

            @foreach ($testimonials as $item)
                <div class="testimonial-item text-center">

                    {{-- Foto Warga --}}
                    <img class="border rounded-circle p-2 mx-auto mb-3"
                        src="{{ 
                            !empty($item->pengaduan->warga->profile_picture)
                                ? asset('storage/' . $item->pengaduan->warga->profile_picture)
                                : asset('img/default-user.png')}}"
                        style="width: 80px; height: 80px; object-fit: cover;">


                    {{-- Nama --}}
                    <h5 class="mb-0">
                        {{ $item->pengaduan->warga->nama ?? 'Anonim' }}
                    </h5>

                    {{-- Pekerjaan --}}
                    <p>{{ $item->pengaduan->warga->pekerjaan ?? 'Warga' }}</p>

                    {{-- Komentar --}}
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">
                            "{{ $item->komentar }}"
                        </p>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Testimonial End -->
