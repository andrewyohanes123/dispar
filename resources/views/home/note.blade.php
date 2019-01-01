<div class="card">
  <div class="card-body">
    <h4 class="m-0">{{ $note->name }}</h4>
    <p class="m-0 small text-muted">{{ $note->created_at->formatLocalized('%A, %d %B %Y') }}</p>
    <hr>
    <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="{{ $note->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <p class="m-0 mt-2 text-justify">{{ $note->content }}</p>
  </div>
</div>