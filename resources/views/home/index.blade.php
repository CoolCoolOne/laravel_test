<div>
    <h1>this is this</h1>
    <p>
        my name is {{ $name }} {{ $surname }};
    </p>
    <p>
        @foreach ($deals as $d)
            {{ $loop->iteration }}
            {{ $d }}
            <br>
        @endforeach
    </p>
</div>
<hr>
@include('common.button',['color'=>'cyan','text'=>'отправить'])
