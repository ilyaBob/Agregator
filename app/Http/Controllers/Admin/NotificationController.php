<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Notification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        if (request()->type) {
            $notifications = Notification::query()->orderBy('id','DESC')->where('type', request()->type)->paginate(10);
        } else {
            $notifications = Notification::query()->orderBy('id','DESC')->paginate(10);
        }

        return view('admin.notification.index', compact('notifications'));
    }

    public static function create($title, $description, $type = 3)
    {
        Notification::create([
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'is_new' => 1,
        ]);
    }

    public function show(Notification $id)
    {
        $notification = $id;

        if ($notification->is_new = 1) {
            DB::beginTransaction();
            try {
                $notification->is_new = 0;
                if (!$notification->save()) {
                    DB::rollback();

                    return abort(404);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }

        return view('admin.notification.show', compact('notification'));

    }

    public function destroy(Notification $id)
    {
        $id->delete();

        return redirect()->route('notification.index');
    }
}
