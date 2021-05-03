<?php

namespace App\Http\Controllers\CustomerSuccessSpecialists;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Http\Requests\MessageRequest;
use App\Models\Chat;
use App\Models\Message;
use http\Env\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

class CustomerSuccessSpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            $chat = Chat::where('initiator', auth()->id())->where('active', '>', 0)->first();
            if (!$chat) {
                $chat = Chat::create([
                    'initiator' => auth()->id(),
                    'active' => 2
                ]);
                $chat->messages()->create([
                    'sender' => 0,
                    'message' => 'Please wait for consultant to connect'
                ]);
            }
        } else {
            $chat = [];
            $message = new \StdClass();
            $message->sender = 0;
            $message->message ='You are not logged in, to continue, please log in';
            $message->created_at = date("Y-m-d H:i:s");
            $chat[] = $message;
        }

        return view('specialists.index', compact('chat'));
    }

    public function write(MessageRequest $request, int $id): JsonResponse
    {
        $chat = Chat::find($id);
        $chat->messages()->create([
            'sender' => auth()->id(),
            'message' => $request->get('message')
        ]);

        return response()->json(['message' => 'success'], 200);
    }

    public function refresh(Request $request, int $id): JsonResponse
    {
        $chat = Chat::find($id);
        $data = '';
        $messages = $chat->messages()->get();
        $user = $request->get('user');

        foreach($messages as $message) {
            $data.='<div class="col-md-9 ';
            if($message->sender == $user):
                $data.= 'offset-md-3 justify-content-end d-flex';
            endif;
            $data.='">
                    <div class="message">
                        <div class="';
            if($message->sender != $user):
                $data.='text-left';
            else:
                $data.='text-right';
            endif;
            $data.='">'.Helper::getUser($message->sender).' '.$message->created_at.'</div>
                        <p class="';
            if($message->sender != $user):
                $data.='user';
            else:
                $data.='me';
            endif;
            $data.='">'.$message->message.'</p>
                    </div>
                </div>';
        }

        return response()->json(['html' => $data, 'status' => $chat->active], 200);
    }

    public function show(): view
    {
        $chats = Chat::where('active', 2)->get();
        return view('specialists.chats', compact('chats'));
    }

    public function accept(int $id): RedirectResponse
    {
        $chat = Chat::find($id);
        if ($chat->active != 2 && $chat->accepted != auth()->id()) { // Chatas jau vyksta
            return redirect()->back();
        }

        $chat->update([
            'active' => 1,
            'accepted' => auth()->id()
        ]);

        $chat->messages()->create([
            'sender' => 0,
            'message' => auth()->user()->name.' connected to the chat'
        ]);


        return redirect()->route('help.chat', $id);
    }

    public function chat($id): view
    {
        $chat = Chat::find($id);

        return view('specialists.index', compact('chat'));
    }
}
