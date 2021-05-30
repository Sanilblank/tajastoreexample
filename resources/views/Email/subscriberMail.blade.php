@component('mail::message')
<center><img src="{{Storage::disk('uploads')->url($mailData['setting']->headerImage)}}" alt="{{$mailData['setting']->sitename}}" style="max-width: 200px; margin-bottom: 2rem;"></center>

<center style="font-size: 2rem; font-weight:bold; margin-bottom: 1.5rem;">{{$mailData['product']->title}}({{$mailData['product']->quantity}} {{$mailData['product']->unit}})</center>

<img src="{{Storage::disk('uploads')->url($mailData['productimage']->filename)}}" alt="{{$mailData['product']->title}}" style="max-width: 100%;">

@component('mail::button', ['url' => $mailData['url'], 'color' => 'green'])
    Take a look at the Product.
@endcomponent
@endcomponent
