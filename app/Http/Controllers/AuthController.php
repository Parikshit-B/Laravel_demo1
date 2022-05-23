<?php

namespace App\Http\Controllers;

use App\Models\AuthModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mail;
use Session;

class AuthController extends Controller {
    function __construct() {
        $this->authModel = new AuthModel();
    }

    public function index() {
        return view('auth/login');
    }

    public function lists() {
        
        if(session::get('email') === null) {
            return redirect('home');
        }
        return view('auth/auth_list');
    }

    public function add() {
        return view('auth/add_users');
    }

    public function submit() {
        $validate = $this->validation($_POST);

        if(!empty($validate)) {
            echo json_encode(array('status' => 504, 'msg' => $validate['error'][0]));
            return false;
        }
        unset($_POST['_token']);

        $chck_user = $this->authModel->chck_user($_POST['email'], $_POST['mobile_no']);
        $chck_user = json_decode(json_encode($chck_user), true);
        
        if($chck_user) {
            echo json_encode(array('status' => 403, 'msg' => 'User Exists'));
            return false;
        }

        $insert_data = $this->authModel->submit_new_user($_POST);

        if ($insert_data) echo json_encode(array('status' => 200, 'msg' => 'User Registered'));
        else echo json_encode(array('status' => 403, 'msg' => 'Internal Error, contact support'));        
    }

    public function login_check() {
        $data = array(
            'email_id' => $_POST['email_id'],
            'password' => $_POST['password']
        );
        $validate = $this->validation($data);
        
        if(!empty($validate)) {
            echo json_encode(array('status' => 504, 'msg' => $validate['error'][0]));
            return false;
        }
        
        $chck_user = $this->authModel->verify_login($data);

        if( ($chck_user == '') || ($chck_user == false)) echo json_encode(array('status' => 404, 'msg' => 'Invalid user details'));
        else {
            session([
                'user_id' => $chck_user[0]['id'],
                'name' => $chck_user[0]['fname'].' '.$chck_user[0]['lname'],
                'email' => $chck_user[0]['email_id'],
                'mobile' => $chck_user[0]['mobile_no']
            ]);
            
            echo json_encode(array('status' => 200, 'msg' => 'Login Successfull,  Welcome'));
        }
    }

    public function update_password() {
        $validate = $this->validation($_POST);

        if(!empty($validate)) {
            echo json_encode(array('status' => 504, 'msg' => $validate['error'][0]));
            return false;
        }
        unset($_POST['_token']);

        $change_password = $this->authModel->update_pass($_POST);
        
        if($change_password) {
            $trigger_mail = $this->send_mail($change_password[0]);
            echo json_encode(array('status' => 200, 'msg' => 'Password Updated'));
        }
        else echo json_encode(array('status' => 500, 'msg' => 'Internal Error, contact support'));
    }

    public function forget_password() {
        $validate = $this->validation($_POST);

        if(!empty($validate)) {
            echo json_encode(array('status' => 504, 'msg' => $validate['error'][0]));
            return false;
        }

        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $new_password = substr(str_shuffle($data), 0, 9);

        $update_pass = $this->authModel->reset_password($_POST['email_id'], $new_password);
        $user_data = array(
            'name' => $update_pass[0]['fname'],
            'password' => $new_password,
            'email_id' => $update_pass[0]['email_id']
        );
        $trigger_mail = $this->send_mail($update_pass[0]);

        if($trigger_mail) echo json_encode(array('status' => 200, 'msg' => 'Mail Sent'));
        else echo json_encode(array('status' => 504, 'msg' => 'Internal Error, please contact support'));
    }

    public function list_all_data() {
        
        $start = intval($_POST['start']);
        $length = intval($_POST['length']);
        $search_term = (isset($_POST['search']) ? $_POST['search'] : '');

        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        $order = $this->order_by();

        $users_details = $this->authModel->list_data($search_term['value'], $other_configs, $order);

        $data = array();

        foreach($users_details as $row => $val) {
            $nestedData = array();
            $actionString = '';
            $nestedData[] = $val['id'];
            $nestedData[] = $val['fname'];
            $nestedData[] = $val['lname'];
            $nestedData[] = $val['email_id'];
            $nestedData[] = $val['mobile_no'];
            $nestedData[] = $val['created_at'];

            $actionString .= '<button type="button" class="btn btn-info btn-rounded btn-md" onclick="show_modal(`'.$val['id'].'`)">Change Password</button>'; 
            
            $nestedData[] = $actionString;
            $data[] = $nestedData;
        }

        $output = array(
            'draw' => intval($_POST['draw']),
            'recordsTotal' => count($users_details),
            'recordsFiltered' => $users_details,
            'data' => $data
        );

        echo json_encode($output);
    }

    public function validation($data) {
        $result = array();
        if(is_array($data)) {
            unset($data['_token']);
            foreach($data as $row => $val) {

                if($row == 'mobile_no') {
                    if(!preg_match("/^[1-9][0-9]*$/", $val)) $result['error'][] = 'Invalid Mobile No';
                    else if($val == '') {
                        $label = preg_replace('/[^A-Za-z0-9\-]/', '', $row);
                    
                        $result['error'][] = strtoupper($label).' cannot be empty';
                    }
                }
                else if($row == 'email_id'){
                    if($val == '') {
                        $label = preg_replace('/[^A-Za-z0-9\-]/', '', $row);
                        
                        $result['error'][] = strtoupper($label).' cannot be empty';
                    } else {
                        if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $val ) ) 
                            $result['error'][] = 'Invalid Email Id'; 
                    }
                    
                } else {
                    if($val == '') {
                        $label = preg_replace('/[^A-Za-z0-9\-]/', '', $row);
                        $result['error'][] = ucfirst($label).' cannot be empty';
                    }
                }
            }
        }
        return $result;
    }

    function order_by() {
        
        $col = (($_POST['order'][0]['column'] != '') ? $_POST['order'][0]['column'] : '' );
        $dir = $_POST['order'][0]['dir'];
        
        switch($col) {
            case 0:
                $col = 'id';
                break;
            case 1:
                $col = 'fname';
                break;
            case 2:
                $col = 'lname';
                break;
            case 3:
                $col = 'email_id';
                break;
            default:
                break;
        }
        
        $data['cols'] = $col;
        $data['dir'] = $dir;
        return $data;
    }

    function send_mail($data) {
        $details = [
            'name' => ucfirst($data['fname']),
            'password' => $data['password'],
            'email' => $data['email_id']
        ];
       
        $mail_send = Mail::to($details['email'])->send(new \App\Mail\MyTestMail($details));

        if($mail_send == '') return true;
        else return false;
    }
}