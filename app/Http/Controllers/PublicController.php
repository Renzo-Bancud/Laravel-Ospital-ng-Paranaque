<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function getUserByUserType(Request $request)
    {

        // 2 doctor
        // 4 nurse
        // 5 accountant
        // 7 laboratorist
        // 6 pharmacist
        // 8 receptionist

        if ($request->usertype == 2) {
            $users = User::doctor()->get();
            $TS = collect();
            foreach ($users as $user) {
                $TS->push($user);
            }
            $json = $TS->toJson();
            return response()->json(['html' => $json]);
        } elseif ($request->usertype == 'patient') {
            $users = User::patient()->get();
            $TS = collect();
            foreach ($users as $user) {
                $TS->push($user);
            }
            $json = $TS->toJson();
            return response()->json(['html' => $json]);
        } elseif ($request->usertype == 4) {
            $users = User::nurse()->get();
            $TS = collect();
            foreach ($users as $user) {
                $TS->push($user);
            }
            $json = $TS->toJson();
            return response()->json(['html' => $json]);
        } elseif ($request->usertype == 5) {
            $users = User::accountant()->get();
            $TS = collect();
            foreach ($users as $user) {
                $TS->push($user);
            }
            $json = $TS->toJson();
            return response()->json(['html' => $json]);
        } elseif ($request->usertype == 6) {
            $users = User::pharmacist()->get();
            $TS = collect();
            foreach ($users as $user) {
                $TS->push($user);
            }
            $json = $TS->toJson();
            return response()->json(['html' => $json]);
        } elseif ($request->usertype == 7) {
            $users = User::laboratorist()->get();
            $TS = collect();
            foreach ($users as $user) {
                $TS->push($user);
            }
            $json = $TS->toJson();
            return response()->json(['html' => $json]);
        } elseif ($request->usertype == 8) {
            $users = User::receptionist()->get();
            $TS = collect();
            foreach ($users as $user) {
                $TS->push($user);
            }
            $json = $TS->toJson();
            return response()->json(['html' => $json]);
        }
    }
}
