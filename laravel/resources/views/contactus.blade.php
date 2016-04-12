@extends('app', ['title' => 'TripPlanShop - Contact Us'])
@section('content')
    <div class="col-sm-12 col-md-6 col-lg-offset-3">

        <h2 class="top-buffer">Have Something to Tell Us?</h2>

        <form method="POST" action="{{ route('home.postContactus') }}" class="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                {!! Form::label('Your Name') !!}
                {!! Form::text('name', null,
                array('required',
                'class'=>'form-control',
                'placeholder'=>'Your name')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Your E-mail Address') !!}
                {!! Form::email('email', null,
                array('required',
                'class'=>'form-control',
                'placeholder'=>'Your e-mail address')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Message Title') !!}
                {!! Form::text('title', null,
                array('required',
                'class'=>'form-control',
                'placeholder'=>'What is this about')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Your Message') !!}
                {!! Form::textarea('message', null,
                array('required',
                'class'=>'form-control',
                'placeholder'=>'Your message')) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Send',
                array('class'=>'btn itit-footer-button btn-primary')) !!}
            </div>
        </form>
    </div>

    <div class="clearfix"></div>

    @stop