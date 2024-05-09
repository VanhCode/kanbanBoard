<?php

namespace App\Http\Controllers;

use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use App\Models\User;
use App\Models\Board;
use App\Models\BoardDetail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\GroupCreated;
use App\Events\MemberGroup;
use App\Events\TaskCreated;

class BoardController extends Controller
{

    public function board()
    {
        $userId = Auth::id();
        $myBoardGroup = Board::where('leader', $userId)->orderBy('id', 'DESC')->get();
        $boardGroupNotLeader = BoardDetail::leftJoin('boards', 'boards.id', '=', 'board_detail.board_id')
            ->where('board_detail.member_id', Auth::user()->id)->get();

        return view('boards.board')->with([
            'myBoardGroup' => $myBoardGroup,
            'boardGroupNotLeader' => $boardGroupNotLeader
        ]);
    }

    public function createGroup(Request $request)
    {
        $request->validate([
            'board_name' => 'required|string|max:255'
        ]);

        $group = Board::create([
            'board_name' => $request->board_name,
            'leader' => Auth::user()->id
        ]);

        broadcast(new GroupCreated($group));
    }

    public function boardGroup($boardGroupId)
    {
        $users = User::select('id', 'name')
            ->where('id', '<>', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        $boardGroup = Board::find($boardGroupId);
        $leader = User::find($boardGroup->leader);
        $member_ids = BoardDetail::where("board_id", $boardGroupId)->pluck("member_id")->toArray();
        $members = User::whereIn("id", $member_ids)->get();
        

        // $accounts = BoardDetail::select('board_detail.member_id', 'users.id', 'users.name', 'users.image')
        //     ->where('board_detail.member_id', '!=', Auth::user()->id)
        //     ->join('users', 'board_detail.member_id', '=', 'users.id')
        //     ->get();

        $checkLeader = $boardGroup->leader === Auth::user()->id;

        $boxTodo = Task::select('id', 'title', 'status', 'iduser_created_by')
            ->where('board_id', '=', $boardGroupId)
            ->where('status', '=', 'to-do')
            ->orderBy('id', 'DESC')
            ->get();
        $boxDoing = Task::select('id', 'title', 'status', 'iduser_created_by')
            ->where('board_id', '=', $boardGroupId)
            ->where('status', '=', 'doing')
            ->orderBy('id', 'DESC')
            ->get();
        $boxDone = Task::select('id', 'title', 'status', 'iduser_created_by')
            ->where('board_id', '=', $boardGroupId)
            ->where('status', '=', 'done')
            ->orderBy('id', 'DESC')
            ->get();
        $boxTrash = Task::select('id', 'title', 'status', 'iduser_created_by')
            ->where('board_id', '=', $boardGroupId)
            ->where('status', '=', 'trash')
            ->orderBy('id', 'DESC')
            ->get();

        return view('boards.boardGroup')->with([
            'users' => $users,
            'boardGroup' => $boardGroup,
            'leader' => $leader,
            'members' => $members,
            'boardId' => $boardGroupId,
            'checkLeader' => $checkLeader,
            'boxTodo' => $boxTodo,
            'boxDoing' => $boxDoing,
            'boxDone' => $boxDone,
            'boxTrash' => $boxTrash
        ]);
    }

    public function createMember(Request $request, $groupId)
    {
        $success = [];
        $fail = [];

        foreach ($request->memberGroup as $member) {
            $checkMember = BoardDetail::where('board_id', $groupId)
                ->where('member_id', $member)
                ->first();

            if (!$checkMember) {
                $newMember = BoardDetail::create([
                    'board_id' => $groupId,
                    'member_id' => $member
                ]);

                $userData = User::find($member);

                $success[] = $newMember;

                broadcast(new MemberGroup($newMember, $groupId, $userData));
            } else {
                $fail[] = $checkMember->member_id;
            }
        }

        return response()->json([
            'success' => $success,
            'failure' => $fail
        ]);
    }

    public function createTask(Request $request, $boardGroupId)
    {
        $taskData = Task::create([
            'board_id' => $boardGroupId,
            'title' => $request->title,
            'iduser_created_by' => Auth::user()->id
        ]);

        broadcast(new TaskCreated($boardGroupId, Auth::user()->id, $taskData));
    }

    public function updateTask(Request $request, $boardGroupId, $taskId)
    {
        $newStatus = $request->input('status');

        $task = Task::findOrFail($taskId);

        $task->status = $newStatus;

        $task->save();

        broadcast(new TaskUpdated($boardGroupId, $taskId, $task));

        return response()->json([
            'task' => $task
        ]);
    }

    public function deleteTask(Request $request, $boardId)
    {
        broadcast(new TaskDeleted($request->id, $boardId));

        Task::where('id',$request->id)->delete();
    }

    public function updateNewTask(Request $request, $boardGroupId, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $task->title = $request->title;

        $task->save();

        broadcast(new TaskUpdated($taskId, $task, $boardGroupId));

        return response()->json([
            'task' => $task
        ]);
    }
}
