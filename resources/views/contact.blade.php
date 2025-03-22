@extends('layout')

@section('content')
    <h1>Contact Us</h1>
    
    @if(session()->has('success'))
        <p style="color: {{ session('success') ? 'green' : 'red' }};">
            {{ session('message') }}
        </p>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf  {{-- Laravel requires CSRF protection for forms --}}
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        @if ($errors->has('name'))
            <p style="color: red;">{{ $errors->first('name') }}</p>
        @endif
        <br>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        @if ($errors->has('message'))
            <p style="color: red;">{{ $errors->first('message') }}</p>
        @endif
        <br>
        
        <button type="submit">Send Message</button>
    </form>

    <div>
        <ul>
            @foreach($messages as $message)
                <li><strong>{{ $message->name }}</strong>: {{ $message->message }}</li>
            @endforeach
        </ul>
    </div>
@endsection