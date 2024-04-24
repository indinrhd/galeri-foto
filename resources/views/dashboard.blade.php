<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($foto as $fotos)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('images/'.$fotos->lokasi_file) }}" class="card-img-top">
                <div class="card-body">
                    <a class="btn btn-default btn-xs" href="/foto/{{ $fotos->slug }}"><i class="bi bi-chat"></i> Comment</a>
                    
                    @auth
                    @if ($fotos->hasLike)
                    <a href="/like/{{ $fotos->id }}" class="text-danger text-decoration-none">
                        <i class="bi bi-heart-fill me-1"></i>({{ $fotos->totalLikes() }})
                    </a>
                    @else
                        <a href="/like/{{ $fotos->id }}" class="text-dark text-decoration-none">
                            <i class="bi bi-heart-fill me-1"></i>({{ $fotos->totalLikes() }})
                        </a>
                    @endif
                @endauth
                @guest
                    @if ($fotos->hasLikee)
                    <a class="text-danger text-decoration-none" href="/likee/{{ $foto->id }}">
                        <i class="bi bi-heart-fill me-1"></i>({{ $fotos->totalLikes() }})
                    </a>
                    @else
                        <a class="text-dark text-decoration-none" href="/likee/{{ $foto->id }}">
                            <i class="bi bi-heart-fill me-1"></i>({{ $fotos->totalLikes() }})
                        </a>
                    @endif
                @endguest


                    <h5 class="card-title">{{ $fotos->judul_foto }}</h5>
                    <p class="card-text">{{ $fotos->deskripsi_foto }}</p>
                    <p class="card-text text-secondary">By. {{ $fotos->user->nama_lengkap }}, <small class="text-muted">{{ $fotos->tanggal_unggah }}</small></p>
                </div>
                </div>
            </div>
            @endforeach
        </div>
</x-app-layout>