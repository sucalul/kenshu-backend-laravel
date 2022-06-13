@if(session()->has('EMAIL'))
    こんにちは、{{ session('EMAIL') }}さん
@endif
