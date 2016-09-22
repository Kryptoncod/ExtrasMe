@extends('index.section', ['number' => 5, 'id' => 'error'])
@section('section-content')

   <div class="error404-container">
      <h1>SORRY, THE PAGE THAT YOU ARE LOOKING FOR IS CURRENTLY NOT AVAILABLE</h1>
      <h4 style="margin-bottom:0;">OR <a href="{{ route('index') }}">CLICK HERE</a> TO RETURN TO HOMEPAGE</h4>
   </div>
   

@overwrite