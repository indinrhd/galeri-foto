<x-app-layout>
    <div class="flex w-9 justify-center">
<form method="post" action="{{ route('post.update', $foto->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div>
        <x-input-label for="judul_foto" :value="__('Judul Foto')" />
        <x-text-input id="judul_foto" name="judul_foto" type="text" class="mt-1 block w-full" :value="old('judul_foto', $foto->judul_foto)" required autofocus autocomplete="judul_foto" />
        <x-input-error class="mt-2" :messages="$errors->get('judul_foto')" />
    </div>

    <div>
        <x-input-label for="deskripsi_foto" :value="__('Deskripsi Foto')" />
        <x-text-input id="deskripsi_foto" name="deskripsi_foto" type="text" class="mt-1 block w-full" :value="old('deskripsi_foto', $foto->deskripsi_foto)" required autofocus autocomplete="deskripsi_foto" />
        <x-input-error class="mt-2" :messages="$errors->get('deskripsi_foto')" />
    </div>

    <div>
        <x-input-label for="lokasi_file" :value="__('Gambar')" />
        <input class="form-control mt-1 block w-full" accept="image/*" id="lokasi_file" name="lokasi_file" type="file" class="mt-1 block w-full" :value="old('lokasi_file', $foto->lokasi_file)"  autofocus autocomplete="lokasi_file" />
        <x-input-error class="mt-2" :messages="$errors->get('lokasi_file')" />
    </div>


    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </form>
    <a href="{{ route('post.index') }}">
    <x-danger-button type="button">{{ __('Back') }}</x-danger-button>
    </a>
</div>
</div>
</x-app-layout>