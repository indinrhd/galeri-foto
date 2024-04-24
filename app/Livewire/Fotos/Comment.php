<?php

namespace App\Livewire\Fotos;
use App\Models\Foto;
use App\Models\Komentar as ModelsComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class Comment extends Component
{
    public $isi_komentar, $isi_komentar2, $foto;
    public $comment_id, $edit_comment_id;

    public function mount($id)
    {
        $this->foto = Foto::find($id);
    }
    
    
    public function render()
    {
        return view('livewire.fotos.comment', [
            'comments' => ModelsComment::with(['user', 'childrens'])
            ->where('foto_id', $this->foto->id)
            ->whereNull('comment_id')->get(),
        ]);
    }

    public function store()
    {
        $this->validate(['isi_komentar' => 'required']);
        $comment = ModelsComment::create([
            'user_id' => Auth::user()->id,
            'foto_id' => $this->foto->id,
            'isi_komentar' => $this->isi_komentar,
            'tanggal_komentar' => Carbon::today(),
        ]);


        if ($comment) {
            $this->redirect('comment_store', $comment->id);
            $this->isi_komentar = NULL;
        } else {
            session()->flash('danger', 'Komentar gagal ditambahkan');
            return redirect()->route('show', $this->foto->slug);
        }
    }

    public function storee()
    {
        $this->validate(['isi_komentar' => 'required']);
        $comment = ModelsComment::create([
            'user_id' => '1',
            'foto_id' => $this->foto->id,
            'isi_komentar' => $this->isi_komentar,
            'tanggal_komentar' => Carbon::today(),
        ]);


        if ($comment) {
            $this->redirect('comment_store', $comment->id);
            $this->isi_komentar = NULL;
        } else {
            session()->flash('danger', 'Komentar gagal ditambahkan');
            return redirect()->route('show', $this->foto->slug);
        }
    }

    // public function selectReply($id)
    // {
    //     $this->comment_id = $id;
    //     $this->edit_comment_id = NULL;
    //     $this->isi_komentar2 = NULL;
    // }

    // public function reply()
    // {
    //     $this->validate(['isi_komentar2' => 'required']);
    //     $comment = ModelsComment::find($this->comment_id);
    //     $comment = ModelsComment::create([
    //         'user_id' => Auth::user()->id,
    //         'foto_id' => $this->foto->id,
    //         'isi_komentar' => $this->isi_komentar2,
    //         'tanggal_komentar' => Carbon::today(),
    //         'comment_id' => $comment->comment_id ? $comment->comment_id : $comment->id
    //     ]);


    //     if ($comment) {
    //         $this->emit('comment_store', $comment->id);
    //         $this->isi_komentar2 = NULL;
    //         $this->comment_id = NULL;
    //     } else {
    //         session()->flash('danger', 'Komentar gagal ditambahkan');
    //         return redirect()->route('foto.show', $this->foto->slug);
    //     }
    // }

    public function selectEdit($id)
    {
        $comment = ModelsComment::find($id);
        $this->edit_comment_id = $comment->id;
        $this->isi_komentar2 = $comment->isi_komentar;
    }

    public function change()
    {
        $this->validate(['isi_komentar2' => 'required']);
        $comment = ModelsComment::where('id', $this->edit_comment_id)->update([
            'isi_komentar' => $this->isi_komentar2,
        ]);


        if ($comment) {
            $this->redirect('comment_store', $this->edit_comment_id);
            $this->isi_komentar = NULL;
            $this->edit_comment_id = NULL;
        } else {
            session()->flash('danger', 'Komentar gagal diubah');
            return redirect()->route('foto.show', $this->foto->slug);
        }
    }

    public function delete($id)
    {
        $comment = ModelsComment::where('id', $id)->delete();

        if ($comment) {
            return NULL;
        } else {
            session()->flash('danger', 'Komentar gagal dihapus');
            return redirect()->route('foto.show', $this->foto->slug);
        }
    }


}
