<?php
class MailChimp_API {
    private $api_key;
    private $api_link;
    public function __construct($api = '') {
        if($api) {
            $this->api_key = $api;
        }
        else {
            $this->api_key = WPCF7::get_option('mailchimp');
        }
        $data_center = substr($this->api_key,strpos($this->api_key,'-')+1);
        $this->api_link = 'https://' . $data_center . '.api.mailchimp.com/3.0';
    }

    public function get_lists() {
        $url = $this->api_link.'/lists';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        if($result === false) {
            return false;
        }
        $result = json_decode($result);
        if(!isset($result->lists)) {
            return array();
        }
        $lists = array();
        foreach ($result->lists as $item) {
            $lists[] = (object) array(
                'id' => $item->id,
                'name' => $item->name,
            );
        }
        return $lists;
    }

    public function add_subscribe($data,$list_id) {
        $email = isset($data['email'])?$data['email']:'';
        $fname = isset($data['fname'])?$data['fname']:'';
        $lname = isset($data['lname'])?$data['lname']:'';
        $member_id = md5(strtolower($email));
        $url = $this->api_link.'/lists/' . $list_id . '/members/' . $member_id;
        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME'     => $fname,
                'LNAME'     => $lname
            ]
        ]);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode == 200) {
            $msg = '<p style="color: #34A853">You have successfully subscribed to CodexWorld.</p>';
        } else {
            switch ($httpCode) {
                case 214:
                    $msg = 'You are already subscribed.';
                    break;
                default:
                    $msg = 'Some problem occurred, please try again.';
                    break;
            }
            $msg = '<p style="color: #EA4335">'.$msg.'</p>';
        }
        return $msg;
    }
}
?>