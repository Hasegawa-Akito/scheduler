<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Room;
use App\Models\Announcement;


class Announcement extends Model
{
    private $announce_html="";

    use HasFactory;
    protected $table='announcements';
    protected $fillable = [
        'user_id','room_id','announce','type',
    ];


    public function create_announce_html($room_id){

        $post_url=url('/announce/delete');

        $announcements=Announcement::where('room_id',$room_id)
                                    ->orderBy('created_at','desc')
        ->get();
        foreach($announcements as $announcement){

            $announce_user=User::where('user_id',$announcement->user_id)->first();
            $csrf=csrf_field();

            //ルームを退出しアナウンスしたユーザーが存在しない時
            if(!isset($announce_user)){
                $announce_username="unknown";
            }else{
                $announce_username=$announce_user->username;
            }

            //アナウンス画面でのiconのurl作成
            $picture_url=asset('/picture/type_img/'.$announcement->type.'.jpg');
            //dd($picture_url);


            //vueにあたいを送るよう
            $delete_id=json_encode($announcement->id);
            //dd($delete_id);

            $this->announce_html.= <<<EOS
                <div class="text-muted border-bottom pt-3 pr-1 mb-3 announce-content">
                    <form class="mb-2 mr-2 removal" action="$post_url" method="post">
                        $csrf
                        <removal-button
                        :deleteid="$delete_id"
                        ></removal-button>
                    </form>
                    <img class="mr-3 mb-1 icon" src="$picture_url" alt="icon" width="32" height="32">
                    <p class=" mb-0 small lh-smt">
                        <strong class="d-block text-gray-dark">@$announce_username</strong>
                        $announcement->announce
                    </p>
                    
                    
                    
                </div>
            EOS;
        }
        return $this->announce_html;

    }

    public function create_announce($announce_info){
        $announcement=new Announcement;
        $announcement->user_id=$announce_info["user_id"];
        $announcement->room_id=$announce_info["room_id"];
        $announcement->announce=$announce_info["announce"];
        $announcement->type=$announce_info["type"];

        return $announcement->save();


    }
    public function announce_delete($delete_id){
        $announcement=new Announcement;
        $announcement->destroy($delete_id);
                        
    }
}
