<p>New  @if($data['resource_type'] == 1) problem 
    @else resource 
    @endif
    "{{ $data['resource']}}" added to {{ $data['topic']}}. <p>
<p>Click the link to check it! 
    @if($data['resource_type'] == 1)<a href="{{ route('pruebasIndex.show', $data['id_resource'])}}">{{ route('pruebasIndex.show', $data['id_resource'])}}</a>
    @else
        <a href="{{ route('pruebasIndex.show', $data['id_resource'])}}">{{ route('pruebasIndex.show', $data['id_resource'])}}</a>
    @endif
</p>