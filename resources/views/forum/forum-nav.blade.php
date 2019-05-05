@foreach(\App\Subforum::getParents($parent->id) as $parentsub)
    @if($parentsub->level<$parent->level)
        / <a href="/forum/{{ $parentsub->id }}">{{ $parentsub->name }}</a>
    @else
        / <span>{{ $parentsub->name }}</span>
    @endif
@endforeach