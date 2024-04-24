<div>
    @auth
        <form wire:submit.prevent="store" class="mb-4">
            <div class="mb-3">
                <textarea wire:model.defer="isi_komentar" rows="2" class="form-control @error('isi_komentar') is-invalid @enderror" placeholder="Tulis  Komentar..."></textarea>
                @error('isi_komentar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid">
             <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    @endauth
    @guest
        <form wire:submit.prevent="storee" class="mb-4">
            <div class="mb-3">
                <textarea wire:model.defer="isi_komentar" rows="2" class="form-control @error('isi_komentar') is-invalid @enderror" placeholder="Tulis  Komentar..."></textarea>
                @error('isi_komentar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid">
             <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    @endguest

    @foreach ($comments as $item)
    <div class="mb-3" id="comment-{{ $item->id }}">
        <div class="d-flex align-items-start mb-3">
            <img src="https://i.pinimg.com/736x/c0/27/be/c027bec07c2dc08b9df60921dfd539bd.jpg" class="img-fluid rounded-circle me-2" width="40" alt="user_comment">
            <div>
                <div>
                    <span>{{ $item->user->nama_lengkap }}</span>,
                    <span>{{ $item->created_at }}</span>
                </div>
                <div class="text-secondary mb-2">
                    {{ $item->isi_komentar }}
                </div>
                <div>
                    @auth
                        {{-- <button wire:click="selectReply({{ $item->id }})" class="btn btn-sm btn-primary">Balas</button> --}}
                        @if ($item->user_id == Auth::user()->id)
                            <button class="btn btn-sm btn-warning" wire:click="selectEdit({{ $item->id }})">Edit</button>
                            <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
                        @endif
                    @endauth
                </div>

                {{-- @if (isset($comment_id) && $comment_id == $item->id)
                    <form wire:submit.prevent="reply" class="my-3">
                        <div class="mb-3">
                            <textarea wire:model.defer="isi_komentar2" rows="2" class="form-control @error('isi_komentar2') is-invalid @enderror" placeholder="Tulis  Komentar..."></textarea>
                            @error('isi_komentar2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Balas</button>
                        </div>
                    </form>
                @endif --}}

                @if (isset($edit_comment_id) && $edit_comment_id == $item->id)
                    <form wire:submit.prevent="change" class="my-3">
                        <div class="mb-3">
                            <textarea wire:model.defer="isi_komentar2" rows="2" class="form-control @error('isi_komentar2') is-invalid @enderror" placeholder="Tulis  Komentar..."></textarea>
                            @error('isi_komentar2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning">Ubah</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        @if ($item->childrens)
            @foreach ($item->childrens as $item2)
            <div class="d-flex align-items-start ms-4">
                <img src="https://i.pinimg.com/736x/c0/27/be/c027bec07c2dc08b9df60921dfd539bd.jpg" class="img-fluid rounded-circle me-2" width="40" alt="user_comment">
                <div>
                    <div>
                        <span>{{ $item2->user->nama_lengkap }}</span>,
                        <span>{{ $item2->created_at }}</span>
                    </div>
                    <div class="text-secondary mb-2">
                        {{ $item2->isi_komentar }}
                    </div>
                    <div>
                        @auth
                        {{-- <button class="btn btn-sm btn-primary" wire:click="selectReply({{ $item2->id }})">Balas</button> --}}
                        @if ($item2->user_id == Auth::user()->id)
                            <button class="btn btn-sm btn-warning" wire:click="selectEdit({{ $item2->id }})">Edit</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $item2->id }})">Hapus</button>
                        @endif
                        @endauth 
                    </div>
                    {{-- @if (isset($comment_id) && $comment_id == $item2->id)
                        <form wire:submit.prevent="reply" class="my-3">
                            <div class="mb-3">
                                <textarea wire:model.defer="isi_komentar2" rows="2" class="form-control @error('isi_komentar2') is-invalid @enderror" placeholder="Tulis  Komentar..."></textarea>
                                @error('isi_komentar2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Balas</button>
                            </div>
                        </form>
                    @endif --}}

                    @if (isset($edit_comment_id) && $edit_comment_id == $item2->id)
                        <form wire:submit.prevent="change" class="my-3">
                            <div class="mb-3">
                                <textarea wire:model.defer="isi_komentar2" rows="2" class="form-control @error('isi_komentar2') is-invalid @enderror" placeholder="Tulis  Komentar..."></textarea>
                                @error('isi_komentar2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <hr>
            @endforeach
        @endif
    </div>
    @endforeach
</div>

