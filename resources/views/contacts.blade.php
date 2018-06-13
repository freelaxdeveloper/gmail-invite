<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gmail-Invited</title>

  <link rel="stylesheet" type="text/css" href="resources/css/gmail-invited.css">
  <link rel="stylesheet" type="text/css" href="resources/css/loader.css">

</head>
<body>

  <div class="container">
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
  </div>

  <script src="resources/js/jquery-1.11.1.min.js"></script>
  <script src="resources/js/gmail-invited.js"></script>
  
</body>
</html>