@foreach($queries as $query)
    {{ $query->user->f_name }} {{ $query->user->l_name }}: {{ $query->query_subject }}<br>
@endforeach