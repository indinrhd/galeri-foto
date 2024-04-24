<x-app-layout>
    <div class="flex w-9 justify-center">

    <form method="post" action="{{ route('post.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')

        {{-- <div>
            <x-text-input id="user_id" name="user_id" type="text" class="mt-1 w-full hidden" required autofocus autocomplete="user_id" />
            <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
        </div>

        <div>
            <x-text-input id="tanggal_unggah" name="tanggal_unggah" type="date" class="mt-1 w-full hidden" required autofocus autocomplete="tanggal_unggah" />
            <x-input-error class="mt-2" :messages="$errors->get('tanggal_unggah')" />
        </div> --}}

        <div>
            <x-input-label for="judul_foto" :value="__('Judul')" />
            <x-text-input id="judul_foto" name="judul_foto" type="text" class="mt-1 block w-full" required autofocus autocomplete="judul_foto" />
            <x-input-error class="mt-2" :messages="$errors->get('judul_foto')" />
        </div>

        <div>
            <x-input-label for="deskripsi_foto" :value="__('Deskripsi')" />
            <x-text-input id="deskripsi_foto" name="deskripsi_foto" type="text" class="mt-1 block w-full" required autofocus autocomplete="deskripsi_foto" />
            <x-input-error class="mt-2" :messages="$errors->get('deskripsi_foto')" />
        </div>

        <div>
            <x-input-label for="lokasi_file" :value="__('Gambar')" />
            <input id="lokasi_file" name="lokasi_file" type="file" class="form-control mt-1 block w-full" required autofocus autocomplete="lokasi_file" />
            <x-input-error class="mt-2" :messages="$errors->get('lokasi_file')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
    </div> 

    <div class="container bg-white mt-3 mb-4">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    My Gallery
                </div>
            </div>
        </div>
    </div>
        
    @if($fotos->count())
        <div class="row">
            @foreach($fotos as $foto)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('images/'.$foto->lokasi_file) }}" class="card-img-top">
                    <div class="card-body">
                        {{-- <a class="btn btn-default btn-xs" href="#"><i class="bi bi-chat"></i> Comment</a>
                    <span class="btn btn-default btn-xs">2</span>
                    <span class="btn btn-default btn-xs"><i class="bi bi-hand-thumbs-up"></i></span>
                    <span class="btn btn-default btn-xs">2</span> --}}
                    <h5 class="card-title">{{ $foto->judul_foto }}</h5>
                    <p class="card-text">{{ $foto->deskripsi_foto }}</p>
                    <p class="card-text text-secondary">By. {{ $foto->user->nama_lengkap }}, <small class="text-muted">{{ $foto->tanggal_unggah }}</small></p>
                
                    
                        {{-- <button type="submit" class="btn btn-warning">Edit</button> --}}
                        
                        <a href="/foto/{{ $foto->slug }}"
                            class="btn btn-secondary col-md-12">More
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
    <p class="text-center fs-4">No post found.</p>
    @endif
</x-app-layout>
