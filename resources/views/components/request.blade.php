<div class="my-2 shadow text-white bg-dark p-1" id="">
  <div class="d-flex justify-content-between">
    <table class="ms-1">
      <td class="align-middle">{{ $request->getOtherUser()->getName() }}</td>
      <td class="align-middle"> -</td>
      <td class="align-middle">{{ $request->getOtherUser()->getEmail() }}</td>
      <td class="align-middle">
    </table>
    <div>
      @if ($mode == 'sent')
        <button id="cancel_request_btn_" class="btn btn-danger me-1"
                onclick="">Withdraw Request
        </button>
      @else
        <button id="accept_request_btn_" class="btn btn-primary me-1"
                onclick="">Accept
        </button>
      @endif
    </div>
  </div>
</div>
