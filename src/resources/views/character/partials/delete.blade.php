@can('global.superuser')
  <a class="btn btn-danger btn-sm confirmlink" href="{{ route('character.delete', ['character_id' => $row->character_id]) }}">
    {{ trans('web::seat.delete') }}
  </a>
@endcan
