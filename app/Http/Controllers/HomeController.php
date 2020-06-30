<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('status')
        ->select('users.id','status.status', 'users.username', 'status.tgl', 'status.id_status', 'users.foto')
        ->join('users', 'users.id' , '=', 'status.id_user')
        ->orderBy('status.id_status', 'desc')
        ->get();

        $komen = DB::table('comment')
        ->select('comment.komen', 'users.username', 'comment.id_status', 'comment.tgl_komen')
        ->join('status', 'status.id_status', '=', 'comment.id_status')
        ->join('users', 'users.id', '=', 'comment.id_user')
        ->orderBy('comment.id')
        ->get();

        $likes = DB::table('status')
        ->select('status.t_likes', 'status.id_status')
        ->get();

        $ceklikes = DB::table('likes')
        ->select('id_user', 'id_status', 'id_likes')
        ->where('id_user', auth()->user()->id)
        ->get();

        return view('home', ['dt' => $data, 'km' => $komen, 'likes' => $likes, 'ceklikes' => $ceklikes]);
    }

    public function status(Request $r) {
        DB::table('status')
        ->insert(
            ['status' => $r->status,
            'tgl' => now(),
            'id_user' => auth()->user()->id]
        );

        return redirect()->route('home');
    }

    public function profile() {

        $data = DB::table('users')
        ->select('users.username', 'users.id', 'friends.id_friends')
        ->join('friends', 'friends.id_friends', '=', 'users.id')
        ->whereRaw('friends.id_user=:id', ['id' => auth()->user()->id])
        ->get();

        $status = DB::table('status')
        ->select('users.id','status.status', 'users.username', 'status.tgl', 'status.id_status', 'status.id_user')
        ->join('users', 'users.id' , '=', 'status.id_user')
        ->orderBy('status.id_status', 'desc')
        ->get();

        $komen = DB::table('comment')
        ->select('comment.komen', 'users.username', 'comment.id_status', 'comment.tgl_komen', 'status.id_status')
        ->join('status', 'status.id_status', '=', 'comment.id_status')
        ->join('users', 'users.id', '=', 'comment.id_user')
        ->orderBy('comment.id')
        ->get();

        $foto = DB::table('users')
        ->select('users.foto', 'users.id')
        ->where('users.id', auth()->user()->id)
        ->get();

        $likes = DB::table('status')
        ->select('status.t_likes', 'status.id_status')
        ->get();

        $ceklikes = DB::table('likes')
        ->select('id_user', 'id_status', 'id_likes')
        ->where('id_user', auth()->user()->id)
        ->get();

        return view('profile', ['dt' => $data, 'st' => $status, 'km' => $komen, 'pp' => $foto, 'likes' => $likes, 'ceklikes' => $ceklikes]);
    }

    public function user($id) {
        $data = DB::table('users')->get();

        $status = DB::table('status')
        ->select('users.id','status.status', 'status.tgl', 'status.id_status')
        ->join('users', 'users.id' , '=', 'status.id_user')
        ->whereRaw('status.id_user=:id', ['id' => $id])
        ->orderBy('status.id_status', 'desc')
        ->get();

        $komen = DB::table('comment')
        ->select('comment.komen', 'users.username', 'comment.id_status', 'comment.tgl_komen', 'users.id')
        ->join('status', 'status.id_status', '=', 'comment.id_status')
        ->join('users', 'users.id', '=', 'comment.id_user')
        ->orderBy('comment.id')
        ->get();

        $friend = DB::table('friends')
        ->select('friends.id_friends', 'friends.id_user', 'friends.id')
        ->get();

        $likes = DB::table('status')
        ->select('status.t_likes', 'status.id_status')
        ->get();

        $ceklikes = DB::table('likes')
        ->select('id_user', 'id_status', 'id_likes')
        ->where('id_user', auth()->user()->id)
        ->get();

        $fa = false;
        foreach($friend as $fr) {
            if($fr->id_friends == $id && $fr->id_user == auth()->user()->id) {
                $fa = true;
                break;
            } else {
                $fa = false;
            }
        }

        foreach($data as $d) {
            if($d->id == $id) {
                $dt = $d->username;
                $foto = $d->foto;
            } 
        }

        return view('users', ['id' => $id, 'cek' => $dt, 'st' => $status, 'km' => $komen, 'f' => $fa, 'fr' => $friend, 'pp' => $foto, 'likes' => $likes, 'ceklikes' => $ceklikes]);
    }

    public function addFriend(Request $r, $id) {
        $data = DB::table('friends')->insert([
            'id_friends' => $r->id,
            'id_user' => auth()->user()->id
        ]);

        return redirect()->back();
    }

    public function deleteFriend($id) {
        DB::table('friends')
        ->join('users', 'users.id', '=', 'friends.id_friends')
        ->where('friends.id_friends', $id)->delete();

        return redirect()->back();
    }

    public function addKomen(Request $r, $id, $user) {
        DB::table('comment')
        ->join('status', 'status.id_status', '=', 'comment.id_status')
        ->insert([
            'komen' => $r->isikomen,
            'id_status' => $id,
            'id_user' => $user,
            'tgl_komen' => now()
        ]);

        return redirect()->back();
    }

    public function updateData(Request $r) {
        $this->validate($r, [
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $file = $r->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();

        $folder = 'imgProfile';

        $file->move($folder, $nama_file);

        DB::table('users')
        ->where('id', auth()->user()->id)
        ->update([
            'foto' => $nama_file
        ]);

        return redirect()->back()->with('sukses', 'Data berhasil diupdate');
    }

    public function cari(Request $r) {
        $cari = $r->cari;

        $user = DB::table('users')
        ->select('username', 'foto', 'id')
        ->where('username', 'like', "%".$cari."%")
        ->paginate();

        return view('cari', ['user' => $user, 'cari' => $cari]);
    }

    public function addLikes($id) {
        DB::table('likes')->insert([
            'id_user' => auth()->user()->id,
            'id_status' => $id
        ]);

        DB::table('status')->where('id_status', $id)
        ->update([
            't_likes' => DB::raw('t_likes+1')
        ]);

        return redirect()->back();
    }

    public function deleteLikes($id, $id2) {
        DB::table('likes')
        ->where('id_likes', $id)
        ->delete();

        DB::table('status')->where('id_status', $id2)
        ->update([
            't_likes' => DB::raw('t_likes-1')
        ]);

        return redirect()->back();
    }

    public function deleteStatus($id) {
        DB::table('status')
        ->where('id_status', $id)
        ->delete();

        DB::table('comment')
        ->where('id_status', $id)
        ->delete();

        return redirect()->back();
    }

    public function updateProfile(Request $r) {
        DB::table('users')
        ->where('id', auth()->user()->id)
        ->update([
            'username' => $r->username,
            'password' => bcrypt($r->password)
        ]);

        return redirect()->back();
    }

}
