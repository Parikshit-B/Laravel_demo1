<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;


class AuthModel extends Model {

    public function list_data($search_term = '', $other_configs, $order) {
        $data = DB::table('users')->where(function($query) use ($search_term){
            $query->where('fname', 'LIKE', $search_term . '%')
                ->orWhere('lname', 'LIKE', $search_term . '%')
                ->orWhere('email_id','LIKE', '%' . $search_term);
            })
            ->orderBy($order['cols'], $order['dir'])
        ->get();

        if($data) {
            $result = json_decode(json_encode($data), true);
            return $result;
        }
        else return false;
    }

    public function verify_login($data) {
        $users = DB::table('users')
            ->where('email_id', '=', $data['email_id'])
            ->where('password', '=', $data['password'])
            ->get();
        
        if($users) return json_decode(json_encode($users), true);
        else return false;
    }

    public function reset_password($email, $password) {
        $chck_email = $this->chck_user($email);

        if($chck_email) {
            $update_password = DB::table('users')->where('email_id', '=', $email)->update(['password' => $password]);
            if($update_password) return json_decode(json_encode($chck_email), true);
            else return false;
        } else return false;
    }

    public function submit_new_user($data) {
        if(is_array($data)) {
            
            $query = DB::table('users')->insert([
                'fname' => $data['first_name'],
                'lname' => $data['last_name'],
                'email_id' => $data['email'],
                'password' => $data['password'],
                'mobile_no' => $data['mobile_no'],
                'created_at' => date("Y-m-d")
            ]);

            if(($query) && ($query != "")) return $query;
            else return false;
        }
    }

    public function update_pass($data) {
        $query = DB::table('users')->where('id', '=', $data['user_id'])->update(['password' => $data['password']]);
        if($query) {
            $user_data = DB::table('users')->where('id', '=', $data['user_id'])->get();
            // print_r($user_data);die();
            if($user_data) return json_decode(json_encode($user_data), true);
        }
        else return false;
    }

    function chck_user($email, $mobile = false) {
        if($mobile && $mobile != '') {
            $query = DB::table('users')->where('email_id', '=', $email)->where('mobile_no', '=', $mobile)->get();
        } else {
            $query = DB::table('users')->where('email_id', '=', $email)->get();
        }

        if($query) return $query;
        else return false;
    }
}