@extends('layouts.super')

@section('content')

<h1>About TinkoffParser</h1>
<p>
    TinkoffParser is the first tropically-themed parser
    application to hit the market.
</p>

<a href="http://www.wjgilmore.com"
   class="btn btn-success">W.J. Gilmore, LLC</a>
<br>
<br>
<br>
<div>
    {!! Form::open() !!}
    {!! Form::text('category', null, ['class'=>'']) !!}
    {!! Form::checkbox('my') !!}
    {!! Form::submit('Применить', ['class' => 'btn btn-primary'] ) !!}
    {!! var_dump($errors->messages) !!}
    {!! Form::close() !!}
</div>


@endsection



@section('advertisement')
@parent
<p>
    Jamz and Sun Lotion Special $59!
</p>
@endsection

