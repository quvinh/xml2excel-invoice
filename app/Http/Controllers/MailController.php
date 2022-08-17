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
            'page' => 'required',
            'otp' => 'required',
            'time' => 'required',
            'support' => 'required',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->messages()->toJson());
            return response()->json([
                'email' => $validator->errors()->first('email'),
                'name' => $validator->errors()->first('name'),
            ]);
        }

        if ($request->token == 'cn2tpGAmriQb1eQuOfb3eb36iNEceSyj@') {
            $data = [
                'email' => $request->email,
                'name' => $request->name,
                'page' => $request->page,
                'otp' => $request->otp,
                'time' => $request->time,
                'support' => $request->support,
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
