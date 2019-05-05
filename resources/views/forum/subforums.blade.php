@if(count($subforums)>0)
    <ul class="list-group m-4">
        @foreach($subforums as $subforum)
            @if($subforum->level==$level+1)
                <li class="list-group-item">
                    <a href="{{ route('forum.show', ['subforum'=>$subforum]) }}">{{ $subforum->name }}</a>
                    <span class="float-right">Topics: {{ count($subforum->topics) }},
                            Subforums: {{ count($subforum->childs()) }}</span>
                </li>
            @endif
        @endforeach
    </ul>
@endif