<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->messages()->toJson());
            return response()->json([
                'email' => $validator->errors()->first('email'),
                'name' => $validator->errors()->first('name'),
            ]);
        }

        if ($request->token == 'VkPiMYiqo7:m3-_,q_p$"7(JJ??9&?%0P9Nv^"ZAQ2Z!2@%+G!$PNP{[$7jHIyt') {
            $data = [
                'email' => $request->email,
                'name' => $request->name,
            ];
            SendMail::dispatch($data)->delay(now()->addMinute(1));

            return response()->json([
                'message' => 'Mail sended to ' . $request->email,
            ]);
        } else {
            return response()->json([
                'message' => 'Access denied',
            ]);
        }
    }
}
