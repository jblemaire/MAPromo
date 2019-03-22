@guest
    @include('includes.login')
    @include('includes.register')
@else
    <input id="userInfos" type="hidden" value="{{Auth::user()}}"/>
@endguest