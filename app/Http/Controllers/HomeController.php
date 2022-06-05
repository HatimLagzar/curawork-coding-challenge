<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Core\Invitation\InvitationService;
use App\Services\Core\Relationship\RelationshipService;
use App\Services\Core\User\UserService;
use Illuminate\Support\Facades\Log;
use Throwable;

class HomeController extends Controller
{
    private UserService $userService;
    private InvitationService $invitationService;
    private RelationshipService $relationshipService;

    public function __construct(
        UserService $userService,
        InvitationService $invitationService,
        RelationshipService $relationshipService
    ) {
        $this->userService         = $userService;
        $this->invitationService   = $invitationService;
        $this->relationshipService = $relationshipService;
    }

    /**
     * Show the application dashboard.
     */
    public function __invoke()
    {
        try {
            /** @var User $user */
            $user = auth()->guard('web')->user();

            $suggestions      = $this->userService->getSuggestions($user);
            $sentRequests     = $this->invitationService->getSentBy($user);
            $receivedRequests = $this->invitationService->getSentTo($user);
            $relationships    = $this->relationshipService->getUserRelationships($user);

            return view('home')
                ->with('suggestions', $suggestions)
                ->with('sentRequests', $sentRequests)
                ->with('receivedRequests', $receivedRequests)
                ->with('relationships', $relationships);
        } catch (Throwable $e) {
            Log::error('failed to show home page', [
                'error_message' => $e->getMessage(),
                'error_trace'   => $e->getTraceAsString()
            ]);

            return 'Error occurred, please retry later.';
        }
    }
}
