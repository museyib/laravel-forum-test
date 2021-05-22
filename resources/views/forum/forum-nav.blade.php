<a href="/forum">Main</a>
@foreach($parent->parents() as $parentsub)
/ <a href="/forum/{{ $parentsub->id }}">{{ $parentsub->name }}</a>
@endforeach
