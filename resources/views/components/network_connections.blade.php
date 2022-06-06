<div class="row justify-content-center mt-5">
  <div class="col-12">
    <div class="card shadow  text-white bg-dark">
      <div class="card-header">Coding Challenge - Network connections</div>
      <div class="card-body">
        <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
          <button class="btn btn-outline-primary active me-2"
                  id="nav-suggestions-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#nav-suggestions"
                  type="button"
                  role="tab"
                  aria-controls="nav-suggestions"
                  aria-selected="true">
            Suggestions ({{ $suggestions->count() }})
          </button>
          <button class="btn btn-outline-primary me-2"
                  id="nav-sent-requests-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#nav-sent-requests"
                  type="button"
                  role="tab"
                  aria-controls="nav-sent-requests"
                  aria-selected="false">
            Sent Requests ({{ $sentRequests->count() }})
          </button>
          <button class="btn btn-outline-primary me-2"
                  id="nav-sent-requests-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#nav-received-requests"
                  type="button"
                  role="tab"
                  aria-controls="nav-received-requests"
                  aria-selected="false">
            Received Requests({{ $receivedRequests->count() }})
          </button>
          <button class="btn btn-outline-primary"
                  id="nav-connections-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#nav-connections"
                  type="button"
                  role="tab"
                  aria-controls="nav-connections"
                  aria-selected="false">
            Connections ({{ $relationships->count() }})
          </button>
        </div>

        <hr>

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-suggestions" role="tabpanel" aria-labelledby="nav-suggestions-tab">
            @foreach($suggestions as $suggestion)
              <x-suggestion :name="$suggestion->getName()" :email="$suggestion->getEmail()"/>
            @endforeach
          </div>
          <div class="tab-pane fade" id="nav-sent-requests" role="tabpanel" aria-labelledby="nav-sent-requests-tab">
            @foreach($sentRequests as $sentRequest)
              <x-request :mode="'sent'" :request="$sentRequest"/>
            @endforeach
          </div>
          <div class="tab-pane fade" id="nav-received-requests" role="tabpanel" aria-labelledby="nav-received-requests-tab">
            @foreach($receivedRequests as $receivedRequest)
              <x-request :mode="'received'" :request="$receivedRequest"/>
            @endforeach
          </div>
          <div class="tab-pane fade" id="nav-connections" role="tabpanel" aria-labelledby="nav-connections-tab">
            @foreach($relationships as $relationship)
              <x-connection :relationship="$relationship"/>
            @endforeach
          </div>
        </div>

        {{--<div class="btn-group w-100 mb-3" role="group" aria-label="Basic radio toggle button group">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="btn btn-outline-primary active"
                    id="get_suggestions_btn"
                    data-bs-toggle="tab"
                    data-bs-target="#get_suggestions_btn"
                    type="button"
                    role="tab"
                    aria-controls="get_suggestions_btn"
                    aria-selected="true">
              Suggestions ({{ $suggestions->count() }})
            </button>

            <button class="btn btn-outline-primary"
                    id="get_sent_requests_btn"
                    data-bs-toggle="tab"
                    data-bs-target="#get_sent_requests_btn"
                    type="button"
                    role="tab"
                    aria-controls="get_sent_requests_btn"
                    aria-selected="false">
              Sent Requests ({{ $sentRequests->count() }})
            </button>

            <button class="btn btn-outline-primary"
                    id="get_received_requests_btn"
                    data-bs-toggle="tab"
                    data-bs-target="#get_received_requests_btn"
                    type="button"
                    role="tab"
                    aria-controls="get_received_requests_btn"
                    aria-selected="false">
              Received Requests({{ $receivedRequests->count() }})
            </button>

            <button class="btn btn-outline-primary"
                    id="get_connections_btn"
                    data-bs-toggle="tab"
                    data-bs-target="#get_connections_btn"
                    type="button"
                    role="tab"
                    aria-controls="get_connections_btn"
                    aria-selected="false">
              Connections ({{ $relationships->count() }})
            </button>
          </div>
        </div>--}}

        {{-- Remove this when you start working, just to show you the different components --}}
        {{--<span class="fw-bold">Sent Request Blade</span>
        <x-request :mode="'sent'"/>

        <span class="fw-bold">Received Request Blade</span>
        <x-request :mode="'received'"/>

        <span class="fw-bold">Suggestion Blade</span>
        <x-suggestion name="Name" email="Email"/>

        <span class="fw-bold">Connection Blade (Click on "Connections in common" to see the connections in common
          component)</span>
        <x-connection name="Name" email="Email"/>
        Remove this when you start working, just to show you the different components

        <div id="skeleton" class="d-none">
          @for ($i = 0; $i < 10; $i++)
            <x-skeleton/>
          @endfor
        </div>

        <span class="fw-bold">"Load more"-Button</span>
        <div class="d-flex justify-content-center mt-2 py-3  d-none " id="load_more_btn_parent">
          <button class="btn btn-primary" onclick="" id="load_more_btn">Load more</button>
        </div>--}}
      </div>
    </div>
  </div>
</div>

{{-- Remove this when you start working, just to show you the different components --}}

{{--
<div id="connections_in_common_skeleton" class="--}}
{{-- d-none --}}{{--
">
  <br>
  <span class="fw-bold text-white">Loading Skeletons</span>
  <div class="px-2">
    @for ($i = 0; $i < 10; $i++)
      <x-skeleton />
    @endfor
  </div>
</div>
--}}
