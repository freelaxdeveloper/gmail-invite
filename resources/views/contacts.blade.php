@extends('layout.app')

@section('content')
  <div class="contacts">
    @forelse ($contacts as $email)
      @php ($link = mt_rand(0, 3) == 2 ? ['name' => 'in friends list', 'class' => 'friend'] : ['name' => 'invite', 'class' => 'invite'])
      <div class="contact">
        <div class="email">
          {{$email}}
        </div>
        <div>
          <a href="#" data-email="{{$email}}" data-type="{{$link['class']}}" class="btn emailInvite {{$link['class']}}">
            {{$link['name']}}
          </a>
        </div>
      </div>
    @empty
      Contact list is empty
    @endforelse
  </div>
@endsection