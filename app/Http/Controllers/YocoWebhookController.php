<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class YocoWebhookController extends Controller {

    public function handle(Request $request) {
        // Validate the Yoco webhook signature
        
        $is_yoco_live = get_setting_value_by_key('yoco_live_mode');
        if($is_yoco_live == 1) {
            $api_key = get_setting_value_by_key('yoco_live_secret_key');
        }else {
            $api_key = get_setting_value_by_key('yoco_test_secret_key');
        }
        
        $computedSignature = hash_hmac('sha256', $request->getContent(), $api_key);
        $receivedSignature = $request->header('X-Yoco-Signature');

        if ($computedSignature !== $receivedSignature) {
            Log::error('Yoco webhook signature mismatch');
            return response()->json(['error' => 'Invalid signature'], 401);
        }
        \Log::info('Webhook data: ' . $request->getContent());
        // Process the webhook data from Yoco
        // Your code to handle the webhook data goes here

        return response()->json(['message' => 'Webhook processed successfully']);
    }
    
    public function register() {
        
        $is_yoco_live = get_setting_value_by_key('yoco_live_mode');
        
        if($is_yoco_live == 1) {
            $api_key = get_setting_value_by_key('yoco_live_secret_key');
        }else {
            $api_key = get_setting_value_by_key('yoco_test_secret_key');
        }

        $data['name'] = "my-legallink-webhook";
        $data['url'] = url('yoco/webhook');


        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://payments.yoco.com/api/webhooks');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$api_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        print_r($result);
    }

}
